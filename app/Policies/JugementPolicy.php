<?php

namespace App\Policies;

use App\Models\User;

class JugementPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isJuge() || $user->isAdmin();
    }
    public function create(User $user): bool
    {
        return $user->isJuge();
    }
    public function delete(User $user): bool
    {
        return $user->isJuge();
    }
}
