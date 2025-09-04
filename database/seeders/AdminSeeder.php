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
        // Create roles and assign permissions
        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin']);
        $superAdminRole->givePermissionTo(Permission::all());

        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $adminPermissions = [
            'view users', 'create users', 'edit users',
            'view products', 'create products', 'edit products', 'delete products',
            'view categories', 'create categories', 'edit categories', 'delete categories',
            'view orders', 'edit orders'
        ];
        $adminRole->givePermissionTo($adminPermissions);

        $moderatorRole = Role::firstOrCreate(['name' => 'Moderator']);
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

        $customerRole = Role::firstOrCreate(['name' => 'Customer']);

        $this->command->info('Admin seeder completed successfully!');
        $this->command->info('Super Admin: admin@goglary.com / password');
        $this->command->info('Store Manager: manager@goglary.com / password');
    }
}
