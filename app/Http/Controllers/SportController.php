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

        return view('sports' , ['sports' => $sports]);
    }
    public function adminIndex()
    {
        $sports = Sport::all();

        return view('admin/sports/index' , ['sports' => $sports]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/sports/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        Sport::create(request()->validate([
            'name' => 'required'
        ]));

        return redirect('/admin/sports');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sport  $sport
     * @return \Illuminate\Http\Response
     */
    public function show(Sport $sport)
    {
        // $sport = Sport::findOrFail($id);
    }

    public function adminShow(Sport $sport)
    {
         // $sport = Sport::findOrFail($id);
        return view ('admin/sports/show' , compact('sport'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sport  $sport
     * @return \Illuminate\Http\Response
     */
    public function edit(Sport $sport)
    {
        return view ('admin/sports/edit', compact('sport'));
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
        $sport->name = request('name');
        $sport->save();
        return redirect('admin/sports');
       

        



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sport  $sport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sport $sport)
    {
        $sport->delete();
        return redirect('admin/sports');
    }
}
