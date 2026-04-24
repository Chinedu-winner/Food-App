<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class Order extends Model{
    use HasFactory;

    public const STATUS_PENDING   = 'pending';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_PREPARING = 'preparing';
    public const STATUS_READY     = 'ready';
    public const STATUS_DELIVERED = 'delivered';
    public const STATUS_CANCELLED = 'cancelled';

    public function items(){
    return $this->hasMany(OrderItem::class);
    }

    protected $fillable = [
        'user_id',
        'name',
        'total',
        'total_price',
        'status',
        'notes',
        'latitude',
        'longitude',
        'address',
        'phone',
    ];
 
    protected $casts = [
        'total'     => 'decimal:2',
        'latitude'  => 'decimal:7',
        'longitude' => 'decimal:7',
        'created_at'=> 'datetime',
        'updated_at'=> 'datetime',
    ];

    // Relationships
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function orderItems(): HasMany{
        return $this->hasMany(OrderItem::class);
    }

    public function foods(): BelongsToMany{
        return $this->belongsToMany(Food::class, 'order_items')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    // Scopes
    public function scopeForUser(Builder $query, int $userId): Builder{
        return $query->where('user_id', $userId);
    }

    public function scopeWithStatus(Builder $query, string $status): Builder{
        return $query->where('status', $status);
    }

    public function scopeRecent(Builder $query): Builder{
        return $query->orderByDesc('created_at');
    }

    // Calculate total from items
    public function recalcTotal(): float{
        $total = $this->orderItems()->get()->reduce(function ($carry, OrderItem $item) {
            return $carry + ($item->price * $item->quantity);
        }, 0);

        $this->total = round((float) $total, 2);
        $this->saveQuietly();

        return $this->total;
    }

    // Add an item to the order
    public function addItem(Food $food, int $quantity = 1, ?float $price = null): OrderItem{
        $price = $price ?? $food->price;
        $item = $this->orderItems()->create([
            'food_id'  => $food->id,
            'quantity' => $quantity,
            'price'    => $price,
        ]);

        $this->recalcTotal();
        return $item;
    }

    // Status helpers
    public function markAs(string $status): self
    {
        $this->status = $status;
        $this->save();
        return $this;
    }

    public function markAsDelivered(): self{
        return $this->markAs(self::STATUS_DELIVERED);
    }

    public function isDelivered(): bool{
        return $this->status === self::STATUS_DELIVERED;
    }

    public function isPending(): bool{
        return $this->status === self::STATUS_PENDING;
    }

    public function placedAt(): ?Carbon{
        return $this->created_at ? Carbon::parse($this->created_at) : null;
    }
}