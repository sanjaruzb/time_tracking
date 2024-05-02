<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    static $statuses = [
        0 => 'Yangi',
        1 => 'Sababli',
        2 => 'Sababsiz',
        3 => 'Norma',
    ];

    static $arrival_statuses = [
        1 => 'kemagan',
        2 => 'vaqtida kegan',
        3 => 'kechikib kegan',
        -1=> 'ketmagan',
        -2=> 'vaqtida ketgan',
        -3=> 'erta ketgan',
    ];

    static $infoType = [
        0 => 'Otpuska',
        1 => 'Kamandirochniy',
        2 => 'Balnichni',
    ];
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
        'status',
        'info_type',
        'arrival_status',
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
        if (isset($filters['department'])) {

            $query->whereHas('department', function (Builder $query) use ($filters) {
                $query->where('name', 'LIKE', "%{$filters['department']}%");
            });

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

    public function user(){
        return $this->hasOne(User::class, 'number','number');
    }

    public function department(){
        return $this->hasOneThrough(Department::class,User::class,'number','id','number','department_id');
    }

    public function arrival_status_name(){
        return self::$arrival_statuses[$this->arrival_status];
    }
}
