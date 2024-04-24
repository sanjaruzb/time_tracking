<?php

namespace App\Helpers;

class HolidayHelper
{
    public static $holidays = [
        '1' => 'Дополнительное время',
        '-1' => 'Праздничное время',
    ];

    public static function getHoliday($index){
        return self::$holidays[$index] ?? 'Undefined';
    }
}
