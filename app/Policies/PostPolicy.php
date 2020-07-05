<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function manage(User $user, Post $post)
    {
        return ($user->hasRole('moderator') || $user->is($post->owner));
    }
}
