<?php

namespace App\Policies;

use App\Models\Piece;
use App\Models\User;

class PiecePolicy
{
    public function create(User $user): bool
    {
        return $user->isMagistrat();
    }

    public function delete(User $user): bool
    {
        return $user->isMagistrat();
    }
}
