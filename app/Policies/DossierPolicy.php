<?php

namespace App\Policies;

use App\Models\Dossier;
use App\Models\User;

class DossierPolicy
{
    public function viewAny(): bool

    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->isMagistrat();
    }

    public function edit(User $user): bool
    {
        return $user->isMagistrat();
    }
}
