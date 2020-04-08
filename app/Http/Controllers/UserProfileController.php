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
    public function create()
    {
        $this->authorize('create' , UserProfile::class);
        return view('profile/create');
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

        $data = request()->validate([
              'position' => 'required|alpha|max:20',
              'bio' => 'required|max:500',

        ]);

       $userProfile = UserProfile::create([
            'user_id' => $user->id,
            'team_id' => $user->member->team_id,
            'team_member_id' => $user->member->id,
            'position' => request('position'),
            'bio' => request('bio')


         ]);
       return redirect()->route('profileShow' , [$userProfile]);

    }

    public function addImage(UserProfile $userProfile)
    {


        if (request()->hasFile('image')) {
            
            
           request()->validate([
                'image' => 'file|image|max:5000'
            ]);
           $image = Image::make(request()->image->getRealPath())->fit(300 , 300);
           
           $image->save();
           $userProfile->update([

            'image' => request()->image->store('uploads' , 'public')
           ]);
        }



        return redirect()->route('profileShow' , [$userProfile]);

    }



    /**
     * Display the specified resource.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function show(UserProfile $userProfile)
    {

        return view('profile/show', compact('userProfile' , $userProfile));
    }

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(UserProfile $userProfile)
    {
        $this->authorize('update' , [UserProfile::class , $userProfile]);
        return view('profile/edit' , compact('userProfile', $userProfile));
    }

  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserProfile $userProfile)
    {
        $this->authorize('update' , [UserProfile::class , $userProfile]);
        $userProfile->position = request('position');
        $userProfile->bio = request('bio');
        $userProfile->save();
        return redirect()->route('profileShow' , [$userProfile]);

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
