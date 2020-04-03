<?php

namespace App\Http\Controllers;

use App\UserProfilePost;
use App\UserProfile;
use Illuminate\Http\Request;

class UserProfilePostController extends Controller
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
    public function create(UserProfile $userProfile)
    {
        return view('profile/posts/create' , compact('userProfile' , $userProfile));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , UserProfile $userProfile)
    {
        UserProfilePost::create([
            'member_id' => $userProfile->team_member_id,
            'profile_id' => $userProfile->id,
            'body' => request('body')

        ]);

        return redirect()->route('profileShow' , [$userProfile]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserProfilePost  $userProfilePost
     * @return \Illuminate\Http\Response
     */
  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserProfilePost  $userProfilePost
     * @return \Illuminate\Http\Response
     */
    public function edit(UserProfile $userProfile , UserProfilePost $userProfilePost)
    {
        return view('profile/posts/edit' , compact('userProfile' , $userProfile), compact('userProfilePost' , $userProfilePost));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserProfilePost  $userProfilePost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserProfile $userProfile , UserProfilePost $userProfilePost)
    {
        $userProfilePost->body = request('body');
        $userProfilePost->save();
        return redirect()->route('profileShow' , [$userProfile]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserProfilePost  $userProfilePost
     * @return \Illuminate\Http\Response
     */
    public function destroy( UserProfile $userProfile , UserProfilePost $userProfilePost)
    {
        $userProfilePost->delete();
        return redirect()->route('profileShow' , [$userProfile]);
    }
}
