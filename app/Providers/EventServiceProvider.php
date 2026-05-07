<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login;
use App\Models\Admin;
use App\Models\AdminAccessLog;
use Illuminate\Support\Facades\Log;

class EventServiceProvider extends ServiceProvider{
    protected $listen = [
        \App\Events\AdminLoginEvent::class => [
            \App\Listeners\LogAdminLogin::class,
        ],
    ];
    
    public function boot(): void{
        parent::boot();

        Event::listen(Login::class, function ($event) {
            $user = $event->user;

            if ($user instanceof Admin || ($user->is_admin ?? false)) {
                try {
                    AdminAccessLog::create([
                        'admin_id' => $user->id,
                        'action' => 'Login',
                        'ip_address' => request()->ip(),
                        'details' => request()->userAgent(),
                    ]);
                } catch (\Exception $e) {
                    Log::error("Failed to log admin login: " . $e->getMessage());
                }
            }
        });
    }
}