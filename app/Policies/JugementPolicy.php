<?php

namespace App\Policies;

use App\Models\User;

class JugementPolicy
{
    public function create(User $user): bool
    {
        return $user->isJuge();
    }
}
