<?php

namespace App\Http\Controllers;

use App\Captain;
use App\User;
use Illuminate\Http\Request;

class CaptainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->where('user_group' , 2);
        return view('captain/index' , compact('users' , $users));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all()->where('user_group' , 3);
        return view('captain/create' , compact('users' , $users));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request ,  User $player)
    {
        
       
        $player->user_group = 2;
        $player->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Captain  $captain
     * @return \Illuminate\Http\Response
     */
    public function show(Captain $captain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Captain  $captain
     * @return \Illuminate\Http\Response
     */
    public function edit(Captain $captain)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Captain  $captain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $captain)
    {
        $captain->user_group = 3;
        $captain->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Captain  $captain
     * @return \Illuminate\Http\Response
     */
    public function destroy(Captain $captain)
    {
        //
    }
}
