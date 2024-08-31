<?php

namespace App\Policies;

use App\Models\User;

class AudiencePolicy
{
    public function create(User $user): bool{
        return $user->isJuge();
    }
}
