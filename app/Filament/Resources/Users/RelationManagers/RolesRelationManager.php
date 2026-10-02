<?php

namespace App\Filament\Resources\Users\RelationManagers;

use App\Models\User;
use App\ValueObject\Role as RoleValueObject;
use Filament\Actions\AttachAction;
use Filament\Actions\DetachAction;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class RolesRelationManager extends RelationManager
{
    protected static string $relationship = 'roles';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->label(__('filament/admin/roles_relation_manager.name'))->searchable(),
            ])
            ->headerActions([
                AttachAction::make()
                    ->preloadRecordSelect()
                    ->authorize(fn (): bool => $this->canManageRoles())
                    ->using(function ($livewire, array $data, AttachAction $action): Model {
                        $roleId = $data['recordId'] ?? null;
                        $role = Role::find($roleId);

                        if (!$role) {
                            $this->sendDangerNotification(__('filament/errors/roles.role_not_found'));
                            $action->halt();
                        }

                        if (!$this->canManageRoles()) {
                            $this->sendDangerNotification(__('filament/errors/roles.permission_denied'));
                            $action->halt();
                        }

                        if (!$this->canManageRole($role)) {
                            $this->sendDangerNotification(__('filament/errors/roles.permission_denied_for_role'));
                            $action->halt();
                        }

                        /** @var User $owner */
                        $owner = $livewire->getOwnerRecord();
                        $owner->assignRole($role);

                        return $owner;
                    }),
            ])
            ->recordActions([
                DetachAction::make()
                    ->authorize(fn (Model $record): bool => $this->canManageRoles() && $record->name !== RoleValueObject::SUPER_ADMIN->value
                    )
                    ->using(function ($livewire, Model $role, DetachAction $action): Model {
                        if (! $this->canManageRoles()) {
                            $this->sendDangerNotification(__('filament/errors/roles.permission_denied'));
                            $action->halt();
                        }

                        if (! $this->canManageRole($role)) {
                            $this->sendDangerNotification(__('filament/errors/roles.permission_denied_for_role'));
                            $action->halt();
                        }

                        /** @var User $owner */
                        $owner = $livewire->getOwnerRecord();

                        $owner->removeRole($role->name);

                        return $owner;
                    }),
            ]);
    }

    private function canManageRoles(): bool
    {
        /** @var User|null $user */
        $user = Auth::user();

        return $user && (
            $user->hasPermissionTo(\App\ValueObject\Permission::ALL->value) ||
            $user->hasPermissionTo(\App\ValueObject\Permission::ROLES->value)
        );
    }

    private function canManageRole(Role $role): bool
    {
        /** @var User|null $currentUser */
        $currentUser = Auth::user();

        $currentLevel = $currentUser->roles
            ->map(fn ($r) => RoleValueObject::tryFrom($r->name)?->level())
            ->max() ?? 0;

        $roleLevel = RoleValueObject::tryFrom($role->name)?->level() ?? 0;

        if ($role->name === RoleValueObject::SUPER_ADMIN->value) {
            return false;
        }

        if ($currentLevel === RoleValueObject::SUPER_ADMIN->level()) {
            return true;
        }

        return $roleLevel < $currentLevel;
    }

    private function sendDangerNotification(string $title): void
    {
        Notification::make()
            ->title($title)
            ->danger()
            ->duration(5000)
            ->send();
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('filament/admin/roles_relation_manager.title');
    }
}
