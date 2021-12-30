<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Poem;
use Auth;

class PoemController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        $this->validate($request, ['title' => 'required', 'poem' => 'required']);

        //submit to db
        $poem = new Poem();

        $poem->title = $request->title;
        $poem->poem = $request->poem;
        $poem->meaning = $request->meaning;
        $poem->price = $request->price;

        $poem->user_id = Auth::id();

        $poem->save();

        $poem->tag($request->genre);

        $poem->save();

        return redirect()->route('poem.show', $poem->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('poem')->with('poem', Poem::find($id)->first());
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $poem = Poem::findOrFail($id);

        if ($poem->user->id != Auth::id()) {
            abort(404);
        }

        //submit to db
        //validate
        $this->validate($request, ['title' => 'required', 'poem' => 'required']);

        //submit to db
        $poem->title = $request->title;
        $poem->poem = $request->poem;
        $poem->meaning = $request->meaning;
        $poem->published = $request->published;
        $poem->price = $request->price;

        $poem->save();

        //$poem->retag($request->genre);

        $poem->save();

        if($request->published == 0){
            return redirect()->route('mine');
        }else{

            return redirect()->route('poem.show', $poem->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
