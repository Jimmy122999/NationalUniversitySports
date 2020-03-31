<?php

namespace App\Http\Controllers;
use Auth;
use App\TeamPost;
use App\Team;
use App\TeamMember;
use Illuminate\Http\Request;

class TeamPostController extends Controller
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
    public function adminCreate(Team $team , TeamMember $teamMember)
    {
        
        return view ('admin/teams/posts/create' , compact('team' , $team), compact('teamMember', $teamMember));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function adminStore(Request $request, Team $team, TeamMember $teamMember)
    {


       



        TeamPost::create([
                    'member_id' => $teamMember->id,
                    'team_id' => $team->id,
                    'body' => request('body')

                ]);

        return redirect()->route('adminTeamShow' , [$team]); //Adding Wildcard to Route
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TeamPost  $teamPost
     * @return \Illuminate\Http\Response
     */
    public function show(TeamPost $teamPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TeamPost  $teamPost
     * @return \Illuminate\Http\Response
     */
    public function adminEdit(Team $team, TeamMember $teamMember, TeamPost $teamPost)
    {
        
        return view ('admin/teams/posts/edit' , compact('teamPost' , $teamPost), compact('teamMember', $teamMember))->with('team' , $team);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TeamPost  $teamPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team, TeamMember $teamMember, TeamPost $teamPost)
    {
        $teamPost->body = request('body');
        $teamPost->save();
        return redirect()->route('adminTeamShow' , [$team]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TeamPost  $teamPost
     * @return \Illuminate\Http\Response
     */
    public function adminDestroy(Team $team, TeamMember $teamMember, TeamPost $teamPost)
    {
        $teamPost->delete();
        return redirect()->route('adminTeamShow' , [$team]);
    }
}
