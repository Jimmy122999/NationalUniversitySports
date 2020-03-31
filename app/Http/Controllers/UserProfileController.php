<?php

namespace App\Http\Controllers;

use App\UserProfile;
Use Auth;
Use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class UserProfileController extends Controller
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
    public function adminCreate()
    {
        return view('admin/profile/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::find(Auth::user()->id);

       $userProfile = UserProfile::create([
            'user_id' => $user->id,
            'team_id' => $user->member->team_id,
            'team_member_id' => $user->member->id,
            'position' => request('position'),
            'bio' => request('bio')


         ]);
       return redirect()->route('adminProfileShow' , [$userProfile]);

    }

    public function adminAddImage(UserProfile $userProfile)
    {


        if (request()->hasFile('image')) {

            
           request()->validate([
                'image' => 'file|image|max:5000'
            ]);
           $userProfile->update([
            'image' => request()->image->store('uploads' , 'public')
           ]);
        }
        $image = Image::make(public_path('storage/' . $userProfile->image))->fit(300,300);
        $image->save();


        return redirect()->route('adminProfileShow' , [$userProfile]);

    }



    /**
     * Display the specified resource.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function adminShow(UserProfile $userProfile)
    {

        return view('admin/profile/show', compact('userProfile' , $userProfile));
    }

    public function show(UserProfile $userProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function adminEdit(UserProfile $userProfile)
    {
        return view('admin/profile/edit' , compact('userProfile', $userProfile));
    }

    public function edit(UserProfile $userProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function adminUpdate(Request $request, UserProfile $userProfile)
    {
        $userProfile->position = request('position');
        $userProfile->bio = request('bio');
        $userProfile->save();
        return redirect()->route('adminProfileShow' , [$userProfile]);

    }
    public function update(Request $request, UserProfile $userProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserProfile $userProfile)
    {
        $userProfile->delete();
        return redirect('admin');
    }
}
