<?php

namespace App\Listeners;

use App\Events\AdminLoginEvent;
use App\Models\AdminAccessLog;

class LogAdminLogin{
    public function handle(AdminLoginEvent $event){
        $user = $event->user;

        if ($user->is_admin) {
            AdminAccessLog::create([
                'admin_id' => $user->id,
                'action' => 'login',
                'ip_address' => request()->ip() ?? '127.0.0.1',
                'details' => request()->header('User-Agent') ?? 'Unknown',
            ]);
        }
    }
}