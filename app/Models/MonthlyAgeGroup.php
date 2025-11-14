<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MonthlyAgeGroup extends Model
{
    use HasFactory;

    protected $table = 'metrics_age_monthly';

    protected $fillable = [
        'project_id',
        'year',
        'month',
        'age_group',
        'visits',
        'users', 
        'bounce_rate',
        'avg_session_duration_sec',
    ];

    protected $casts = [
        'year' => 'integer',
        'month' => 'integer',
        'visits' => 'integer',
        'users' => 'integer',
        'bounce_rate' => 'decimal:2',
        'avg_session_duration_sec' => 'integer',
    ];

    const AGE_GROUPS = [
        '18-24',
        '25-34', 
        '35-44',
        '45-54', 
        '55+',
        'unknown'
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

    public function scopeForAgeGroup($query, string $ageGroup)
    {
        return $query->where('age_group', $ageGroup);
    }
}