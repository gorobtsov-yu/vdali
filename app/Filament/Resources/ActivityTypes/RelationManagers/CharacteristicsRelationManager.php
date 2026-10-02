<?php

namespace App\Filament\Resources\ActivityTypes\RelationManagers;

use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class CharacteristicsRelationManager extends RelationManager
{
    protected static string $relationship = 'characteristics';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('filament/admin/characteristics_relation_manager.name'))
                    ->required(),
                TextInput::make('code')
                    ->label(__('filament/admin/characteristics_relation_manager.code'))
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->label(__('filament/admin/characteristics_relation_manager.name'))
                    ->searchable(),
                TextColumn::make('code')
                    ->label(__('filament/admin/characteristics_relation_manager.code'))
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label(__('filament/admin/characteristics_relation_manager.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('filament/admin/characteristics_relation_manager.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->label(__('filament/admin/characteristics_relation_manager.create')),
                AttachAction::make(),
            ])
            ->recordActions([
                EditAction::make()
                    ->label(__('filament/admin/characteristics_relation_manager.edit')),
                DetachAction::make(),
                DeleteAction::make()
                    ->label(__('filament/admin/characteristics_relation_manager.delete')),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DetachBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('filament/admin/characteristics_relation_manager.title');
    }
}
