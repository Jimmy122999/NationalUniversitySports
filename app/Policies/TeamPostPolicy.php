<?php

namespace App\Policies;

use App\TeamPost;
use App\Team;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamPostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any team posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the team post.
     *
     * @param  \App\User  $user
     * @param  \App\TeamPost  $teamPost
     * @return mixed
     */
    public function view(User $user, TeamPost $teamPost)
    {
        //
    }

    /**
     * Determine whether the user can create team posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        
        
    }

    public function admin(User $user)
    {
        
    }
    public function createPost(User $user , $team)
    {
        
        return in_array( $team->id , [$user->member->team_id]);

    }

    /**
     * Determine whether the user can update the team post.
     *
     * @param  \App\User  $user
     * @param  \App\TeamPost  $teamPost
     * @return mixed
     */
    public function update(User $user, $teamPost)
    {
        
        if($user->user_group == 1)
        {
            return true;
        }
        if(isset($user->member->id)){
            if ($teamPost->teamMemberId == $user->member->id) {
                return true;
            }
            elseif ($teamPost->member_id == $user->member->id) {
                return true;
            }
        }
    }

    /**
     * Determine whether the user can delete the team post.
     *
     * @param  \App\User  $user
     * @param  \App\TeamPost  $teamPost
     * @return mixed
     */
    public function delete(User $user, $teamPost)
    {
        if($user->user_group == 1)
        {
            return true;
        }
        if(isset($user->member->id)){
            if ($teamPost->teamMemberId == $user->member->id) {
                return true;
            }
            elseif ($teamPost->member_id == $user->member->id) {
                return true;
            }
        }
    }

    /**
     * Determine whether the user can restore the team post.
     *
     * @param  \App\User  $user
     * @param  \App\TeamPost  $teamPost
     * @return mixed
     */
    public function restore(User $user, TeamPost $teamPost)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the team post.
     *
     * @param  \App\User  $user
     * @param  \App\TeamPost  $teamPost
     * @return mixed
     */
    public function forceDelete(User $user, TeamPost $teamPost)
    {
        //
    }
}
