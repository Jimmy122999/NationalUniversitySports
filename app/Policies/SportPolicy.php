<?php

namespace App\Policies;

use App\Sport;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SportPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any sports.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the sport.
     *
     * @param  \App\User  $user
     * @param  \App\Sport  $sport
     * @return mixed
     */
    public function view(User $user, Sport $sport)
    {
        //
    }

    /**
     * Determine whether the user can create sports.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return in_array($user->user_group, ['1']);
    }

    /**
     * Determine whether the user can update the sport.
     *
     * @param  \App\User  $user
     * @param  \App\Sport  $sport
     * @return mixed
     */
    public function update(User $user, Sport $sport)
    {
        //
    }

    /**
     * Determine whether the user can delete the sport.
     *
     * @param  \App\User  $user
     * @param  \App\Sport  $sport
     * @return mixed
     */
    public function delete(User $user, Sport $sport)
    {
        //
    }

    /**
     * Determine whether the user can restore the sport.
     *
     * @param  \App\User  $user
     * @param  \App\Sport  $sport
     * @return mixed
     */
    public function restore(User $user, Sport $sport)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the sport.
     *
     * @param  \App\User  $user
     * @param  \App\Sport  $sport
     * @return mixed
     */
    public function forceDelete(User $user, Sport $sport)
    {
        //
    }
}
