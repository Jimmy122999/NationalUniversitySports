<?php

namespace App\Http\Controllers;

use App\Team;
use App\TeamMember;
use App\Division;
use App\Sport;
use App\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminIndex()
    {
        return view('admin/teams/index');
    }

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
        $captains = User::all(['id' , 'name' , 'user_group'])->where('user_group', 2);
        $sports = Sport::all(['id', 'name']);
        $divisions = Division::all(['id', 'name' , 'sport_id']);
        
        return view ('admin/teams/create' , compact('captains' , $captains) , compact('sports' , $sports) , compact('divisions', $divisions));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function adminShow(Team $team)
    {

        // $teamMembers = TeamMember::all();
        return view ('admin/teams/show', compact('team'));
        // dd($teamMembers->name);


        

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        //
    }
}
