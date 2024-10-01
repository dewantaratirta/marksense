<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public $role_lists = [
        'superadmin',
        'administrator',
        'dokter',
        'pasien',
        'pasien',
        'perawat',
        // 'apoteker',
        // 'kasir',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createBatchRoles();
    }

    public function createBatchRoles(): void
    {
        $created = false;
        foreach ($this->role_lists as $role) {
            if (!$this->checkRoleExists($role)) {
                $created = true;
                Role::create(['name' => $role]);
                echo 'Role ' . $role . ' created.' . PHP_EOL;
            }
        }

        if (!$created) {
            echo 'All roles exists.' . PHP_EOL;
        }
    }

    public function checkRoleExists($name): bool
    {
        return Role::where('name', $name)->exists();
    }
}
