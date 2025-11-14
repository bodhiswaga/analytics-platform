<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MonthlySeo extends Model
{
    use HasFactory;

    protected $table = 'seo_queries_monthly';

    protected $fillable = [
        'project_id',
        'year',
        'month',
        'query',
        'position',
        'url',
    ];

    protected $casts = [
        'year' => 'integer',
        'month' => 'integer',
        'position' => 'integer',
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

    public function scopeTopPositions($query, int $limit = 10)
    {
        return $query->where('position', '<=', $limit)->orderBy('position');
    }
}