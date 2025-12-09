<?php

namespace App\Policies;

use App\Models\Medmon\Medmon;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MedmonPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Medmon $medmon): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Medmon $medmon): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Medmon $medmon): bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Medmon $medmon): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Medmon $medmon): bool
    {
        return true;
    }

    /**
     * Determine whether the user can import models.
     */
    public function import(User $user): bool
    {
        // return $user->hasRole('admin');
        return true;
    }
}
