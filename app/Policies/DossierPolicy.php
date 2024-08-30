<?php

namespace App\Policies;

use App\Models\User;

class DossierPolicy
{
    public function viewAny(User $user): bool

    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->isMagistrat();
    }
}
