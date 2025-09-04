<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
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

            // Order permissions
            'view orders',
            'create orders',
            'edit orders',
            'delete orders',

            // Role permissions
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',

            // Permission permissions
            'view permissions',
            'create permissions',
            'edit permissions',
            'delete permissions',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin']);
        $superAdminRole->givePermissionTo(Permission::all());

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminPermissions = [
            'view users', 'create users', 'edit users',
            'view products', 'create products', 'edit products', 'delete products',
            'view categories', 'create categories', 'edit categories', 'delete categories',
            'view orders', 'edit orders',
            'view roles'
        ];
        $adminRole->givePermissionTo($adminPermissions);

        $moderatorRole = Role::firstOrCreate(['name' => 'moderator']);
        $moderatorPermissions = [
            'view users',
            'view products', 'edit products',
            'view categories',
            'view orders', 'edit orders'
        ];
        $moderatorRole->givePermissionTo($moderatorPermissions);

        // Create super admin user
        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@goglary.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $superAdmin->assignRole('super-admin');

        // Create regular admin user
        $admin = User::firstOrCreate(
            ['email' => 'manager@goglary.com'],
            [
                'name' => 'Store Manager',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('admin');

        $this->command->info('Admin seeder completed successfully!');
        $this->command->info('Super Admin: admin@goglary.com / password');
        $this->command->info('Store Manager: manager@goglary.com / password');
    }
}
