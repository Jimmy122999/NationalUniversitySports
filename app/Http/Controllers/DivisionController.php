<?php

namespace App\Http\Controllers;

use App\Division;
use App\Sport;
use Illuminate\Http\Request;

class DivisionController extends Controller
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
    public function create(Sport $sport)
    {
      //  $sport = Sport::findorfail($id);

        return view ('divisions/create', compact('sport') );

        


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Sport $sport)
    {
        $this->authorize('create' , Division::class);
        $sport->addDivision(request('name'));

        // Division::create([
        //     'sport_id' => ($sport->id),
        //     'name' => request('name')


        // ]);

    
       return redirect()->route('SportShow' , [$sport]);
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */

    public function show(Sport $sport, Division $division)
    {
        $teams = $division->team->sortByDesc('points');
        
        return view ('divisions/show' , compact('sport') , compact('division'))->with(compact('teams' , $teams));
    }

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function edit(Sport $sport, Division $division)
    {
        return view ('divisions/edit', compact('sport') , compact('division'));
        // dd('hello');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function update(Sport $sport, Division $division)
    {
        $this->authorize('update' , Division::class);
        $division->name = request('name');
        $division->save();
        // return redirect('sports');
        return redirect()->route('SportShow' , [$sport]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sport $sport , Division $division)
    {
        $this->authorize('delete' , Division::class);
        $division->delete();
        return redirect()->route('SportShow' , [$sport]);
    }
}
