<?php

namespace App\Policies;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the sale can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list sales');
    }

    /**
     * Determine whether the sale can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Sale  $model
     * @return mixed
     */
    public function view(User $user, Sale $model)
    {
        return $user->hasPermissionTo('view sales');
    }

    /**
     * Determine whether the sale can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create sales');
    }

    /**
     * Determine whether the sale can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Sale  $model
     * @return mixed
     */
    public function update(User $user, Sale $model)
    {
        return $user->hasPermissionTo('update sales');
    }

    /**
     * Determine whether the sale can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Sale  $model
     * @return mixed
     */
    public function delete(User $user, Sale $model)
    {
        return $user->hasPermissionTo('delete sales');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Sale  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete sales');
    }

    /**
     * Determine whether the sale can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Sale  $model
     * @return mixed
     */
    public function restore(User $user, Sale $model)
    {
        return false;
    }

    /**
     * Determine whether the sale can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Sale  $model
     * @return mixed
     */
    public function forceDelete(User $user, Sale $model)
    {
        return false;
    }
}
