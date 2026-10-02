<?php

namespace App\Filament\Resources\EducationSpheres\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EducationSpheresTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('filament/admin/education_sphere_resource.name'))
                    ->searchable(),
                TextColumn::make('code')
                    ->label(__('filament/admin/education_sphere_resource.code'))
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label(__('filament/admin/education_sphere_resource.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('filament/admin/education_sphere_resource.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->label(__('filament/admin/education_sphere_resource.edit')),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label(__('filament/admin/education_sphere_resource.delete_bulk')),
                ]),
            ]);
    }
}
