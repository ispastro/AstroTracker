<?php

namespace App\Policies;

use App\Models\CelestialEvent;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CelestialEventPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, CelestialEvent $event)
    {
        return $event->isVisibleToUser($user);
    }

    public function create(User $user)
    {
        return $user->hasRole('admin');
    }

    public function update(User $user, CelestialEvent $event)
    {
        return $user->hasRole('admin');
    }

    public function delete(User $user, CelestialEvent $event)
    {
        return $user->hasRole('admin');
    }

    public function subscribe(User $user, CelestialEvent $event)
    {
        return $event->isVisibleToUser($user);
    }
}
