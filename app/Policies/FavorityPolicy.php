<?php

namespace App\Policies;

use App\Models\Favority;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FavorityPolicy {

    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user) {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Favority  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Favority $model)
    {
        return $user->id == $model->user_id || $user->isAdministrator();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Favority  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Favority $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Favority  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Favority $model)
    {
        return $user->id == $model->user_id || $user->isAdministrator();
    }
}
