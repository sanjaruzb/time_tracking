<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionList = [
            // home page
            ['name' => 'home-show'],
            // permission page
            ['name' => 'permission-show'],
            ['name' => 'permission-index'],
            ['name' => 'permission-create'],
            ['name' => 'permission-store'],
            ['name' => 'permission-edit'],
            ['name' => 'permission-update'],
            ['name' => 'permission-destroy'],
            // role page
            ['name' => 'role-index'],
            ['name' => 'role-filter'],
            ['name' => 'role-show'],
            ['name' => 'role-create'],
            ['name' => 'role-store'],
            ['name' => 'role-edit'],
            ['name' => 'role-update'],
            ['name' => 'role-destroy'],
            // user page
            ['name' => 'user-index'],
            ['name' => 'user-filter'],
            ['name' => 'user-show'],
            ['name' => 'user-create'],
            ['name' => 'user-store'],
            ['name' => 'user-edit'],
            ['name' => 'user-update'],
            ['name' => 'user-destroy'],
            // employee
            ['name' => 'employee-index'],
            ['name' => 'employee-filter'],
            ['name' => 'employee-show'],
            ['name' => 'employee-create'],
            ['name' => 'employee-store'],
            ['name' => 'employee-edit'],
            ['name' => 'employee-update'],
            ['name' => 'employee-destroy'],
            // Position
            ['name' => 'position-index'],
            ['name' => 'position-filter'],
            ['name' => 'position-show'],
            ['name' => 'position-create'],
            ['name' => 'position-store'],
            ['name' => 'position-edit'],
            ['name' => 'position-update'],
            ['name' => 'position-destroy'],
            // Department
            ['name' => 'department-index'],
            ['name' => 'department-filter'],
            ['name' => 'department-show'],
            ['name' => 'department-create'],
            ['name' => 'department-store'],
            ['name' => 'department-edit'],
            ['name' => 'department-update'],
            ['name' => 'department-destroy'],
            // TT
            ['name' => 'tt-index'],
            ['name' => 'tt-filter'],
            ['name' => 'tt-show'],
            ['name' => 'tt-store'],
            ['name' => 'tt-edit'],
            ['name' => 'tt-update'],
            ['name' => 'tt-destroy'],
        ];
        foreach ($permissionList as $item => $value){
            Permission::create($value);
        }
    }
}
