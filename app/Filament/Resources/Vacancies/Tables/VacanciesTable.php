<?php

namespace App\Filament\Resources\Vacancies\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VacanciesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('filament/admin/vacancy_resource.title'))
                    ->searchable(),
                TextColumn::make('salary')
                    ->label(__('filament/admin/vacancy_resource.salary'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('description')
                    ->label(__('filament/admin/vacancy_resource.description'))
                    ->searchable(),
                TextColumn::make('contact')
                    ->label(__('filament/admin/vacancy_resource.contact'))
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label(__('filament/admin/vacancy_resource.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('filament/admin/vacancy_resource.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->label(__('filament/admin/vacancy_resource.edit')),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label(__('filament/admin/vacancy_resource.delete_bulk')),
                ]),
            ]);
    }
}
