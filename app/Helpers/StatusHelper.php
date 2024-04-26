<?php

namespace App\Helpers;

class StatusHelper
{
    public static $commonStatus = [
        1 => '✅ Активный',
        0 => '❌ Архив',
    ];

    public static function getCommonStatus($index){
        return self::$commonStatus[$index] ?? 'Неопределенный';
    }
}
