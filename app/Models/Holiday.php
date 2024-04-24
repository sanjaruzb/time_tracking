<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    protected $table = 'holidays';

    static $additional_time = 1;
    static $holiday_time = -1;
    protected $fillable = [
        'date',
        'hour',
        'type',
    ];

    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['date'])) {
            $query->where('date', $filters['date']);
        }
        if (isset($filters['hour'])) {
            $query->where('hour', $filters['hour']);
        }
        if (isset($filters['type'])) {
            $query->where('type', $filters['type']);
        }
        return $query;
    }
}

