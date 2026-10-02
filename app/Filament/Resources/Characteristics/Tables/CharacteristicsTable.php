<?php

namespace App\Filament\Resources\Characteristics\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CharacteristicsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('filament/admin/characteristic_resource.name'))
                    ->searchable(),
                TextColumn::make('code')
                    ->label(__('filament/admin/characteristic_resource.code'))
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label(__('filament/admin/characteristic_resource.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('filament/admin/characteristic_resource.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->label(__('filament/admin/characteristic_resource.edit')),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label(__('filament/admin/characteristic_resource.delete_bulk')),
                ]),
            ]);
    }
}
