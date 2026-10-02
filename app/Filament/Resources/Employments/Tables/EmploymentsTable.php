<?php

namespace App\Filament\Resources\Employments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EmploymentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('filament/admin/employment_resource.name'))
                    ->searchable(),
                TextColumn::make('code')
                    ->label(__('filament/admin/employment_resource.code'))
                    ->searchable(),
                TextColumn::make('salary_from')
                    ->label(__('filament/admin/employment_resource.salary_from'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('salary_to')
                    ->label(__('filament/admin/employment_resource.salary_to'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label(__('filament/admin/employment_resource.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('filament/admin/employment_resource.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()
                    ->label(__('filament/admin/employment_resource.view')),
                EditAction::make()
                    ->label(__('filament/admin/employment_resource.edit')),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label(__('filament/admin/employment_resource.delete_bulk')),
                ]),
            ]);
    }
}
