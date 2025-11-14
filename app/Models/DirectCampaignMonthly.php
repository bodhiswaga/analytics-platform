<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DirectCampaignMonthly extends Model
{
    use HasFactory;

    protected $table = 'direct_campaign_monthly';

    protected $fillable = [
        'project_id',
        'direct_campaign_id',
        'year',
        'month',
        'impressions',
        'clicks',
        'ctr_pct',
        'cpc',
        'conversions',
        'cpa',
        'cost',
    ];

    protected $casts = [
        'year' => 'integer',
        'month' => 'integer',
        'impressions' => 'integer',
        'clicks' => 'integer',
        'ctr_pct' => 'decimal:2',
        'cpc' => 'decimal:12,2',
        'conversions' => 'integer',
        'cpa' => 'decimal:12,2',
        'cost' => 'decimal:14,2',
    ];

    // Relationships
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class, 'direct_campaign_id');
    }

    // Scopes
    public function scopeForPeriod($query, int $year, int $month)
    {
        return $query->where('year', $year)->where('month', $month);
    }

    // Helpers
    public function getCtrAttribute(): float
    {
        return $this->ctr_pct / 100;
    }
}