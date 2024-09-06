<?php /** @noinspection ALL */

namespace App\Policies;

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
