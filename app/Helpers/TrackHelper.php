<?php

namespace App\Helpers;

class TrackHelper
{
    public static $tracks = [
        '1' => 'вход',
        '-1' => 'выход',
    ];

    public static function getTrack($index){
        return self::$tracks[$index] ?? 'Undefined';
    }
}
