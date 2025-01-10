<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];

    public static function findByAmount(float $amount): ?self
    {
        return self::query()
            ->where('amount', $amount)
            ->where('created_at', '>=', now()->subHours())
            ->latest()
            ->first();
    }
}
