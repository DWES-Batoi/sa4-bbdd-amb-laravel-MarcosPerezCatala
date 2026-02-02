<?php

namespace App\Policies;

use App\Models\Jugadora;
use App\Models\User;

class JugadoraPolicy
{
    private function isAdmin(User $user): bool
    {
        return ($user->role ?? null) === 'administrador';
    }

    /**
     * Determine whether the user can view any models.
     * Public access - anyone can list jugadoras
     */
    public function viewAny(?User $user = null): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     * Public access - anyone can view a jugadora
     */
    public function view(?User $user = null, ?Jugadora $jugadora = null): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     * Only administrators can create
     */
    public function create(User $user): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can update the model.
     * Only administrators can update
     */
    public function update(User $user, Jugadora $jugadora): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can delete the model.
     * Only administrators can delete
     */
    public function delete(User $user, Jugadora $jugadora): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Jugadora $jugadora): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Jugadora $jugadora): bool
    {
        return $this->isAdmin($user);
    }
}
