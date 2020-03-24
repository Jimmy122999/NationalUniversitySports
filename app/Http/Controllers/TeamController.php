<?php

namespace App\Http\Controllers;

use App\Team;
use App\TeamMember;
use App\Division;
use App\Sport;
use App\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminIndex()
    {
        return view('admin/teams/index');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createSport()
    {
        // $captains = User::all(['id' , 'name' , 'user_group'])->where('user_group', 2);
        $sports = Sport::all(['id', 'name']);
        // $divisions = Division::all(['id', 'name' , 'sport_id']);
        $selectedSport = '';
        
        return view ('admin/teams/create' , compact('sports' , $sports), compact('selectedSport' , $selectedSport));
    }

    public function createDivision(Sport $sport , Request $request)
    {
        $captains = User::all(['id' , 'name' , 'user_group'])->where('user_group', 2);
        $divisions = Division::all(['id', 'name' , 'sport_id']);
        
        return view ('admin/teams/create' , compact('captains' , $captains) , compact('sports' , $sports))->with(compact('divisions' , $divisions));
    }

    public function fetch(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = DB::table('divisions')->where($select, $value)->groupBy($dependent)->get();

        $output= '<option value="">Select '.ucfirst($dependent).'</option>';

        foreach($data as $row)
        {
            $output .= '<option value= "'.$row->$dependent.'">
            '.$row->$dependent.'</option>';
            echo $output;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function adminShow(Team $team)
    {

        // $teamMembers = TeamMember::all();
        return view ('admin/teams/show', compact('team'));
        // dd($teamMembers->name);


        

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        //
    }
}
