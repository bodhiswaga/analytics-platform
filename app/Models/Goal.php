<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Goal extends Model
{
    use HasFactory;

    protected $fillable = [
        'counter_id',
        'goal_id',
        'name',
        'is_conversion',
    ];

    protected $casts = [
        'goal_id' => 'integer',
        'is_conversion' => 'boolean',
    ];

    protected $attributes = [
        'is_conversion' => false,
    ];

    // Relationships
    public function counter(): BelongsTo
    {
        return $this->belongsTo(Counter::class, 'counter_id');
    }

    // Scopes
    public function scopeConversion($query)
    {
        return $query->where('is_conversion', true);
    }
}