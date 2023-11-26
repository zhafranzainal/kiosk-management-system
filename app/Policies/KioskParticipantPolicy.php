<?php

namespace App\Policies;

use App\Models\User;
use App\Models\KioskParticipant;
use Illuminate\Auth\Access\HandlesAuthorization;

class KioskParticipantPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the kioskParticipant can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list kioskparticipants');
    }

    /**
     * Determine whether the kioskParticipant can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\KioskParticipant  $model
     * @return mixed
     */
    public function view(User $user, KioskParticipant $model)
    {
        return $user->hasPermissionTo('view kioskparticipants');
    }

    /**
     * Determine whether the kioskParticipant can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create kioskparticipants');
    }

    /**
     * Determine whether the kioskParticipant can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\KioskParticipant  $model
     * @return mixed
     */
    public function update(User $user, KioskParticipant $model)
    {
        return $user->hasPermissionTo('update kioskparticipants');
    }

    /**
     * Determine whether the kioskParticipant can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\KioskParticipant  $model
     * @return mixed
     */
    public function delete(User $user, KioskParticipant $model)
    {
        return $user->hasPermissionTo('delete kioskparticipants');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\KioskParticipant  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete kioskparticipants');
    }

    /**
     * Determine whether the kioskParticipant can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\KioskParticipant  $model
     * @return mixed
     */
    public function restore(User $user, KioskParticipant $model)
    {
        return false;
    }

    /**
     * Determine whether the kioskParticipant can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\KioskParticipant  $model
     * @return mixed
     */
    public function forceDelete(User $user, KioskParticipant $model)
    {
        return false;
    }
}
