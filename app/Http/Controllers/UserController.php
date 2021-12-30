<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'email'=>'required|email'
        ]);
        //submit
        $user = new User();

        $user->name = $request->name;

        $user->email = $request->email;

        $user->disabled = false;

        $user->password = $request->password;

        $user->bio = $request->bio;

        $worked = $user->save();

        //redirect
        if($worked){
            return redirect()->route('user.show', $user->id);
        }else{
            return redirect()->route('user.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('profile');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('profile')->with('user',$id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        //validate form
        $this->validate($request, [
            'email'=>'required|email'
        ]);
        //submit
        $id = Auth::id();
        $user = User::find($id);

        $user->name = $request->name;

        $user->email = $request->email;

        $user->zip = $request->zip;

        if( $request->has('disabled') ){
            if($request->disabled == 'on') {
                $user->disabled = true;
            }
        }else{
            $user->disabled = false;
        }

        if( $request->has('password') ) {
            if($request->input('password') !== null ){
                $user->password = Hash::make($request->password);
            }
        }

        $user->bio = $request->bio;

        $worked = $user->save();

        //redirect
        if($worked){
            return redirect()->route('user.show', $user->id);
        }else{
            return redirect()->route('user.create');
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
