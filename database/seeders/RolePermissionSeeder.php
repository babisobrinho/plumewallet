<?php

namespace Database\Seeders;

use App\Enums\PermissionGroup;
use App\Enums\RoleType;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        DB::transaction(function () {
            $this->createPermissions();
            $this->createRoles();
            $this->assignPermissionsToRoles();
        });
    }

    /**
     * Create all permissions based on permission groups and CRUD operations
     */
    private function createPermissions(): void
    {
        $permissionGroups = PermissionGroup::all();
        $operations = ['create', 'read', 'update', 'destroy'];

        foreach ($permissionGroups as $group) {
            foreach ($operations as $operation) {
                $permissionName = "{$group}_{$operation}";

                Permission::firstOrCreate([
                    'name' => $permissionName,
                    'group' => $group,
                    'guard_name' => 'web'
                ]);
            }
        }

        $this->command->info('Permissions created successfully.');
    }

    /**
     * Create all roles based on role types and their sub-roles
     */
    private function createRoles(): void
    {
        $staffRoles = ['admin', 'manager', 'editor', 'support'];
        foreach ($staffRoles as $roleName) {
            Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web',
                'type' => RoleType::STAFF->value
            ]);
        }

        $clientRoles = ['regular', 'tester'];
        foreach ($clientRoles as $roleName) {
            Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web',
                'type' => RoleType::CLIENT->value
            ]);
        }

        $this->command->info('Roles created successfully.');
    }

    /**
     * Assign permissions to roles based on their type and hierarchy
     */
    private function assignPermissionsToRoles(): void
    {
        $allPermissions = Permission::pluck('name')->toArray();

        $roles = Role::all();

        foreach ($roles as $role) {
            $permissions = $this->getPermissionsForRole($role->name, $role->type, $allPermissions);

            $role->syncPermissions($permissions);

            $this->command->info("Assigned " . count($permissions) . " permissions to role: {$role->name}");
        }
    }

    /**
     * Define which permissions each role should have
     */
    private function getPermissionsForRole(string $roleName, string $roleType, array $allPermissions): array
    {
        return match ($roleType) {
            RoleType::STAFF->value => $this->getStaffPermissions($roleName, $allPermissions),
            RoleType::CLIENT->value => $this->getClientPermissions($roleName, $allPermissions),
            default => []
        };
    }

    /**
     * Define permissions for staff roles
     */
    private function getStaffPermissions(string $roleName, array $allPermissions): array
    {
        return match ($roleName) {
            'admin' => $allPermissions, // Admin has all permissions

            'manager' => array_filter($allPermissions, function ($permission) {
                // Manager has all permissions except permissions management
                return !str_starts_with($permission, 'permissions_');
            }),

            'editor' => array_filter($allPermissions, function ($permission) {
                // Editor can read all, create/update specific groups, no destroy
                $allowedGroups = ['users', 'reports', 'statistics', 'qa'];
                return $this->hasPermissionForGroups($permission, $allowedGroups, ['read', 'create', 'update']);
            }),

            'support' => array_filter($allPermissions, function ($permission) {
                // Support can read users and reports, update users
                $allowedGroups = ['users', 'reports'];
                return $this->hasPermissionForGroups($permission, $allowedGroups, ['read', 'update']);
            }),

            default => []
        };
    }

    /**
     * Define permissions for client roles
     */
    private function getClientPermissions(string $roleName, array $allPermissions): array
    {
        return match ($roleName) {
            'tester' => array_filter($allPermissions, function ($permission) {
                // Tester can read and create in QA, read reports and statistics
                $qaPermissions = $this->hasPermissionForGroups($permission, ['qa'], ['read', 'create', 'update', 'destroy']);
                $readPermissions = $this->hasPermissionForGroups($permission, ['reports', 'statistics'], ['read']);
                return $qaPermissions || $readPermissions;
            }),

            // Regular client don't have any specific permissions

            default => []
        };
    }

    /**
     * Check if a permission matches the given groups and operations
     */
    private function hasPermissionForGroups(string $permission, array $groups, array $operations): bool
    {
        foreach ($groups as $group) {
            foreach ($operations as $operation) {
                if ($permission === "{$group}_{$operation}") {
                    return true;
                }
            }
        }

        return false;
    }
}
