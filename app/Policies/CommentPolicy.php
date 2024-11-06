<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class CommentPolicy
{

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Comment $comment): bool
    {
        if ($user->id == $comment->user_id) {
            return true;
        }
     
        return false;
    
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Comment $comment): bool
    {
        if ($user->isAdministrator()) {
            return true;
        }

        if ($user->id == $comment->user_id) {
            return true;
        }
     
        return false;
    }
}
