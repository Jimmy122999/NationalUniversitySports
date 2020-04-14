<?php

namespace App\Http\Controllers;

use App\Fixture;
use App\Sport;
use App\Division;
use App\Team;
use Carbon\Carbon;

use Illuminate\Http\Request;

class FixtureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fixtures = Fixture::all()->where('played' , 0)->sortBy('time');
        $results = Fixture::all()->where('played' , 1);
        return view('fixtures/index', compact('fixtures' , $fixtures) , compact('results' , $results));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create' , Fixture::class);
        $sports = Sport::all(['id', 'name']);
        return view('fixtures/create' , compact('sports' , $sports));
    }

    public function generateSeason(Sport $sport , Division $division)
    {
        $homeTeams = Team::all()->where('division_id' , $division->id)->pluck('name' , 'id');
        $awayTeams = Team::all()->where('division_id' , $division->id)->pluck('name' , 'id');

      
        // $teams = [Team::all()->where('division_id' , $division->id)];
        $seasonStart = new Carbon();

        // foreach ($teams as $team) {
        //     dd($team);
        // }

        foreach ($homeTeams as $homeTeamId => $value) {
            foreach ($awayTeams as $awayTeamId => $value) {
                if($homeTeamId !== $awayTeamId)
                {
                    
                    Fixture::create([
                        'home_team_id' => $homeTeamId,
                        'away_team_id' => $awayTeamId,
                        'division_id' => $division->id,
                        'time' => $seasonStart,
                        'notes' => 'test',
                        'played' => 0
                    ]);
                   
                }
            
        }

        $fixtures = Fixture::all()->where('division_id' , $division);
 


      


        

        
    }
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create' , Fixture::class);
        $validatedData = request()->validate([
            'time' => 'required|date',
            'notes' => 'required|max:300',

        ]);
      
        Fixture::create([
            'home_team_id' => request('homeTeam'),
            'away_team_id' => request('awayTeam'),
            'division_id' => request('division_id'),
            'time' => Carbon::parse(request('time')),
            'notes' => request('notes'),
            'played' => 0
        ]);
        return redirect('admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fixture  $fixture
     * @return \Illuminate\Http\Response
     */
    public function show(Fixture $fixture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fixture  $fixture
     * @return \Illuminate\Http\Response
     */
    public function edit(Fixture $fixture)
    {
        $sports = Sport::all(['id', 'name']);
        return view('fixtures/edit' , compact('fixture', $fixture) , compact('sports' , $sports));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fixture  $fixture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fixture $fixture)
    {

        $this->authorize('update' , Fixture::class);
        $fixture->home_team_id = request('homeTeam');
        $fixture->away_team_id = request('awayTeam');
        $fixture->time = Carbon::parse(request('time'));
        $fixture->notes = request('notes');
        $fixture->save();
        // return redirect('sports');
        return redirect('/fixtures');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fixture  $fixture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fixture $fixture)
    {
        $this->authorize('delete' , Fixture::class);
        $fixture->delete();
        return redirect('/fixtures');

    }
}



