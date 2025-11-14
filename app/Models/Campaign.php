<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campaign extends Model
{
    use HasFactory;

    protected $table = 'direct_campaigns';

    protected $fillable = [
        'direct_account_id',
        'campaign_id',
        'name',
        'status',
    ];

    protected $casts = [
        'campaign_id' => 'integer',
    ];

    // Relationships
    public function directAccount(): BelongsTo
    {
        return $this->belongsTo(DirectAccount::class);
    }

    public function directCampaignsMonthly(): HasMany
    {
        return $this->hasMany(DirectCampaignMonthly::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}