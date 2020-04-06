<?php

namespace App\Policies;

use App\TeamMember;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamMemberPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any team members.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the team member.
     *
     * @param  \App\User  $user
     * @param  \App\TeamMember  $teamMember
     * @return mixed
     */
    public function view(User $user, TeamMember $teamMember)
    {
        //
    }

    /**
     * Determine whether the user can create team members.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the team member.
     *
     * @param  \App\User  $user
     * @param  \App\TeamMember  $teamMember
     * @return mixed
     */
    public function update(User $user, TeamMember $teamMember)
    {
        //
    }

    /**
     * Determine whether the user can delete the team member.
     *
     * @param  \App\User  $user
     * @param  \App\TeamMember  $teamMember
     * @return mixed
     */
    public function delete(User $user, TeamMember $teamMember)
    {
        //
    }

    /**
     * Determine whether the user can restore the team member.
     *
     * @param  \App\User  $user
     * @param  \App\TeamMember  $teamMember
     * @return mixed
     */
    public function restore(User $user, TeamMember $teamMember)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the team member.
     *
     * @param  \App\User  $user
     * @param  \App\TeamMember  $teamMember
     * @return mixed
     */
    public function forceDelete(User $user, TeamMember $teamMember)
    {
        //
    }
}
