<?php

namespace App\Http\Controllers;

use App\Sport;
use App\Division;
use Illuminate\Http\Request;

class SportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function index()
    {
        $sports = Sport::all();

        return view('sports/index' , ['sports' => $sports]);


    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sports/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

        $this->authorize('create' , Sport::class);
        Sport::create(request()->validate([
            'name' => 'required|unique:sports|alpha_spaces|max:20'
        ]));

        return redirect('/sports');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sport  $sport
     * @return \Illuminate\Http\Response
     */
   

    public function show(Sport $sport)
    {
        
        return view ('sports/show' , compact('sport'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sport  $sport
     * @return \Illuminate\Http\Response
     */
    public function edit(Sport $sport)
    {

        return view ('sports/edit', compact('sport'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sport  $sport
     * @return \Illuminate\Http\Response
     */
    public function update(Sport $sport)
    {
        $this->authorize('update' , Sport::class);
        $sport->name = request('name');
        $sport->save();
        return redirect('sports');
       

        



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sport  $sport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sport $sport)
    {
        $this->authorize('delete' , Sport::class);
        $sport->delete();
        return redirect('sports');
    }
}
