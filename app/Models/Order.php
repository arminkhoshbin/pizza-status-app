<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    private const ORDER_STATUSES = [
        [
            'status' => 'making',
            'label' => 'Making the pizza',
        ],
        [
            'status' => 'cooking',
            'label' => 'Pizza is in the oven',
        ],
        [
            'status' => 'ready',
            'label' => 'Pizza is ready!',
        ],
    ];

    public function history(): HasMany
    {
        return $this->hasMany(OrderHistory::class, 'order_id', 'id');
    }

    public function scopeForUser($query, User $user)
    {
        return $query->where('user_id', $user->id);
    }

    public function nextAvailableOrderStatus(): ?array
    {
        $oldStatus = $this->history->pluck('status')->toArray();

        return collect(self::ORDER_STATUSES)
            ->reject(fn ($status) => in_array($status['status'], $oldStatus))
            ->first();
    }

    public function latestOrderStatus(): ?string
    {
        return optional($this->history()->latest()->first())->status;
    }
}