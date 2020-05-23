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
    public function index(Sport $sport , Division $division)
    {
        $fixtures = Fixture::where('division_id' , $division->id)->where('played' , 0)->orderBy('time')->paginate(5);
        return view('fixtures/index', compact('fixtures' , $fixtures));
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

    


    public function makeSeason(Sport $sport , Division $division, Request $request)
    {
        $this->authorize('generateSeason' , Fixture::class);
        Fixture::where('division_id' , $division->id)->delete();

        Team::where('division_id' , $division->id)
        ->update(['played' => '0',
                'wins' => '0',
                'draws' => '0',
                'losses' => '0',
                'points' => '0',]);

        
        $allTeams = Team::all()->where('division_id' , $division->id)->pluck('id')->toArray();
        $noDateSet = Carbon::parse(request('start'));
        $noDateSet->hour = 13;
        $noDateSet->minute = 0;

        $teams = sizeof($allTeams);
            
           
            $totalGames = $teams - 1;
            $matchesPerRound = $teams / 2;
            $games = [];
            //Add an extra team if odd 
            if ($teams % 2 == 1) {
                $teams++;
               
            }
            for ($i = 0; $i < $totalGames; $i++) {
                $games[$i] = [];
            }
            //Set home and away teams
            for ($round = 0; $round < $totalGames; $round++) {
                    for ($match = 0; $match < $matchesPerRound; $match++) {
                        $home = ($round + $match) % ($teams - 1);
                        $away = ($teams - 1 - $match + $round) % ($teams - 1);
                        
                        if ($match == 0) {
                            $away = $teams - 1;
                        }
                        $games[$round][$match] = [$home , $away];
                     

                     

                        $homeTeam = $games[$round][$match][0];
                        $awayTeam = $games[$round][$match][1];

                        
                        //check
                        if($home >=  sizeof($allTeams) || $away >= sizeof($allTeams))
                        {

                        }
                         else
                         {
                            Fixture::create([
                                'home_team_id' => $allTeams[$homeTeam],
                                'away_team_id' => $allTeams[$awayTeam],
                                'division_id' => $division->id,
                                'time' => $noDateSet,
                                'notes' => 'No Information Set',
                                'played' => 0
                            ]);
                         }
                        
                    
                }
                  
                $noDateSet->addWeeks(2);
            }
            //Reverse fixtures for second half
            $secondHalf = array_reverse($games);
       
            foreach ($secondHalf as $matchDay)
            {
                foreach ($matchDay as $game)
                {
                    if($game[0] >=  sizeof($allTeams) || $game[1] >= sizeof($allTeams))
                    {
                     }
                     else
                     {
                        Fixture::create([
                            'home_team_id' => $allTeams[$game[1]],
                            'away_team_id' => $allTeams[$game[0]],
                            'division_id' => $division->id,
                            'time' => $noDateSet,
                            'notes' => 'No Information Set',
                            'played' => 0
                        ]);
                     }
                    
                }
                $noDateSet->addWeeks(2);
            }
           return redirect()->route('fixtures' , [$sport , $division]);


        
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
            
            'notes' => 'required|max:300',

        ]);
      
        Fixture::create([
            'home_team_id' => request('homeTeam'),
            'away_team_id' => request('awayTeam'),
            'division_id' => request('division_id'),
            'time' => Carbon::parse(request('date') . request('time')),
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

    public function captainEdit(Fixture $fixture)
    {
       
        return view('fixtures/captainEdit' , compact('fixture', $fixture));
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
        $fixture->time = Carbon::parse(request('date') . request('time'));
        $fixture->notes = request('notes');
        $fixture->save();
        // return redirect('sports');
        return redirect('/fixtures');

    }

    public function captainUpdate(Request $request, Fixture $fixture)
    {

        $this->authorize('captainEdit' , [Fixture::class , $fixture]);
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



