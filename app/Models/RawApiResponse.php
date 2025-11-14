<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RawApiResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'source',
        'endpoint', 
        'response_data',
        'request_params',
        'response_code',
        'processed_at',
    ];

    protected $casts = [
        'response_data' => 'array',
        'request_params' => 'array',
        'processed_at' => 'datetime',
    ];

    // Relationships
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    // Scopes
    public function scopeUnprocessed($query)
    {
        return $query->whereNull('processed_at');
    }

    public function scopeFromSource($query, string $source)
    {
        return $query->where('source', $source);
    }
}