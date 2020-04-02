<?php

namespace App\Http\Controllers;

use App\FixtureResult;
use Illuminate\Http\Request;
use App\Fixture;

class FixtureResultController extends Controller
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
    public function create(Fixture $fixture)
    {
        return view('admin/fixtures/result/create' , compact('fixture' , $fixture));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function processResult($result, $fixture)
    {
        if($result == 'homeWin')
        {
            $fixture->homeTeam->played = $fixture->homeTeam->played + 1;
            $fixture->homeTeam->wins = $fixture->homeTeam->wins + 1;
            $fixture->homeTeam->points = $fixture->homeTeam->points + 3;
            
            $fixture->awayTeam->played = $fixture->awayTeam->played + 1;
            $fixture->awayTeam->losses = $fixture->awayTeam->losses + 1;

            $fixture->awayTeam->save();
            $fixture->homeTeam->save();

        }
        elseif($result == 'draw')
        {
            $fixture->homeTeam->played = $fixture->homeTeam->played + 1;
            $fixture->homeTeam->points = $fixture->homeTeam->points + 1;
            $fixture->homeTeam->draws = $fixture->homeTeam->draws + 1;


            $fixture->awayTeam->played = $fixture->awayTeam->played + 1;
            $fixture->awayTeam->points = $fixture->awayTeam->points + 1;
            $fixture->awayTeam->draws = $fixture->awayTeam->draws + 1;

            $fixture->awayTeam->save();
            $fixture->homeTeam->save();

        }

        elseif($result == 'awayWin')
        {
            $fixture->homeTeam->played = $fixture->homeTeam->played + 1;
            $fixture->homeTeam->losses = $fixture->homeTeam->losses + 1;
            
            
            $fixture->awayTeam->played = $fixture->awayTeam->played + 1;
            $fixture->awayTeam->wins = $fixture->awayTeam->wins + 1;
            $fixture->awayTeam->points = $fixture->awayTeam->points + 3;

            $fixture->awayTeam->save();
            $fixture->homeTeam->save();

        }
    }

    public function store(Request $request , Fixture $fixture)
    {
        FixtureResult::create([
            'fixture_id' => $fixture->id,
            'home_team_score' => request('home_team_score'),
            'away_team_score' => request('away_team_score'),
            'home_man_of_the_match_id' => request('home_man_of_the_match'),
            'away_man_of_the_match_id' => request('away_man_of_the_match')


        ]);

        if(request('home_team_score') > request('away_team_score')){
            $this->processResult('homeWin' , $fixture);

        }
        elseif(request('home_team_score') < request('away_team_score')){
            $this->processResult('awayWin' , $fixture);
        }
        else
        {
            $this->processResult('draw' , $fixture);
        }
        return redirect('admin/fixtures');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FixtureResult  $fixtureResult
     * @return \Illuminate\Http\Response
     */
    public function show(FixtureResult $fixtureResult)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FixtureResult  $fixtureResult
     * @return \Illuminate\Http\Response
     */
    public function edit(FixtureResult $fixtureResult)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FixtureResult  $fixtureResult
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FixtureResult $fixtureResult)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FixtureResult  $fixtureResult
     * @return \Illuminate\Http\Response
     */
    public function destroy(FixtureResult $fixtureResult)
    {
        //
    }
}
