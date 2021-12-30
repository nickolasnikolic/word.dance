<?php

namespace App\Http\Controllers;

use App\Mail\HateSpeechNotification;
use Illuminate\Http\Request;
use App\Poem;

class UserResponseController extends Controller
{
    public function poems($id){
        $poem = Poem::find($id);

        return response()->json( $poem->with('user')->get());
    }

    public function like(Request $request){
        if($request->isMethod('POST')){
            $id = $request->input('record');
            $mode = $request->input('mode');

            switch ($mode) {
                case 1:
                    $this->likeUpdate($id);
                    break;
                case 2:
                    $this->dislikeUpdate($id);
                    break;
                case 3:
                    $this->hatefulUpdate($id);
                    break;

                default:
                    return respons()->json(['message'=>'success']);
                    break;
            }
        }
    }

    private function likeUpdate($id){
        $allpoems = Poem::all();
        $poem = $allpoems->find($id);
        $poem->increment('likes');
        $poem->save();
        return;
    }
    private function dislikeUpdate($id){
        $allpoems = Poem::all();
        $poem = $allpoems->find($id);
        $poem->increment('dislikes');
        $poem->save();
        return;
    }
    private function hatefulUpdate($id){
        $allpoems = Poem::all();
        $poem = $allpoems->find($id);
        $poem->increment('hateful');
        $poem->save();

        //if poem hateful rating above 15
        if($poem->hateful == 15){
            //notify owner to check it out
            Mail::to('subclass@gmail.com')->send(new HateSpeechNotification($poem));
        }
        return;
    }
}
