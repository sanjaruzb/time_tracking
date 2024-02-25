<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'name' => " 88-shtamp va pressformalarni ishlab chiqarish tsexida materiallar bo'yicha texnik",
                'status' => 1,
            ],
            [
                'name' => " 277-  tsexida katta usta",
                'status' => 1,
            ],
            [
                'name' => " 22- tsex boshlig'i o'rinbosari",
                'status' => 1,
            ],
        ];
        foreach ($datas as $data){
            Position::create($data);
        }
    }
}
