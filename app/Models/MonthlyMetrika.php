<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MonthlyMetrika extends Model
{
    use HasFactory;

    protected $table = 'metrics_monthly';

    protected $fillable = [
        'project_id',
        'year',
        'month',
        'visits',
        'users',
        'bounce_rate',
        'avg_session_duration_sec',
        'conversions',
    ];

    protected $casts = [
        'year' => 'integer',
        'month' => 'integer',
        'visits' => 'integer',
        'users' => 'integer',
        'bounce_rate' => 'decimal:2',
        'avg_session_duration_sec' => 'integer',
        'conversions' => 'integer',
    ];

    // Relationships
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    // Scopes
    public function scopeForPeriod($query, int $year, int $month)
    {
        return $query->where('year', $year)->where('month', $month);
    }

    public function scopeForYear($query, int $year)
    {
        return $query->where('year', $year);
    }

    // Helpers
    public function getPeriodAttribute(): string
    {
        return sprintf('%d-%02d', $this->year, $this->month);
    }
}