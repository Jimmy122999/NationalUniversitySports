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
        $fixtures = Fixture::all();
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
            'time' => Carbon::parse(request('time')),
            'notes' => request('notes')
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



