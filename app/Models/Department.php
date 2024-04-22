<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property String $name
 * @property String $code
 * @property Integer $status
 * */


class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';

    protected $fillable = [
        'name',
        'code',
        'status',
    ];

    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['name'])) {
            $query->where('name', 'like', "%{$filters['name']}%");
        }
        if (isset($filters['code'])) {
            $query->where('code', 'like', "%{$filters['code']}%");
        }
        if (isset($filters['status'])) {
            $query->where('status', 'like', "%{$filters['status']}%");
        }
        return $query;
    }
}
