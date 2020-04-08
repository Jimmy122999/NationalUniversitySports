<?php

namespace App\Policies;

use App\TeamApplicant;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamApplicantPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any team applicants.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the team applicant.
     *
     * @param  \App\User  $user
     * @param  \App\TeamApplicant  $teamApplicant
     * @return mixed
     */
    public function view(User $user, TeamApplicant $teamApplicant)
    {
        //
    }

    /**
     * Determine whether the user can create team applicants.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if(isset($user->member->id))
        {
            return false;

        }

        else
        {
            return true;

        }
        
    }

    public function viewApplications(User $user , $team)
    {
        if($team->captain_id == $user->id)
        {
            return true;
        }
        return in_array($user->user_group, ['1']); //Looking for Admin or Captain user group
    }

    public function acceptApplications(User $user , $team)
    {
        if($team->captain_id == $user->id)
        {
            return true;
        }
        return in_array($user->user_group, ['1']); //Looking for Admin or Captain user group
    }

    public function denyApplications(User $user , $team)
    {
        if($team->captain_id == $user->id)
        {
            return true;
        }
        return in_array($user->user_group, ['1']); //Looking for Admin or Captain user group
    }

    /**
     * Determine whether the user can update the team applicant.
     *
     * @param  \App\User  $user
     * @param  \App\TeamApplicant  $teamApplicant
     * @return mixed
     */
    public function update(User $user, TeamApplicant $teamApplicant)
    {
        //
    }

    /**
     * Determine whether the user can delete the team applicant.
     *
     * @param  \App\User  $user
     * @param  \App\TeamApplicant  $teamApplicant
     * @return mixed
     */
    public function delete(User $user, TeamApplicant $teamApplicant)
    {
        //
    }

    /**
     * Determine whether the user can restore the team applicant.
     *
     * @param  \App\User  $user
     * @param  \App\TeamApplicant  $teamApplicant
     * @return mixed
     */
    public function restore(User $user, TeamApplicant $teamApplicant)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the team applicant.
     *
     * @param  \App\User  $user
     * @param  \App\TeamApplicant  $teamApplicant
     * @return mixed
     */
    public function forceDelete(User $user, TeamApplicant $teamApplicant)
    {
        //
    }
}
