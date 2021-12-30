<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use App\Poem;
use App\User;
use App\Purchase;
use Auth;

class LoggedInController extends Controller
{
    public function showMine(){
        session_start();
        $poetry = Poem::where('user_id', Auth::id())->get();

        $poetsSponsored = User::selectRaw('distinct payees.id as id, payees.stripe_plan, payees.pledge')
                                        ->leftJoin('sponsorships as patrons', 'users.id', '=', 'patrons.patron_id')
                                        ->leftJoin('sponsorships as payees', 'users.id', '=', 'payees.payee_id' )
                                        ->where('patrons.patron_id', Auth::id())
                                        ->where('payees.ends_at', null) 
                                        ->get();

        if(empty($poetsSponsored)){
            $poetsSponsored = null;
        }
                                        
        $poemsLicensed = Poem::selectRaw('distinct poetry.id, poetry.title, purchases.price_paid, purchases.id as purchase_id')
                                        ->leftJoin('purchases', 'poetry.id', '=', 'poem_id')
                                        ->where('purchaser_id', Auth::id())
                                        ->get();

        if(empty($poemsLicensed)){
            $poemsLicensed = null;
        }

        return view('mine', ['poetry'=> $poetry, 'poetryLicensed' => $poemsLicensed, 'poetsSponsored' => $poetsSponsored ]); //todo populate transactions
    }

    public function showProfile()
    {
        session_start();
        return view('profile')->with(['user' => Auth::user()]);
    }

    public function logout(){
        
        Auth::logout();
        
        return redirect()->route('home');
    }

    public function editPoem($poemId){
        session_start();
        $poem = Poem::find($poemId);
        return view('poem-edit', ['poem'=>$poem]);
    }

    public function editProfile(){

        $poet = Auth::user();

        return view('profile', ['poet'=>$poet]);
    }
}
