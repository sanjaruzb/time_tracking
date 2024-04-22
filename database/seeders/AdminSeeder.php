<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::where('name','Admin')->first();
        $user = User::create([
            'firstname' => 'Shukrullo',
            'lastname' => 'Fatulloyev',
            'email' => 'shukrullo@gmail.com',
            'password' => Hash::make('123456'),
        ]);
        $user1 = User::create([
            'firstname' => 'Sanjar',
            'lastname' => 'Makhmudjanov',
            'email' => 'sanjar@gmail.com',
            'password' => Hash::make('123456'),
        ]);
        $user->assignRole([$role->id]);
        $user1->assignRole([$role->id]);

        $user2 = User::create([
            'firstname' => 'Alisher',
            'lastname' => 'Alisherov',
            'email' => 'alisher@gmail.com',
            'password' => Hash::make('654321'),
        ]);
        $user2->assignRole([$role->id]);
    }
}
