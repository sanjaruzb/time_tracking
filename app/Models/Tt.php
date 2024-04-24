<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property String $number
 * @property Timestamp $auth_datetime
 * @property Date $auth_date
 * @property Time $auth_time
 * @property Enum $track
 * @property String $turn
 * @property String $turn_serial
 * @property String $name
 * @property String $card_number
 * */


class Tt extends Model
{
    use HasFactory;

    protected $table = 'tt';

    static $kirish = 1;
    static $chiqish = -1;

    protected $fillable = [
        'number',
        'auth_datetime',
        'auth_date',
        'auth_time',
        'track',
        'turn',
        'turn_serial',
        'name',
        'card_number',
        'info',
    ];

    public function files()
    {
        return $this->hasMany(File::class,'model_id','id')->where('model',self::class);
    }
    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['number'])) {
            $query->where('number', $filters['number']);
        }
        if (isset($filters['name'])) {
            $query->where('name', 'like', "%{$filters['name']}%");
        }
        if (isset($filters['auth_date'])) {
            $query->where('auth_date', $filters['auth_date']);
        }
        if (isset($filters['auth_time'])) {
            $query->where('auth_time', $filters['auth_time']);
        }
        if (isset($filters['track'])) {
            $query->where('track', $filters['track']);
        }
        return $query;
    }
}
