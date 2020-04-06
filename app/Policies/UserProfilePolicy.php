<?php

namespace App\Policies;

use App\User;
use App\UserProfile;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserProfilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any user profiles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the user profile.
     *
     * @param  \App\User  $user
     * @param  \App\UserProfile  $userProfile
     * @return mixed
     */
    public function view(User $user, UserProfile $userProfile)
    {
        if($userProfile->user_id == $user->id)
        {
            return true;
        }
        elseif($user->user_group == 1)
        {
            return true;
        }
    }

    /**
     * Determine whether the user can create user profiles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function createPost(User $user, UserProfile $userProfile)
    {
        if($userProfile->user_id == $user->id)
        {
            return true;
        }
        elseif($user->user_group == 1)
        {
            return true;
        }
    }

    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the user profile.
     *
     * @param  \App\User  $user
     * @param  \App\UserProfile  $userProfile
     * @return mixed
     */
    public function update(User $user, UserProfile $userProfile)
    {
        //
    }

    /**
     * Determine whether the user can delete the user profile.
     *
     * @param  \App\User  $user
     * @param  \App\UserProfile  $userProfile
     * @return mixed
     */
    public function delete(User $user, UserProfile $userProfile)
    {
        //
    }

    /**
     * Determine whether the user can restore the user profile.
     *
     * @param  \App\User  $user
     * @param  \App\UserProfile  $userProfile
     * @return mixed
     */
    public function restore(User $user, UserProfile $userProfile)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the user profile.
     *
     * @param  \App\User  $user
     * @param  \App\UserProfile  $userProfile
     * @return mixed
     */
    public function forceDelete(User $user, UserProfile $userProfile)
    {
        //
    }
}
