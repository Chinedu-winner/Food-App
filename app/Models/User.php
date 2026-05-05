<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable{
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo',
        'phone',
        'role',
        'address',
        'city',
        'zip_code',
        'date_of_birth',
        'preferences',
        'admin_id',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array{
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_of_birth' => 'date',
            'preferences' => 'array',
        ];
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
