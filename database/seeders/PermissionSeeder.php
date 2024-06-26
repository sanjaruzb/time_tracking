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
            ['name' => 'home-index'],
            ['name' => 'home-profile'],
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
            ['name' => 'user-create'],
            ['name' => 'user-store'],
            ['name' => 'user-show'],
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
            ['name' => 'employee-change-template'],
            ['name' => 'employee-change-template-submit'],
            ['name' => 'employee-change-individual'],
            ['name' => 'employee-change-individual-submit'],
            ['name' => 'employee-download_file'],
            ['name' => 'employee-change_individual'],
            ['name' => 'employee-change-working-hours'],
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
            ['name' => 'tt-create'],
            ['name' => 'tt-store'],
            ['name' => 'tt-edit'],
            ['name' => 'tt-update'],
            ['name' => 'tt-destroy'],
            // Cadre
            ['name' => 'cadre-index'],
            ['name' => 'cadre-filter'],
            ['name' => 'cadre-show'],
            ['name' => 'cadre-create'],
            ['name' => 'cadre-store'],
            ['name' => 'cadre-edit'],
            ['name' => 'cadre-update'],
            ['name' => 'cadre-destroy'],
            ['name' => 'cadre-changeStatus'],
            ['name' => 'cadre-report'],
            ['name' => 'cadre-weekend'],
            ['name' => 'cadre-all'],
            // Bugalter
            ['name' => 'bugalter-index'],
            ['name' => 'bugalter-filter'],
            ['name' => 'bugalter-show'],
            ['name' => 'bugalter-create'],
            ['name' => 'bugalter-store'],
            ['name' => 'bugalter-edit'],
            ['name' => 'bugalter-update'],
            ['name' => 'bugalter-destroy'],
            // Holiday
            ['name' => 'holiday-index'],
            ['name' => 'holiday-filter'],
            ['name' => 'holiday-show'],
            ['name' => 'holiday-create'],
            ['name' => 'holiday-store'],
            ['name' => 'holiday-edit'],
            ['name' => 'holiday-update'],
            ['name' => 'holiday-destroy'],
            // Change Hours
            ['name' => 'changehour-index'],
            ['name' => 'changehour-allow'],
            ['name' => 'changehour-cancel'],
            // Weekend
            ['name' => 'weekend-index'],
            ['name' => 'weekend-allow'],
            ['name' => 'weekend-cancel'],
            // Bs
            ['name' => 'bs-index'],
            ['name' => 'bs-filter'],
            ['name' => 'bs-show'],
            ['name' => 'bs-create'],
            ['name' => 'bs-store'],
            ['name' => 'bs-edit'],
            ['name' => 'bs-update'],
            ['name' => 'bs-destroy'],
        ];
        foreach ($permissionList as $item => $value){
            Permission::create($value);
        }
    }
}
