<?php
namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Food extends Model{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'food';

    protected $fillable = [
    'name',
    'description',
    'price',
    'image',
    'category_id',
    'status'
];

    protected $casts = [
        'available' => 'boolean',
        'price' => 'decimal:2',
        'ingredients' => 'array',
        'dietary_restrictions' => 'array',
        'is_vegetarian' => 'boolean',
        'is_vegan' => 'boolean',
        'is_gluten_free' => 'boolean',
        'rating' => 'decimal:2',
    ];

    protected $appends = [];

    public function category(): BelongsTo{
        return $this->belongsTo(Category::class);
    }

    public function restaurant(): BelongsTo{
        return $this->belongsTo(Restaurant::class);
    }

    public function orderItems(): HasMany{
        return $this->hasMany(OrderItem::class);
    }

    public function orders(): BelongsToMany{
        return $this->belongsToMany(Order::class, 'order_items')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    public function scopeAvailable(Builder $query): Builder{
        return $query->where('available', true);
    }

    public function scopeVegetarian(Builder $query): Builder{
        return $query->where('is_vegetarian', true);
    }

    public function scopeVegan(Builder $query): Builder{
        return $query->where('is_vegan', true);
    }

    public function scopeGlutenFree(Builder $query): Builder{
        return $query->where('is_gluten_free', true);
    }

    public function scopeByCategory(Builder $query, int $categoryId): Builder{
        return $query->where('category_id', $categoryId);
    }

    public function scopeByRestaurant(Builder $query, int $restaurantId): Builder{
        return $query->where('restaurant_id', $restaurantId);
    }

    public function scopeSearch(Builder $query, ?string $term): Builder{
        if (empty($term)) {
            return $query;
        }

        $term = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $term) . '%';

        return $query->where(function (Builder $q) use ($term) {
            $q->where('name', 'like', $term)
            ->orWhere('description', 'like', $term)
            ->orWhereJsonContains('ingredients', $term);
        });
    }

    public function scopeFilter(Builder $query, array $filters): Builder{
        return $query
            ->when($filters['category_id'] ?? null, fn($q, $v) => $q->byCategory($v))
            ->when($filters['restaurant_id'] ?? null, fn($q, $v) => $q->byRestaurant($v))
            ->when($filters['min_price'] ?? null, fn($q, $v) => $q->where('price', '>=', (float) $v))
            ->when($filters['max_price'] ?? null, fn($q, $v) => $q->where('price', '<=', (float) $v))
            ->when($filters['vegetarian'] ?? null, fn($q, $v) => $v ? $q->vegetarian() : $q)
            ->when($filters['vegan'] ?? null, fn($q, $v) => $v ? $q->vegan() : $q)
            ->when($filters['gluten_free'] ?? null, fn($q, $v) => $v ? $q->glutenFree() : $q)
            ->when($filters['available'] ?? null, fn($q, $v) => $v ? $q->available() : $q);
    }

    public function getDietaryBadgesAttribute(): array{
        $badges = [];
        if ($this->is_vegetarian) {
            $badges[] = 'Vegetarian';
        }
        if ($this->is_vegan) {
            $badges[] = 'Vegan';
        }
        if ($this->is_gluten_free) {
            $badges[] = 'Gluten-Free';
        }
        return $badges;
    }

    public function recalcRating(): void{
        $avg = $this->orderItems()->whereHas('order', fn(Builder $q) => $q->where('status', 'delivered'))->avg('rating') ?? 0;
        $this->rating = round($avg, 2);
        $this->saveQuietly();
    }
}
