<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;
//use Maatwebsite\Excel\Concerns\ToModel;
//use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Report implements ToArray //ToModel, WithHeadingRow
{
//    public function model(array $row)
//    {
//        if (!empty($row['Идентификатор человека'])) {
//            return [
//                'identifier' => $row['Идентификатор человека'],
//                'name' => $row['Имя'],
//                'department' => $row['Департамент'],
//                'position' => $row['Должность'],
//                'gender' => $row['Пол'],
//                'date' => $row['Дата'],
//                'day_of_week' => $row['День недели'],
//                'schedule' => $row['Расписание'],
//                'first_entry' => $row['Первый вход'],
//                'last_exit' => $row['Последний выход'],
//            ];
//        }
//    }

    public function array(array $array)
    {
        return $array;
    }
}
