<?php

namespace App\Policies;

use App\Models\Partie;
use App\Models\User;

class PartiePolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user): bool
    {
        return ! $user->isJuge();
    }
}
