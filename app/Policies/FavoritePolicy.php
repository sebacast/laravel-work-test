<?php

namespace App\Policies;

use App\Models\Favorite;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FavoritePolicy
{
    use HandlesAuthorization;

   
    public function __construct()
    {
        //
    }
    public function pass(User $user, Favorite $favorite)
    {
        return $user->id == $favorite->user_id;
    }
}
