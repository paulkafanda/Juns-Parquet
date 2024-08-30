<?php

namespace App\Policies;

use App\Models\User;

class PlaintePolicy
{
    public function create(User $user): bool
    {
        return $user->isSecretaire();
    }
}
