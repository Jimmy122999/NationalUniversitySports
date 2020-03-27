<?php

namespace App\Http\Controllers;

use App\TeamApplicant;
use App\Team;
use Illuminate\Http\Request;

class TeamApplicantController extends Controller
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
    public function adminCreate(Team $team)
    {
        return view('admin/teams/apply/create', compact('team', $team));
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
