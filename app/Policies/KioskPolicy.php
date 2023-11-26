<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Kiosk;
use Illuminate\Auth\Access\HandlesAuthorization;

class KioskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the kiosk can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list kiosks');
    }

    /**
     * Determine whether the kiosk can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Kiosk  $model
     * @return mixed
     */
    public function view(User $user, Kiosk $model)
    {
        return $user->hasPermissionTo('view kiosks');
    }

    /**
     * Determine whether the kiosk can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create kiosks');
    }

    /**
     * Determine whether the kiosk can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Kiosk  $model
     * @return mixed
     */
    public function update(User $user, Kiosk $model)
    {
        return $user->hasPermissionTo('update kiosks');
    }

    /**
     * Determine whether the kiosk can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Kiosk  $model
     * @return mixed
     */
    public function delete(User $user, Kiosk $model)
    {
        return $user->hasPermissionTo('delete kiosks');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Kiosk  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete kiosks');
    }

    /**
     * Determine whether the kiosk can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Kiosk  $model
     * @return mixed
     */
    public function restore(User $user, Kiosk $model)
    {
        return false;
    }

    /**
     * Determine whether the kiosk can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Kiosk  $model
     * @return mixed
     */
    public function forceDelete(User $user, Kiosk $model)
    {
        return false;
    }
}
