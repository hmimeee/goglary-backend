<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // User permissions
            'view users',
            'create users',
            'edit users',
            'delete users',

            // Product permissions
            'view products',
            'create products',
            'edit products',
            'delete products',

            // Category permissions
            'view categories',
            'create categories',
            'edit categories',
            'delete categories',

            // Brand permissions
            'view brands',
            'create brands',
            'edit brands',
            'delete brands',

            // Order permissions
            'view orders',
            'create orders',
            'edit orders',
            'delete orders',

            // Settings permissions
            'view settings',
            'manage settings',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin']);
        $superAdminRole->givePermissionTo(Permission::all());

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo([
            'view users', 'create users', 'edit users',
            'view products', 'create products', 'edit products', 'delete products',
            'view categories', 'create categories', 'edit categories', 'delete categories',
            'view brands', 'create brands', 'edit brands', 'delete brands',
            'view orders', 'edit orders',
            'view settings', 'manage settings'
        ]);

        $moderatorRole = Role::firstOrCreate(['name' => 'moderator']);
        $moderatorRole->givePermissionTo([
            'view users',
            'view products', 'edit products',
            'view categories', 'edit categories',
            'view brands', 'edit brands',
            'view orders', 'edit orders'
        ]);

        $editorRole = Role::firstOrCreate(['name' => 'editor']);
        $editorRole->givePermissionTo([
            'view products', 'create products', 'edit products',
            'view categories', 'create categories', 'edit categories',
            'view brands', 'create brands', 'edit brands'
        ]);

        $customerRole = Role::firstOrCreate(['name' => 'customer']);
        $customerRole->givePermissionTo([
            'view products',
            'view categories',
            'view brands'
        ]);
    }
}
