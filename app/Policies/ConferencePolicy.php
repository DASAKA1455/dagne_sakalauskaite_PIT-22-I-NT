<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Conference;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConferencePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasRole('Admin'); 
    }

    public function create(User $user)
    {
        return $user->hasAnyRole(['Admin', 'Employee']); 
    }

    public function update(User $user, Conference $conference)
    {
        return $user->hasAnyRole(['Admin', 'Employee']); 
    }

    public function delete(User $user, Conference $conference)
    {
        return $user->hasRole('Admin'); // Only Admin can delete
    }
}
