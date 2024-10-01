<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public $role_list = [];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create superadmin
        $superadmin = User::create([
            'name' => 'Superadmin',
            'username' => 'superadmin',
            'email' => 'superadmin@mail.com',
            'password' => Hash::make('12345678'),
        ]);
        $superadmin->assignRole('superadmin');

        //create admin
        $admin = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('12345678'),
        ]);
        $admin->assignRole('administrator');
    }
}
