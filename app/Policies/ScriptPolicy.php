<?php

namespace App\Policies;

use App\Models\Script;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ScriptPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Script  $script
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Script $script)
    {
        return $user->role_id === 1 || $user->id === $script->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->role_id === 2;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Script  $script
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Script $script)
    {
        return $user->role_id === 1
            ? true
            : $user->id === $script->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Script  $script
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Script $script)
    {
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Script  $script
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Script $script)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Script  $script
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Script $script)
    {
        //
    }

    public function status(User $user, Script $script)
    {
        return  $user->id === $script->user_id;
    }
}
