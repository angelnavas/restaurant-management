<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaleLine extends Model
{
    protected $fillable = [
        'sale_id',
        'recipe_id',
        'quantity',
        'override_price',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'override_price' => 'decimal:2',
    ];

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    public function recipe(): BelongsTo
    {
        return $this->belongsTo(Recipe::class);
    }

    public function getLineAmount(): float
    {
        $price = $this->override_price ?? $this->recipe->selling_price;
        return $price * $this->quantity;
    }
}