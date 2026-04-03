<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Food;
use Illuminate\Auth\Access\HandlesAuthorization;

class FoodPolicy{
    use HandlesAuthorization;

    public function before(User $user, $ability){
        if ($user->role === 'admin') {
            return true; // admins can do everything
        }
    }

    public function view(User $user, Food $food){
        return true; // everyone can view
    }

    public function create(User $user){
        return $user->role === 'admin';
    }

    public function update(User $user, Food $food){
        return $user->role === 'admin';
    }

    public function delete(User $user, Food $food){
        return $user->role === 'admin';
    }
}