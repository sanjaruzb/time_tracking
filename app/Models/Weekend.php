<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weekend extends Model
{
    use HasFactory;

    protected $table = 'weekends';

    protected $guarded = [];

    const STATUSES = [
        0 => 'Новый',
        1 => 'Подтвержден',
        2 => 'Отменен',
        3 => 'Исполнен',
    ];

    public function status_name(){
        return self::STATUSES[$this->status] ?? '';
    }

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function files()
    {
        return $this->hasMany(File::class,'model_id','id')->where('model',self::class);
    }
}
