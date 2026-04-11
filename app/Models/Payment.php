<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model{
    use HasFactory;
    protected $table = 'payments';

    protected $fillable = [
        'user_id',
        'amount',
        'status',
        'transaction_id', 
        'payment_method', 
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}