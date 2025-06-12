<?php

namespace App\Policies;

use App\Models\Reply;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReplyPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function destroy(User $user, Reply $reply): bool
    {
    return $user->isAuthorOf($reply) || $user->isAuthorOf($reply->topic);
    }
}
