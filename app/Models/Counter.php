<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Counter extends Model
{
    use HasFactory;

    protected $table = 'yandex_counters';

    protected $fillable = [
        'project_id',
        'counter_id', 
        'name',
        'is_primary',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'counter_id' => 'integer',
    ];

    protected $attributes = [
        'is_primary' => false,
    ];

    // Relationships
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function goals(): HasMany
    {
        return $this->hasMany(Goal::class, 'counter_id');
    }

    // Scopes
    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }
}