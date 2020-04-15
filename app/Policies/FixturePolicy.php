<?php

namespace App\Policies;

use App\Fixture;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FixturePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any fixtures.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the fixture.
     *
     * @param  \App\User  $user
     * @param  \App\Fixture  $fixture
     * @return mixed
     */
    public function view(User $user, Fixture $fixture)
    {
        //
    }

    /**
     * Determine whether the user can create fixtures.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if($user->user_group == 1)
        {
            return true;
        }
    }

    /**
     * Determine whether the user can update the fixture.
     *
     * @param  \App\User  $user
     * @param  \App\Fixture  $fixture
     * @return mixed
     */
    public function update(User $user)
    {
        if($user->user_group == 1)
        {
            return true;
        }
    }

    public function captainEdit(User $user , Fixture $fixture)
    {
        if($fixture->homeTeam->captain_id == $user->id)
        {
            return true;
        }
        
        
    }

    /**
     * Determine whether the user can delete the fixture.
     *
     * @param  \App\User  $user
     * @param  \App\Fixture  $fixture
     * @return mixed
     */
    public function delete(User $user)
    {
        if($user->user_group == 1)
        {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the fixture.
     *
     * @param  \App\User  $user
     * @param  \App\Fixture  $fixture
     * @return mixed
     */
    public function restore(User $user, Fixture $fixture)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the fixture.
     *
     * @param  \App\User  $user
     * @param  \App\Fixture  $fixture
     * @return mixed
     */
    public function forceDelete(User $user, Fixture $fixture)
    {
        //
    }
}
