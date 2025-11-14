<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug', 
        'timezone',
        'currency',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $attributes = [
        'timezone' => 'Europe/Moscow',
        'currency' => 'RUB',
        'is_active' => true,
    ];

    // Relationships
    public function counters(): HasMany
    {
        return $this->hasMany(Counter::class);
    }

    public function directAccounts(): HasMany
    {
        return $this->hasMany(DirectAccount::class);
    }

    public function monthlyMetrika(): HasMany
    {
        return $this->hasMany(MonthlyMetrika::class);
    }

    public function monthlyAgeGroup(): HasMany
    {
        return $this->hasMany(MonthlyAgeGroup::class);
    }

    public function monthlyDirect(): HasMany
    {
        return $this->hasMany(MonthlyDirect::class);
    }

    public function monthlySeo(): HasMany
    {
        return $this->hasMany(MonthlySeo::class);
    }

    public function rawApiResponses(): HasMany
    {
        return $this->hasMany(RawApiResponse::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeWithPrimaryCounter($query)
    {
        return $query->whereHas('counters', function ($q) {
            $q->where('is_primary', true);
        });
    }
}