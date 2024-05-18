<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cache roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::create(['name' => 'manage events']);
        Permission::create(['name' => 'manage transactions']);
        Permission::create(['name' => 'create transactions']);

        // Create roles and assign existing permissions
        $superAdmin = Role::create(['name' => 'super admin']);
        $admin = Role::create(['name' => 'admin']);
        $cashier = Role::create(['name' => 'cashier']);

        // Assign permissions to roles
        $superAdmin->givePermissionTo(Permission::all());
        $admin->givePermissionTo(['manage events', 'manage transactions']);
        $cashier->givePermissionTo('create transactions');
    }
}
