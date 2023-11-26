<?php

namespace App\Policies;

use App\Models\User;
use App\Models\BusinessType;
use Illuminate\Auth\Access\HandlesAuthorization;

class BusinessTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the businessType can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list businesstypes');
    }

    /**
     * Determine whether the businessType can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BusinessType  $model
     * @return mixed
     */
    public function view(User $user, BusinessType $model)
    {
        return $user->hasPermissionTo('view businesstypes');
    }

    /**
     * Determine whether the businessType can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create businesstypes');
    }

    /**
     * Determine whether the businessType can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BusinessType  $model
     * @return mixed
     */
    public function update(User $user, BusinessType $model)
    {
        return $user->hasPermissionTo('update businesstypes');
    }

    /**
     * Determine whether the businessType can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BusinessType  $model
     * @return mixed
     */
    public function delete(User $user, BusinessType $model)
    {
        return $user->hasPermissionTo('delete businesstypes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BusinessType  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete businesstypes');
    }

    /**
     * Determine whether the businessType can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BusinessType  $model
     * @return mixed
     */
    public function restore(User $user, BusinessType $model)
    {
        return false;
    }

    /**
     * Determine whether the businessType can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BusinessType  $model
     * @return mixed
     */
    public function forceDelete(User $user, BusinessType $model)
    {
        return false;
    }
}
