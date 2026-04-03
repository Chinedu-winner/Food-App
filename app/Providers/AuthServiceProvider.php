<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Food;
use App\Policies\FoodPolicy;

class AuthServiceProvider extends ServiceProvider{
    protected $policies = [
        Food::class => FoodPolicy::class,
    ];

    public function boot(){
        $this->registerPolicies();
    }
}