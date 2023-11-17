<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Entrada extends Model
{
    protected $fillable = [
        'name',
        'description',
        'cost',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($entrada) {
            $entrada->user_id = auth()->id();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}