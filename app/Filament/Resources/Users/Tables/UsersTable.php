<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('first_name')
                    ->label(__('filament/admin/user_resource.first_name')),
                TextColumn::make('last_name')
                    ->label(__('filament/admin/user_resource.last_name')),
                TextColumn::make('middle_name')
                    ->label(__('filament/admin/user_resource.middle_name')),
                TextColumn::make('desired_salary')
                    ->label(__('filament/admin/user_resource.desired_salary'))
                    ->sortable(),
                TextColumn::make('login')
                    ->label(__('filament/admin/user_resource.login'))
                    ->searchable(),
                TextColumn::make('email')
                    ->label(__('filament/admin/user_resource.email'))
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label(__('filament/admin/user_resource.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('filament/admin/user_resource.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->label(__('filament/admin/user_resource.edit')),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label(__('filament/admin/user_resource.delete_bulk')),
                ]),
            ]);
    }
}
