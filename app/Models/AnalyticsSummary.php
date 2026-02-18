<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalyticsSummary extends Model
{
    use HasFactory;

    protected $table = 'analytics_summary';

    protected $fillable = [
        'date',
        'metric_type',
        'metric_subtype',
        'value',
        'count',
        'metadata',
    ];

    protected $casts = [
        'date' => 'date',
        'value' => 'decimal:2',
        'metadata' => 'array',
    ];

    public static function record(string $type, string $subtype = null, float $value = 0, int $count = 1, array $metadata = null): void
    {
        $today = now()->startOfDay();
        
        $summary = self::firstOrCreate(
            [
                'date' => $today,
                'metric_type' => $type,
                'metric_subtype' => $subtype,
            ],
            [
                'value' => 0,
                'count' => 0,
                'metadata' => $metadata,
            ]
        );

        $summary->increment('value', $value);
        $summary->increment('count', $count);
        
        if ($metadata) {
            $existingMetadata = $summary->metadata ?? [];
            $summary->metadata = array_merge($existingMetadata, $metadata);
            $summary->save();
        }
    }

    public static function getSummary(string $type, string $subtype = null, $days = 30): array
    {
        $query = self::where('metric_type', $type);
        
        if ($subtype) {
            $query->where('metric_subtype', $subtype);
        }
        
        if ($days) {
            $query->where('date', '>=', now()->subDays($days));
        }
        
        return $query->orderBy('date')
            ->get()
            ->toArray();
    }
}