<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user)
    {
        return $user->hasRole('Admin');
    }

    public function update(User $user, User $model)
    {
        return $user->hasRole('Admin');
    }
}
