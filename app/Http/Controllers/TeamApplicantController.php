<?php

namespace App\Http\Controllers;

use App\TeamApplicant;
use App\Team;
use App\User;
use App\TeamMember;
use Auth;
use Illuminate\Http\Request;

class TeamApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Team $team)
    {
        $this->authorize('viewApplications' , [TeamApplicant::class , $team]);
        return view('teams/apply/index' , compact('team', $team));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Team $team)
    {
        
        return view('teams/apply/create', compact('team', $team));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , Team $team)
    {

        TeamApplicant::create([
                    'team_id' => $team->id,
                    'user_id' => Auth::user()->id,
                    'name' => request('name'),
                    'approved' => 0

                ]);

        return redirect()->route('teamShow' , [$team]);
    }

    public function accept(Team $team, TeamApplicant $application)
    {
        TeamMember::create([
                    'name' => $application->name,
                    'team_id' => $team->id,
                    'user_id' => $application->user_id,


        ]);

        $user = User::find($application->user_id);
        $user->update(['hasTeam' => 1]);
        $user->save();

        $application->update(['approved' => 1]);






        return back();
        
    }

    public function deny(Team $team, TeamApplicant $application)
    {
        $application->delete();
        return back();
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\TeamApplicant  $teamApplicant
     * @return \Illuminate\Http\Response
     */
    public function show(TeamApplicant $teamApplicant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TeamApplicant  $teamApplicant
     * @return \Illuminate\Http\Response
     */
    public function edit(TeamApplicant $teamApplicant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TeamApplicant  $teamApplicant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeamApplicant $teamApplicant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TeamApplicant  $teamApplicant
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeamApplicant $teamApplicant)
    {
        //
    }
}
