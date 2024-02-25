<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'name' => '88 - department',
                'code' => 88,
                'status' => 1,
            ],
            [
                'name' => '277 - department',
                'code' => 277,
                'status' => 1,
            ],
            [
                'name' => '22 - department',
                'code' => 22,
                'status' => 1,
            ],
            [
                'name' => '11 - department',
                'code' => 11,
                'status' => 1,
            ],
            [
                'name' => '59 - department',
                'code' => 59,
                'status' => 1,
            ],
        ];
        foreach ($datas as $data){
            Department::create($data);
        }
    }
}
