<?php

namespace App\Http\Controllers;

use DB;
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
        $teams = Team::all(['id', 'name']);
        return view('admin/teams/index' , compact('teams', $teams));
    }

    public function index()
    {
        return view ('admin/teams/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $captains = User::all(['id' , 'name' , 'user_group'])->where('user_group', 2);
        $sports = Sport::all(['id', 'name']);
        $captains = User::all(['id' , 'name' , 'user_group'])->where('user_group', 2);
        // $divisions = Division::all(['id', 'name' , 'sport_id']);
        $selectedSport = '';
        
        return view ('admin/teams/create' , compact('sports' , $sports), compact('selectedSport' , $selectedSport))->with(compact('captains' , $captains));
    }

    // public function createDivision(Sport $sport , Request $request)
    // {
    //     $captains = User::all(['id' , 'name' , 'user_group'])->where('user_group', 2);
    //     $divisions = Division::all(['id', 'name' , 'sport_id']);
        
    //     return view ('admin/teams/create' , compact('captains' , $captains) , compact('sports' , $sports))->with(compact('divisions' , $divisions));
    // }

    public function fetch(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = DB::table('divisions')->where($select, $value)->pluck('name', 'id');

        $output= '<option value="#" selected="true" disabled="disabled">Select Division</option>';

        foreach($data as $id => $value)
        {
            $output .= '<option value= "'.$id.'">'.$value.'</option>';
        }


        return $output;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      Team::create([
            'name' => request('name'),
            'division_id' => request('division_id'),
            'captain_id' => request('captain_id'),
            'wins' => '0',
            'draws' => '0',
            'losses' => '0',
            'points' => '0',

        ]);

      


        return redirect ('admin');
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

        $posts = $team->leftJoin('team_posts', 'teams.id', '=', 'team_posts.team_id')
             ->leftJoin('team_members', 'team_posts.member_id', '=', 'team_members.id')
             ->where('team_posts.team_id', '=', $team->id)
             ->select([
                'team_posts.id',
                'team_posts.body',
                'team_posts.created_at',
                'team_members.id as teamMemberId',
                'team_members.name'

             ])
             ->get();
             // dd($posts);


        return view ('admin/teams/show', compact('team'))->with(compact('posts', $posts));
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

        $sports = Sport::all();
        $captains = User::all(['id' , 'name' , 'user_group'])->where('user_group', 2);
        $divisions = Division::where('id', '=', $team->division_id)->pluck('name', 'id')->toArray();

        // $returnData =[];
        // $returnData['divisions'] = $divisions;
        // dd($returnData);


        return view ('admin/teams/edit', compact('team'), compact('sports' , $sports))->with(compact('captains', $captains))->with('divisions' , $divisions);
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
        $team->name = request('name');
        $team->division_id = request('division_id');
        $team->captain_id = request('captain_id');
        $team->save();
        return redirect('admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $team->delete();
        return redirect('admin/sports');
    }
}
