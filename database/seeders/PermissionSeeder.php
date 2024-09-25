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
            [
                'name' => "home-show",
                'info' => "Главная Показать",
            ],
            [
                'name' => 'home-index',
                'info' => "",
            ],
            [
                'name' => 'home-profile',
                'info' => "",
            ],
            // permission page
            [
                'name' => 'permission-show',
                'info' => "",
            ],
            [
                'name' => 'permission-index',
                'info' => "",
            ],
            [
                'name' => 'permission-create',
                'info' => "",
            ],
            [
                'name' => 'permission-store',
                'info' => "",
            ],
            [
                'name' => 'permission-edit',
                'info' => "",
            ],
            [
                'name' => 'permission-update',
                'info' => "",
            ],
            [
                'name' => 'permission-destroy',
                'info' => "",
            ],
            // role page
            [
                'name' => 'role-index',
                'info' => "",
            ],
            [
                'name' => 'role-filter',
                'info' => "",
            ],
            [
                'name' => 'role-show',
                'info' => "",
            ],
            [
                'name' => 'role-create',
                'info' => "",
            ],
            [
                'name' => 'role-store',
                'info' => "",
            ],
            [
                'name' => 'role-edit',
                'info' => "",
            ],
            [
                'name' => 'role-update',
                'info' => "",
            ],
            [
                'name' => 'role-destroy',
                'info' => "",
            ],
            // user page
            [
                'name' => 'user-index',
                'info' => "",
            ],
            [
                'name' => 'user-filter',
                'info' => "",
            ],
            [
                'name' => 'user-create',
                'info' => "",
            ],
            [
                'name' => 'user-store',
                'info' => "",
            ],
            [
                'name' => 'user-show',
                'info' => "",
            ],
            [
                'name' => 'user-edit',
                'info' => "",
            ],
            [
                'name' => 'user-update',
                'info' => "",
            ],
            [
                'name' => 'user-destroy',
                'info' => "",
            ],
            // employee
            [
                'name' => 'employee-index',
                'info' => "",
            ],
            [
                'name' => 'employee-filter',
                'info' => "",
            ],
            [
                'name' => 'employee-show',
                'info' => "",
            ],
            [
                'name' => 'employee-create',
                'info' => "",
            ],
            [
                'name' => 'employee-store',
                'info' => "",
            ],
            [
            
                'name' => 'employee-edit',
                'info' => "",
            ],
            [
                'name' => 'employee-update',
                'info' => "",
            ],
            [
                'name' => 'employee-destroy',
                'info' => "",
            ],
            [
                'name' => 'employee-change-template',
                'info' => "",
            ],
            [
                'name' => 'employee-change-template-submit',
                'info' => "",
            ],
            [
                'name' => 'employee-change-individual',
                'info' => "",
            ],
            [
                'name' => 'employee-change-individual-submit',
                'info' => "",
            ],
            [
                'name' => 'employee-download_file',
                'info' => "",
            ],
            [
                'name' => 'employee-change_individual',
                'info' => "",
            ],
            [
                'name' => 'employee-change-working-hours',
                'info' => "",
            ],
            // Position
            [
                'name' => 'position-index',
                'info' => "",
            ],
            [
                'name' => 'position-filter',
                'info' => "",
            ],
            [
                'name' => 'position-show',
                'info' => "",
            ],
            [
                'name' => 'position-create',
                'info' => "",
            ],
            [
                'name' => 'position-store',
                'info' => "",
            ],
            [
                'name' => 'position-edit',
                'info' => "",
            ],
            [
                'name' => 'position-update',
                'info' => "",
            ],
            [
                'name' => 'position-destroy',
                'info' => "",
            ],
            // Department
            [
                'name' => 'department-index',
                'info' => "",
            ],
            [
                'name' => 'department-filter',
                'info' => "",
            ],
            [
                'name' => 'department-show',
                'info' => "",
            ],
            [
                'name' => 'department-create',
                'info' => "",
            ],
            [
                'name' => 'department-store',
                'info' => "",
            ],
            [
                'name' => 'department-edit',
                'info' => "",
            ],
            [
                'name' => 'department-update',
                'info' => "",
            ],
            [
                'name' => 'department-destroy',
                'info' => "",
            ],
            // TT
            [
                'name' => 'tt-index',
                'info' => "",
            ],
            [
                'name' => 'tt-filter',
                'info' => "",
            ],
            [
                'name' => 'tt-show',
                'info' => "",
            ],
            [
                'name' => 'tt-create',
                'info' => "",
            ],
            [
                'name' => 'tt-store',
                'info' => "",
            ],
            [
                'name' => 'tt-edit',
                'info' => "",
            ],
            [
                'name' => 'tt-update',
                'info' => "",
            ],
            [
                'name' => 'tt-destroy',
                'info' => "",
            ],
            // Cadre
            [
                'name' => 'cadre-index',
                'info' => "",
            ],
            [
                'name' => 'cadre-filter',
                'info' => "",
            ],
            [
                'name' => 'cadre-show',
                'info' => "",
            ],
            [
                'name' => 'cadre-create',
                'info' => "",
            ],
            [
                'name' => 'cadre-store',
                'info' => "",
            ],
            [
                'name' => 'cadre-edit',
                'info' => "",
            ],
            [
                'name' => 'cadre-update',
                'info' => "",
            ],
            [
                'name' => 'cadre-destroy',
                'info' => "",
            ],
            [
                'name' => 'cadre-changeStatus',
                'info' => "",
            ],
            [
                'name' => 'cadre-report',
                'info' => "",
            ],
            [
                'name' => 'cadre-weekend',
                'info' => "",
            ],
            [
                'name' => 'cadre-all',
                'info' => "",
            ],
            // Bugalter
            [
                'name' => 'bugalter-index',
                'info' => "",
            ],
            [
                'name' => 'bugalter-filter',
                'info' => "",
            ],
            [
                'name' => 'bugalter-show',
                'info' => "",
            ],
            [
                'name' => 'bugalter-create',
                'info' => "",
            ],
            [
                'name' => 'bugalter-store',
                'info' => "",
            ],
            [
                'name' => 'bugalter-edit',
                'info' => "",
            ],
            [
                'name' => 'bugalter-update',
                'info' => "",
            ],
            [
                'name' => 'bugalter-destroy',
                'info' => "",
            ],
            // Holiday
            [
                'name' => 'holiday-index',
                'info' => "",
            ],
            [
                'name' => 'holiday-filter',
                'info' => "",
            ],
            [
                'name' => 'holiday-show',
                'info' => "",
            ],
            [
                'name' => 'holiday-create',
                'info' => "",
            ],
            [
                'name' => 'holiday-store',
                'info' => "",
            ],
            [
                'name' => 'holiday-edit',
                'info' => "",
            ],
            [
                'name' => 'holiday-update',
                'info' => "",
            ],
            [
                'name' => 'holiday-destroy',
                'info' => "",
            ],
            // Change Hours
            [
                'name' => 'changehour-index',
                'info' => "",
            ],
            [
                'name' => 'changehour-allow',
                'info' => "",
            ],
            [
                'name' => 'changehour-cancel',
                'info' => "",
            ],
            // Weekend
            [
                'name' => 'weekend-index',
                'info' => "",
            ],
            [
                'name' => 'weekend-allow',
                'info' => "",
            ],
            [
                'name' => 'weekend-cancel',
                'info' => "",
            ],
            // Bs
            [
                'name' => 'bs-index',
                'info' => "",
            ],
            [
                'name' => 'bs-filter',
                'info' => "",
            ],
            [
                'name' => 'bs-show',
                'info' => "",
            ],
            [
                'name' => 'bs-create',
                'info' => "",
            ],
            [
                'name' => 'bs-store',
                'info' => "",
            ],
            [
                'name' => 'bs-edit',
                'info' => "",
            ],
            [
                'name' => 'bs-update',
                'info' => "",
            ],
            [
                'name' => 'bs-destroy',
                'info' => "",
            ],
        ];
        foreach ($permissionList as $item => $value){
            Permission::create($value);
        }
    }
}
