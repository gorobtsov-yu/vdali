<?php

namespace Database\Seeders\Core;

use App\ValueObject\Permission as ValueObjectPermission;
use App\ValueObject\Role as ValueObjectRole;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    private array $roles = [
        ValueObjectRole::SUPER_ADMIN->value,
        ValueObjectRole::ADMIN->value,
        ValueObjectRole::MANAGER->value,
    ];

    private array $permissions = [
        ValueObjectPermission::ALL->value,
        ValueObjectPermission::ROLES->value,
        ValueObjectPermission::FILAMENT->value,
    ];

    private array $rolePermissions = [
        ValueObjectRole::SUPER_ADMIN->value => [
            ValueObjectPermission::ALL->value,
        ],
        ValueObjectRole::ADMIN->value => [
            ValueObjectPermission::ROLES->value,
            ValueObjectPermission::FILAMENT->value,
        ],
        ValueObjectRole::MANAGER->value => [
            ValueObjectPermission::FILAMENT->value,
        ],
    ];

    public function run(): void
    {
        foreach ($this->roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        foreach ($this->permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        foreach ($this->rolePermissions as $role => $permissions) {
            if (in_array($role, $this->roles)) {
                $role = Role::findByName($role);

                foreach ($permissions as $permission) {
                    if (in_array($permission, $this->permissions)) {
                        $permission = Permission::findByName($permission);

                        $role->givePermissionTo($permission);
                    }
                }
            }
        }
    }
}
