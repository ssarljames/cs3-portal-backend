<?php

namespace App\Policies;

use App\Models\Post;
use App\User;
use App\UserPermission;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(?User $user)
    {
        return $user == null ||
                    $user->permissions()->permits(UserPermission::POSTS, UserPermission::VIEWANY)->count() > 0;
    }

    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function view(?User $user, Post $post)
    {
        return $user == null || $user->permissions()->permits(UserPermission::POSTS, UserPermission::VIEW)->count() > 0;
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->permissions()->permits(UserPermission::POSTS, UserPermission::CREATE)->count() > 0;
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        return $user->permissions()->permits(UserPermission::POSTS, UserPermission::UPDATE)->count() > 0;
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        return $user->permissions()->permits(UserPermission::POSTS, UserPermission::DELETE)->count() > 0;
    }

    /**
     * Determine whether the user can restore the post.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function restore(User $user, Post $post)
    {
        return $user->permissions()->permits(UserPermission::POSTS, UserPermission::RESTORE)->count() > 0;
    }

    /**
     * Determine whether the user can permanently delete the post.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function forceDelete(User $user, Post $post)
    {
        return $user->permissions()->permits(UserPermission::POSTS, UserPermission::FORCEDELETE)->count() > 0;
    }
}
