<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'name' => 'Muxlisa',
                'email' => 'muxlisa@gmail.com',
                'password' => '123456',
                'fio' => 'Muxammadiyeva Muxlisa Erkinovna',
                'date_entry' => date("Y-m-d", strtotime("-5 days")),
                'position_id' => Position::select('id')->inRandomOrder()->first()->id,
                'department_id' => Department::select('id')->inRandomOrder()->first()->id,
                'education' => "O'rta maxsus",
                "education_name" => "Samarqand temir yo'l transporti kasb-hunar kolleji",
                "graduation_year" => 2020,
                "specialist" => "elektromexanik",
                "birthdate" => "2001-09-06",
                "birth_place" => "Samarqand viloyati",
                "gender" => 1,
                "nationality" => "O'zbek",
                "citizenship" => "O'zbekiston fuqarosi",
                "family_status" => "oilali",
            ],
            [
                'name' => 'Aziz',
                'email' => 'aziz@gmail.com',
                'password' => '123456',
                'fio' => 'Shodiyev Aziz Ismoilovich',
                'date_entry' => date("Y-m-d", strtotime("-5 days")),
                'position_id' => Position::select('id')->inRandomOrder()->first()->id,
                'department_id' => Department::select('id')->inRandomOrder()->first()->id,
                'education' => "Oliy",
                "education_name" => "Toshkent temir yo'l muhandislari instituti",
                "graduation_year" => 2020,
                "specialist" => "Er usti transport tizimlari",
                "birthdate" => "1985-08-24",
                "birth_place" => "Buxoro viloyati",
                "gender" => 1,
                "nationality" => "O'zbek",
                "citizenship" => "O'zbekiston fuqarosi",
                "family_status" => "oilali",
            ],
        ];

        $role = Role::create(['name' => 'Employee']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        foreach ($datas as $data){
            $usr = User::create($data);
            $usr->assignRole([$role->id]);
        }
    }
}
