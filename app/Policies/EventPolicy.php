<?php

namespace App\Policies;

use App\Models\Event;
use App\User;
use App\UserPermission;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any events.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->permissions()->permits(UserPermission::EVENTS, UserPermission::VIEWANY)->count() > 0;
    }

    /**
     * Determine whether the user can view the event.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Event  $event
     * @return mixed
     */
    public function view(User $user, Event $event)
    {
        return $user->permissions()->permits(UserPermission::EVENTS, UserPermission::VIEW)->count() > 0;
    }

    /**
     * Determine whether the user can create events.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->permissions()->permits(UserPermission::EVENTS, UserPermission::CREATE)->count() > 0;
    }

    /**
     * Determine whether the user can update the event.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Event  $event
     * @return mixed
     */
    public function update(User $user, Event $event)
    {
        return $user->permissions()->permits(UserPermission::EVENTS, UserPermission::UPDATE)->count() > 0;
    }

    /**
     * Determine whether the user can delete the event.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Event  $event
     * @return mixed
     */
    public function delete(User $user, Event $event)
    {
        return $user->permissions()->permits(UserPermission::EVENTS, UserPermission::DELETE)->count() > 0;
    }

    /**
     * Determine whether the user can restore the event.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Event  $event
     * @return mixed
     */
    public function restore(User $user, Event $event)
    {
        return $user->permissions()->permits(UserPermission::EVENTS, UserPermission::RESTORE)->count() > 0;
    }

    /**
     * Determine whether the user can permanently delete the event.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Event  $event
     * @return mixed
     */
    public function forceDelete(User $user, Event $event)
    {
        return $user->permissions()->permits(UserPermission::EVENTS, UserPermission::FORCEDELETE)->count() > 0;
    }
}
