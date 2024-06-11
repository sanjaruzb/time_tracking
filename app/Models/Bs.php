<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bs extends Model
{
    use HasFactory;

    protected $table = 'bs';

    protected $guarded = [];

    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['number'])) {
            $query->where('number', $filters['number']);
        }
        if (isset($filters['auth_date'])) {
            $query->where('auth_date',$filters['auth_date']);
        }
        if (isset($filters['start'])) {
            $query->where('start',$filters['start']);
        }
        if (isset($filters['end'])) {
            $query->where('end',$filters['end']);
        }
        if (isset($filters['hour'])) {
            $query->where('hour',$filters['hour']);
        }
        return $query;
    }

    public function employee()
    {
        return $this->belongsTo(User::class,'number','number');
    }
}
