<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bugalter = Role::create(['name' => 'Bugalter']);
        $cadre = Role::create(['name' => 'Cadre']);
        $admin = Role::create(['name' => 'Admin']);
        $permissions = Permission::pluck('id', 'id')->all();
        $bugalter->syncPermissions($permissions);
        $cadre->syncPermissions($permissions);
        $admin->syncPermissions($permissions);
    }
}
