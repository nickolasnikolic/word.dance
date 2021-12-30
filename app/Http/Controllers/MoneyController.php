<?php

namespace App\Http\Controllers;
use App\Poem;
use App\User;
use App\Purchase;
use App\Sponsorship;
use Carbon\Carbon;
use Auth;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class MoneyController extends Controller
{
    private function pdf($html = '<h1>Hello world!</h1>'){
        //generate pdf
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => [210, 236],
            'orientation' => 'L'
        ]);
        $mpdf->WriteHTML($html);
        //offer download
        $mpdf->Output();
    }

    private function publishToScreen(Purchase $p){
        //collect data pertinant to translation
        $poem = Poem::find($p->poem_id);

        $eulaHead = file_get_contents(base_path('/resources/legal/word.dance-EULA-head.html'));
        $eulaTail = file_get_contents(base_path('/resources/legal/word.dance-EULA-tail.html'));

            $this->pdf(
                $eulaHead .
                '<p>'.  $p->name  . ' for the price of: $' . $p->price_paid . '</p>' .
                '<hr /><pre>' . $poem->poem . '</pre><hr /><p>' . $poem->meaning . '</p><hr />'.
                $eulaTail 
            );
    }

    public function licenseGet($id){
        session_start();
        //collect payment detail
        $poems = Poem::all();
        $poem = $poems->find($id);

        $paymentProductName = 'Poetry Licensing of: ' . $poem->title;
        $paymentDescription = 'Poetry Licensing of: ' . $poem->title. ' by: ' . $poem->user->name;
        $paymentAmount = ($poem->price * 100); //stripe asks for price in pennies


        //set up stripe
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $stripeSession = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'name' => $paymentProductName,
                'description' => $paymentDescription,
                'amount' => $paymentAmount,
                'currency' => 'usd',
                'quantity' => 1,
            ]],
            'payment_intent_data' => [
                'application_fee_amount' => round($paymentAmount * 0.05),
              ],
            'success_url' => url('paid',  $poem->id ),
            'cancel_url' => route('home'),
        ], [
            'stripe_account' => $poem->user->stripe_uid,
          ]);

        $_SESSION['stripe_id'] = $stripeSession->id;

        return view( 'money.pay', ['id' => $id, 'poem' => $poem, 'paymentsession' => $stripeSession,'stripe' => $poem->user->stripe_uid ]);
    }

    public function license($id)
    {
        session_start();
        if(isset($id)){
            $stripeTransactionName = $_SESSION['stripe_id'];
            
            //collect data pertinant to transaction
            $poem = Poem::find($id);

            $payee = $poem->user->name;

            if(Auth::check()){
                $payer = Auth::user()->name;
                $payerId = Auth::id();
            }else{
                $payer = 'anonymous';
                $payerId = 1; //set to admin for easy search
            }

            //put record of purchase in the db
            $purchase = new Purchase();

            $purchase->purchaser_id = $payerId;
            $purchase->poem_id = $poem->id;
            $purchase->price_paid = $poem->price;
            $purchase->stripe_id = $stripeTransactionName;
            $purchase->quantity = 1;
            $purchase->name = 'Poem License for: "'. $poem->title . '" by author: ' . $payee . ' to ' . $payer . ' transaction# '.$stripeTransactionName;

            $purchase->increment('quantity');
            $purchase->save();

            $this->publishToScreen($purchase);
            session_destroy();
        }else{
            redirect(404);
        }
    }

    public function redownloadLicense($id)
    {
        $purchased = Purchase::find($id);
        $this->publishToScreen($purchased);
    }

    public function sponsorGet($id, $denomination)
    {
        session_start();
        $poets = User::all();
        $poet = $poets->find($id);


        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));


        //create a product for use with stripe
        $product = \Stripe\Product::create([
            'name' => 'Poet Sponsorship of: ' . $poet->name,
            'type' => 'service',
        ]);

        $plan = \Stripe\Plan::create([
            'product' => $product->id,
            'nickname' => 'Word.Dance Platform USD',
            'interval' => 'month',
            'currency' => 'usd',
            'amount' => ($denomination * 100),
        ]);

        $stripeSession = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'subscription_data' => [
            'items' => [[
            'plan' => $plan->id,
            ]],
            'application_fee_percent' => 5,
          ],
        'success_url' => route('sponsored', ['poet' => $poet->id, 'amount' => $denomination] ),
        'cancel_url' => route('home'),
        ], [
            'stripe_account' => $poet->stripe_uid,
        ]);

        //find the user that is being sponsored
        $payee = $poet;

        $sponsorship = new Sponsorship();

        $sponsorship->patron_id = 1; //admin can cancel
        $sponsorship->payee_id = $payee->id;

        $_SESSION['patron_id'] = $sponsorship->patron_id;
        $_SESSION['payee_id'] = $sponsorship->payee_id;

        $sponsorship->pledge =  $denomination;
        $sponsorship->cycle = $plan->interval;
        $sponsorship->stripe_id = $poet->stripe_uid;
        $sponsorship->name = $$product->name;
        $sponsorship->stripe_plan = $plan->id;
        //$sponsorship->increment('quantity');
        $sponsorship->save();

        $_SESSION['pledge'] = $denomination;
        $_SESSION['poet_id'] = $poet->id;
        $_SESSION['stripe_plan'] = $plan->id;

        return view( 'money.sponsor', ['poet'=> $poet, 'paymentsession' => $stripeSession,'stripe' => $poet->stripe_uid ]);
    }


    public function sponsor(Request $request)
    {
        session_start();
        //find the poet in question
        $poet = User::find($_SESSION['poet_id']);
        //find the sponsorship in question
        $sponsorship = Sponsorship::where('payee_id', $poet->id)
                                    ->where('stripe_plan', $_SESSION['stripe_plan'])
                                    ->first();
        
        return view('money.sponsored', ['poet'=>$poet,'sponsorship'=>$sponsorship]);
    }

    public function cancelSponsor($id){
        $sponsorshipToCancel = Sponsorship::find($id);

        //cancel subscription in db
        //place end date as today
        $sponsorshipToCancel->ends_at = Carbon::now();
        //save
        $sponsorshipToCancel->save();

        //cancel subscription in stripe
        //set up stripe
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $subscription = \Stripe\Subscription::retrieve($sponsorshipToCancel->name);
        $subscription->cancel();

        //redisplay page
        return Redirect::back()->with('message','Operation Successful !');
    }

    public function getAuthFromStripe(Request $r){

        session_start();

        $config = [
            'clientId'          => env('STRIPE_CLIENT_ID'),
            'clientSecret'      => env('STRIPE_SECRET'),
            'redirectUri'       => 'https://word.dance/profile/stripe/connect',
            'scope'             => 'read_write',
        ];
        
        $provider = new \AdamPaterson\OAuth2\Client\Provider\Stripe($config);

        if (!isset($_GET['code'])) {
        
            // If we don't have an authorization code then get one
            $authUrl = 'https://connect.stripe.com/express/oauth/authorize?' . 'client_id=' . $config['clientId'] . '&response_type=code&redirect_uri=' . $config['redirectUri'] . '&scope=' . $config['scope'] . '&stripe_user[email]=' . Auth::user()->email;
                        
            header('Location: '.$authUrl);
            exit;
        
        // Check given state against previously stored one to mitigate CSRF attack
        } else {

            try {
        
                // Try to get an access token (using the authorization code grant)
                $token = $provider->getAccessToken('authorization_code', ['code'=> $_GET['code']]);

                //with code from original response
                $account = $provider->getResourceOwner($token);

                $stripeEmail = $account->getEmail();
                //save in db
                $poet = User::where('email', $stripeEmail)->first();

                $poet->access_token = $token->access_token;
                $poet->refresh_token = $token->refresh_token;
                $poet->stripe_uid = $token->stripe_user_id;
                $poet->scope = $token->scope;
                
                $poet->save();

                if(!Auth::check()){ //this is in need of explanation: the session is dropped, recover it
                    Auth::login($poet);
                }
        
            } catch (Exception $e) {
        
                // Failed to get user details
                exit('Oh dear...' . $e->message);
            }
        
            return redirect()->route('profile-edit')->with(['poet'=>$poet]);
        }

    }

    public function deauthorizeStripe(){
        //prep data for request
        $poet = Auth::user();

        $data = [ 'form_params' => [
            'client_id' => env('STRIPE_CLIENT_ID'),
            'stripe_user_id' => $poet->stripe_uid,
            'client_secret' => env('STRIPE_SECRET'),
        ]];
        
        //send deauth request
        $client = new Client();
        $client->request('POST', 'https://connect.stripe.com/oauth/deauthorize', $data);

        $poet->access_token = null;
        
        $poet->refresh_token = null;
        
        $poet->stripe_uid = null;

        $poet->save();

        return redirect()->route('profile-edit');
    }

}
