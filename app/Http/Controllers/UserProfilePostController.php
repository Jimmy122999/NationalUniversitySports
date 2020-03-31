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
    public function adminCreate(UserProfile $userProfile)
    {
        return view('admin/profile/posts/create' , compact('userProfile' , $userProfile));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function adminStore(Request $request , UserProfile $userProfile)
    {
        UserProfilePost::create([
            'member_id' => $userProfile->team_member_id,
            'profile_id' => $userProfile->id,
            'body' => request('body')

        ]);

        return redirect()->route('adminProfileShow' , [$userProfile]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserProfilePost  $userProfilePost
     * @return \Illuminate\Http\Response
     */
    public function show(UserProfilePost $userProfilePost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserProfilePost  $userProfilePost
     * @return \Illuminate\Http\Response
     */
    public function adminEdit(UserProfile $userProfile , UserProfilePost $userProfilePost)
    {
        return view('admin/profile/posts/edit' , compact('userProfile' , $userProfile), compact('userProfilePost' , $userProfilePost));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserProfilePost  $userProfilePost
     * @return \Illuminate\Http\Response
     */
    public function adminUpdate(Request $request, UserProfile $userProfile , UserProfilePost $userProfilePost)
    {
        $userProfilePost->body = request('body');
        $userProfilePost->save();
        return redirect()->route('adminProfileShow' , [$userProfile]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserProfilePost  $userProfilePost
     * @return \Illuminate\Http\Response
     */
    public function adminDestroy( UserProfile $userProfile , UserProfilePost $userProfilePost)
    {
        $userProfilePost->delete();
        return redirect()->route('adminProfileShow' , [$userProfile]);
    }
}
