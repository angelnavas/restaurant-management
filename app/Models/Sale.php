<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    protected $fillable = [
        'sale_date',
        'number',
    ];

    protected $casts = [
        'sale_date' => 'date',
    ];

    public function saleLines(): HasMany
    {
        return $this->hasMany(SaleLine::class);
    }

    public function getTotalAmount(): float
    {
        return $this->saleLines->sum(function ($line) {
            return $line->getLineAmount();
        });
    }
}