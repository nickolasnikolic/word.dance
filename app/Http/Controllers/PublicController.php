<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\User;
use App\Poem;
use Auth;

class PublicController extends Controller
{
    public function home(){
        $poets = User::where('disabled', false )->orderBy('name', 'asc')->get();
        $poems = Poem::selectRaw('poetry.id, poetry.id as record_number, poetry.title, poetry.poem, poetry.meaning, users.name')
                        ->leftJoin('users', 'poetry.user_id', '=','users.id')
                        ->where('poetry.published', true)
                        ->where('users.banned', false)
                        ->where('users.disabled', false)
                        ->orderBy('poetry.id', 'desc')
                        ->get();

        if($poems->count()){
             $randompoem = $poems->random();
        }else{
            $randompoem = new Poem();
        }

        $genreArray = Poem::existingTags();

        $jGenre = json_decode($genreArray);

        $rev = array_reverse($jGenre);
        $lastgenreREV = array_slice($rev, 0,4);
        $lastgenre = array_reverse($lastgenreREV);

        $lastpoets = $poets->reverse()->slice(0, 6);
        $lastpoems = $poems->reverse()->slice(0, 6);

        return view( 'home', [
            'poets' => $poets,
            'lastpoets' => $lastpoets,
            'poems' => $poems,
            'lastpoems' => $lastpoems,
            'lastgenre' => $lastgenre,
            'randompoem' => $randompoem
        ]);
    }

    public function poets(){
        $poets = User::select('*')
                        ->where('disabled', false )
                        ->where('banned', false )
                        ->orderBy('id', 'desc')
                        ->paginate(15);

        foreach ($poets as $poet) {

            $poetry = Poem::where('user_id', $poet->id)->get();


            $viewsCount = $poetry->reduce(function ($c, $i){
                return $c + $i->views;
            });
            $poet->setAttribute('totalviews', $viewsCount > 0? $viewsCount : 0 );

            $likesCount = $poetry->reduce(function ($l, $e) {
                return $l + $e->likes;
            });
            $poet->setAttribute('totallikes', $likesCount > 0? $likesCount : 0 );

        }

        return view('poets', [ 'poets' => $poets ]);
    }

    public function poet($id){
        $poet = User::find($id);
        $poems = Poem::where('user_id', $id)->get();

        return view('poet', ['poet'=>$poet, 'poems' => $poems ]);
    }

    public function poetry(){
        $poetry = Poem::selectRaw('poetry.id, poetry.id as record_number, poetry.title, poetry.poem, poetry.meaning, users.name')
                        ->leftJoin('users', 'poetry.user_id', '=','users.id')
                        ->where('poetry.published', true)
                        ->where('users.banned', false)
                        ->where('users.disabled', false)
                        ->orderBy('poetry.id', 'desc')
                        ->paginate(15);

        return view('poetry', ['poetry'=>$poetry]);
    }

    public function controversial(){
        $poems = Poem::selectRaw('poetry.id, poetry.id as record_number, poetry.title, poetry.poem, poetry.meaning, users.name, abs(poetry.likes - poetry.dislikes) as ord')
                        ->leftJoin('users', 'poetry.user_id', '=','users.id')
                        ->where('poetry.published', true)
                        ->where('users.banned', false)
                        ->where('users.disabled', false)
                        ->orderByRaw('ord', 'asc')
                        ->paginate(15);
        return view('poetry', ['poetry' => $poems]);
    }

    public function popular(){

        $poems = Poem::selectRaw('poetry.id, poetry.id as record_number, poetry.title, poetry.poem, poetry.meaning, users.name, abs(poetry.views - poetry.likes) as ord')
                        ->leftJoin('users', 'poetry.user_id', '=','users.id')
                        ->where('poetry.published', true)
                        ->where('users.banned', false)
                        ->where('users.disabled', false)
                        ->orderByRaw('ord', 'asc')
                        ->paginate(15);

        return view('poetry', ['poetry' => $poems]);
    }


    public function poem($id){

        $poetry = Poem::selectRaw('poetry.id, poetry.id as record_number, poetry.title, poetry.poem, poetry.meaning, poetry.price, users.name as name, users.stripe_uid as suid')
                        ->leftJoin('users', 'poetry.user_id', '=','users.id')
                        ->where('poetry.published', true)
                        ->where('users.banned', false)
                        ->where('users.disabled', false)
                        ->orderBy('poetry.id', 'desc')
                        ->get();

        $poem = $poetry->find($id);

        if(Auth::check()){
            $poem->increment('views');
        }
        $poem->save();

        return view('poem', ['poem' => $poem, 'likesDisabled' => false ]);
    }

    public function search(Request $query){
        $s = $query->input('search');

        if(empty($s)){
            $poems = [];
            $poets = [];
            $tags = [];
            $poemCount = 0;
            $poetCount = 0;
        }else{

            $poets = User::search($s)
                ->where('disabled', false)
                ->where('banned', false)
                ->get();

                foreach($poets as $poet){
                    $poemsToPoet = Poem::where( 'user_id', $poet->id );
                    $poet->setAttribute('poems', $poemsToPoet->get());
                }

            $poems = Poem::search($s)->where('published', true)->get();

            $poetCount = $poets->count();
            $poemCount = $poems->count();

            $tags = DB::select("select * from tagging_tags where name like :query;", ['query' => $s]);

        }
        $results = [
            'search' => $s,
            'poetry' => $poems,
            'poets' => $poets,
            'tags' => $tags,
            'poemCount' => $poemCount,
            'poetCount' => $poetCount
        ];

        return view('search-results', $results);

    }

    public function showPoemsInGenre($tag){

        $poemsWithGenre = collect(DB::select(
            'select
                poetry.id, title, poem, meaning, user_id
            from poetry
            join tagging_tagged on taggable_id = poetry.id
            join users on users.id = poetry.user_id
        where published = 1 and
        banned = 0  and
        disabled = 0 and
        tag_name = ?', [$tag]));

        return view('genre-list', ['genre'=> $tag,'poetry'=> $poemsWithGenre]);
    }

    public function showAllGenre(){

        $genres =  Poem::existingTags();;

        return view('genre', ['genres'=> $genres]);
    }
}
