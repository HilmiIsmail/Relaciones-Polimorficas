<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Video;
use Illuminate\Auth\Access\Response;

class VideoPolicy
{

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Video $video): bool
    {
        return $user->id === $video->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Video $video): bool
    {
        return $user->id === $video->user_id;
    }
}
