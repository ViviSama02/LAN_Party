<?php

namespace App\Policies;

use App\Lan;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/*
 * Tout le monde peut voir la liste des lan est les détails d'une LAN, seul les utilisateurs
 * authentifiés peuvent faire le reste (création, édition, s'enregistrer)
*/
class LanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Lan  $lan
     * @return mixed
     */
    public function view(?User $user, Lan $lan)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Lan  $lan
     * @return mixed
     */
    public function update(User $user, Lan $lan)
    {
        return $lan->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Lan  $lan
     * @return mixed
     */
    public function delete(User $user, Lan $lan)
    {
        return $lan->user_id == $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Lan  $lan
     * @return mixed
     */
    public function restore(User $user, Lan $lan)
    {
        return $lan->user_id == $user->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Lan  $lan
     * @return mixed
     */
    public function forceDelete(User $user, Lan $lan)
    {
        //
    }
}
