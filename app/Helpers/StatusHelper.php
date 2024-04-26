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

    public static $ttStatus = [
        1 => "Простой",
        2 => "Без причины",
        3 => "Причины",
    ];

    public static function getTtStatus($index){
        return self::$ttStatus[$index] ?? 'Неопределенный';
    }
}
