<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeHours extends Model
{
    use HasFactory;

    const STATUSES = [
        0 => 'Новый',
        1 => 'Подтвержден',
        2 => 'Отменен',
        3 => 'Исполнен',
    ];

    const TEMPLATES = [
        0 => [
            'day1_1' => '08:00:00',
            'day1_2' => '17:00:00',
            'day2_1' => '08:00:00',
            'day2_2' => '17:00:00',
            'day3_1' => '08:00:00',
            'day3_2' => '17:00:00',
            'day4_1' => '08:00:00',
            'day4_2' => '17:00:00',
            'day5_1' => '08:00:00',
            'day5_2' => '17:00:00',
        ],
        1 => [
            'day1_1' => '17:00:00',
            'day1_2' => '02:00:00',
            'day2_1' => '17:00:00',
            'day2_2' => '02:00:00',
            'day3_1' => '17:00:00',
            'day3_2' => '02:00:00',
            'day4_1' => '17:00:00',
            'day4_2' => '02:00:00',
            'day5_1' => '17:00:00',
            'day5_2' => '02:00:00',
        ],
        2 => [
            'day1_1' => '22:00:00',
            'day1_2' => '06:00:00',
            'day2_1' => '22:00:00',
            'day2_2' => '06:00:00',
            'day3_1' => '22:00:00',
            'day3_2' => '06:00:00',
            'day4_1' => '22:00:00',
            'day4_2' => '06:00:00',
            'day5_1' => '22:00:00',
            'day5_2' => '06:00:00',
        ],
    ];

    protected $table = 'change_hours';

    protected $fillable = [
        'user_id',
        'description',
        'shift',
        'status',
        'effective_date',
    ];

    public function status_name(){
        return self::STATUSES[$this->status] ?? '';
    }

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
