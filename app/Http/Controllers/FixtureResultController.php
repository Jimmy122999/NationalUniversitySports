<?php

namespace App\Http\Controllers;

use App\FixtureResult;
use Illuminate\Http\Request;
use App\Sport;
use App\Division;
use App\Fixture;

class FixtureResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Sport $sport, Division $division)
    {
    
        $results = Fixture::where('played' , 1)->where('division_id' , $division->id)->paginate(2);
        
        return view('fixtures/result/index', compact('results' , $results), compact('division' , $division));
    }

    public function homePage()
    {
            $results = FixtureResult::orderBy('created_at' , 'desc')->take(3)->get();
            return view('index' , compact('results' , $results));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Fixture $fixture)
    {
        return view('fixtures/result/create' , compact('fixture' , $fixture));
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

    public function reverseResult($result, $fixture)
    {
        if($result == 'homeWin')
        {
           
            $fixture->homeTeam->played = $fixture->homeTeam->played - 1;
            $fixture->homeTeam->wins = $fixture->homeTeam->wins - 1;
            $fixture->homeTeam->points = $fixture->homeTeam->points - 3;
           
            
            
            
           
            $fixture->awayTeam->played = $fixture->awayTeam->played - 1;
            $fixture->awayTeam->losses = $fixture->awayTeam->losses - 1;
        
            

            $fixture->awayTeam->save();
            $fixture->homeTeam->save();

        }
        elseif($result == 'draw')
        {
           
            $fixture->homeTeam->played = $fixture->homeTeam->played - 1;
            $fixture->homeTeam->points = $fixture->homeTeam->points - 1;
            $fixture->homeTeam->draws = $fixture->homeTeam->draws - 1;
            

            
            $fixture->awayTeam->played = $fixture->awayTeam->played - 1;
            $fixture->awayTeam->points = $fixture->awayTeam->points - 1;
            $fixture->awayTeam->draws = $fixture->awayTeam->draws - 1;
            

            $fixture->awayTeam->save();
            $fixture->homeTeam->save();

        }

        elseif($result == 'awayWin')
        {
           
            $fixture->homeTeam->played = $fixture->homeTeam->played - 1;
            $fixture->homeTeam->losses = $fixture->homeTeam->losses - 1;
            
            
            $fixture->awayTeam->played = $fixture->awayTeam->played - 1;
            $fixture->awayTeam->wins = $fixture->awayTeam->wins - 1;
            $fixture->awayTeam->points = $fixture->awayTeam->points - 3;
            
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
        $fixture->played = 1;
        $fixture->save();
        return redirect()->route('divisionShow' , [$fixture->homeTeam->division->sport->name , $fixture->division_id]);
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
    public function edit(Fixture $fixture , FixtureResult $fixtureResult)
    {
        return view('fixtures/result/edit' , compact ('fixtureResult' , $fixtureResult));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FixtureResult  $fixtureResult
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fixture $fixture , FixtureResult $fixtureResult)
    {

        if($fixtureResult->home_team_score > $fixtureResult->away_team_score){
            $this->reverseResult('homeWin' , $fixture);

        }
        elseif($fixtureResult->home_team_score < $fixtureResult->away_team_score){
            $this->reverseResult('awayWin' , $fixture);
        }
        else
        {
            $this->reverseResult('draw' , $fixture);
        }
        $fixture->save();
        $fixtureResult->fixture_id = $fixture->id;
        $fixtureResult->home_team_score = request('home_team_score');
        $fixtureResult->away_team_score = request('away_team_score');
        $fixtureResult->home_man_of_the_match_id = request('home_man_of_the_match');
        $fixtureResult->away_man_of_the_match_id = request('away_man_of_the_match');
        

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
        $fixture->save();
        return redirect('results');
        




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FixtureResult  $fixtureResult
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fixture $fixture , FixtureResult $fixtureResult)
    {
        if($fixtureResult->home_team_score > $fixtureResult->away_team_score){
            $this->reverseResult('homeWin' , $fixture);

        }
        elseif($fixtureResult->home_team_score < $fixtureResult->away_team_score){
            $this->reverseResult('awayWin' , $fixture);
        }
        else
        {
            $this->reverseResult('draw' , $fixture);
        }
        $fixture->played = 0;
        $fixture->save();

        $fixtureResult->delete();
        return redirect('results');
    }
}
