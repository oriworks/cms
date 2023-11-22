<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Roles
        $superAdmin = \App\Models\Role::where('name', 'super-admin')->first();

        // Permissions
        $this->createResource('users');
        $this->createResource('roles');
        $this->createResource('permissions');

        // Assign all permissions to super-admin
        $superAdmin->givePermissionTo(\App\Models\Permission::all());
    }

    private function createResource(string $name, array $additionalPermissions = [])
    {
        $basicPermissions = [
            'viewAny',
            'view',
            'create',
            'update',
            'delete',
            'restore',
            'forceDelete',
        ];
        foreach ($basicPermissions as $permission) {
            \App\Models\Permission::create(['name' => $name . '.' . $permission]);
        }
        foreach ($additionalPermissions as $permission) {
            \App\Models\Permission::create(['name' => $name . '.' . $permission]);
        }
    }
}
