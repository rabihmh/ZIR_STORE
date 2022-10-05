<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny($user)
    {
        return $user->hasAbility('roles.view');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\Role $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, Role $role)
    {
        return $user->hasAbility('roles.view');

    }

    /**
     * Determine whether the user can create models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($user)
    {
        return $user->hasAbility('roles.create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\Role $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, Role $role)
    {
        return $user->hasAbility('roles.update');

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\Role $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, Role $role)
    {
        return $user->hasAbility('roles.delete');

    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\Role $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, Role $role)
    {
        return $user->hasAbility('roles.restore');

    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\Role $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete($user, Role $role)
    {
        return $user->hasAbility('roles.force_delete');
    }
}
