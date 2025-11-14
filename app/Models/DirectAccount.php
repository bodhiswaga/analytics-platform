<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DirectAccount extends Model
{
    use HasFactory;

    protected $table = 'direct_accounts';

    protected $fillable = [
        'project_id',
        'client_login',
        'account_name',
    ];

    // Relationships
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function campaigns(): HasMany
    {
        return $this->hasMany(Campaign::class);
    }

    public function directCampaignsMonthly(): HasMany
    {
        return $this->hasMany(DirectCampaignMonthly::class);
    }
}