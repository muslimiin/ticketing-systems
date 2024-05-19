<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * Class RolePermissionSeeder.
 *
 * @see https://spatie.be/docs/laravel-permission/v5/basic-usage/multiple-guards
 *
 * @package App\Database\Seeds
 */
class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            // Permissions grouped by their functionality
            [
                'group_name' => 'dashboard',
                'permissions' => [
                    'dashboard.view',
                    'dashboard.edit',
                ]
            ],
            [
                'group_name' => 'event',
                'permissions' => [
                    'event.create',
                    'event.view',
                    'event.edit',
                    'event.delete',
                ]
            ],
            [
                'group_name' => 'ticket',
                'permissions' => [
                    'ticket.create',
                    'ticket.view',
                    'ticket.edit',
                    'ticket.delete',
                ]
            ],
            [
                'group_name' => 'transaction',
                'permissions' => [
                    'transaction.create',
                    'transaction.view',
                    'transaction.edit',
                    'transaction.delete',
                ]
            ],
            [
                'group_name' => 'reports',
                'permissions' => [
                    'reports',
                ]
            ],
            [
                'group_name' => 'admin',
                'permissions' => [
                    'admin.create',
                    'admin.view',
                    'admin.edit',
                    'admin.delete',
                    'admin.approve',
                ]
            ],
            [
                'group_name' => 'role',
                'permissions' => [
                    'role.create',
                    'role.view',
                    'role.edit',
                    'role.delete',
                    'role.approve',
                ]
            ],
            [
                'group_name' => 'profile',
                'permissions' => [
                    'profile.view',
                    'profile.edit',
                    'profile.delete',
                    'profile.update',
                ]
            ],
        ];

        // Create roles
        $roleSuperAdmin = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'admin']);
        $roleAdmin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'admin']);
        $roleCashier = Role::firstOrCreate(['name' => 'cashier', 'guard_name' => 'admin']);

        // Create and assign permissions
        foreach ($permissions as $permissionGroup) {
            foreach ($permissionGroup['permissions'] as $permissionName) {
                $permission = Permission::firstOrCreate([
                    'name' => $permissionName,
                    'group_name' => $permissionGroup['group_name'],
                    'guard_name' => 'admin'
                ]);

                // Assign all permissions to super admin
                $roleSuperAdmin->givePermissionTo($permission);

                // Assign specific permissions to admin
                if ($permissionName == 'dashboard.view') {
                    $roleAdmin->givePermissionTo($permission);
                }

                if (in_array($permissionGroup['group_name'], ['event', 'ticket', 'transaction'])) {
                    $roleAdmin->givePermissionTo($permission);
                }

                // Assign create transaction permission to cashier
                if ($permissionName == 'dashboard.view') {
                    $roleCashier->givePermissionTo($permission);
                }

                if ($permissionName == 'transaction.create') {
                    $roleCashier->givePermissionTo($permission);
                }
            }
        }

        // Assign roles to users
        $superAdminUser = Admin::where('username', 'superadmin')->first();
        if ($superAdminUser) {
            $superAdminUser->assignRole($roleSuperAdmin);
        }

        $adminUser = Admin::where('username', 'admin')->first();
        if ($adminUser) {
            $adminUser->assignRole($roleAdmin);
        }

        $cashierUser = Admin::where('username', 'cashier')->first();
        if ($cashierUser) {
            $cashierUser->assignRole($roleCashier);
        }
    }
}
