<?php

namespace App\Policies;

use App\Models\User;
use App\ValueObject\Permission;
use App\ValueObject\Role as ValueObjectRole;
use Spatie\Permission\Models\Role;

class RolePolicy
{
    private function canManageRoles(User $user): bool
    {
        return $user->hasPermissionTo(Permission::ALL->value)
            || $user->hasPermissionTo(Permission::ROLES->value);
    }

    public function attachRole(User $user, Role $role, User $pivotUser): bool
    {
        if (! $this->canManageRoles($user)) {
            return false;
        }

        if ($role->name === ValueObjectRole::SUPER_ADMIN->value) {
            return false;
        }

        return true;
    }

    public function detachRole(User $user, Role $role, User $pivotUser): bool
    {
        if (! $this->canManageRoles($user)) {
            return false;
        }

        if ($role->name === ValueObjectRole::SUPER_ADMIN->value) {
            return false;
        }

        return true;
    }

    public function viewAny(User $user): bool
    {
        return $this->canManageRoles($user);
    }
}
