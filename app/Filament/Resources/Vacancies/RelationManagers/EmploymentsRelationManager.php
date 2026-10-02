<?php

namespace App\Filament\Resources\Vacancies\RelationManagers;

use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class EmploymentsRelationManager extends RelationManager
{
    protected static string $relationship = 'employments';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('filament/admin/employments_relation_manager.name'))
                    ->required(),
                TextInput::make('code')
                    ->label(__('filament/admin/employments_relation_manager.code'))
                    ->required(),
                Textarea::make('description')
                    ->label(__('filament/admin/employments_relation_manager.description'))
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('salary_from')
                    ->label(__('filament/admin/employments_relation_manager.salary_from'))
                    ->required()
                    ->numeric(),
                TextInput::make('salary_to')
                    ->label(__('filament/admin/employments_relation_manager.salary_to'))
                    ->required()
                    ->numeric(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->label(__('filament/admin/employments_relation_manager.name'))
                    ->searchable(),
                TextColumn::make('code')
                    ->label(__('filament/admin/employments_relation_manager.code'))
                    ->searchable(),
                TextColumn::make('salary_from')
                    ->label(__('filament/admin/employments_relation_manager.salary_from'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('salary_to')
                    ->label(__('filament/admin/employments_relation_manager.salary_to'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label(__('filament/admin/employments_relation_manager.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('filament/admin/employments_relation_manager.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->label(__('filament/admin/employments_relation_manager.create')),
                AttachAction::make(),
            ])
            ->recordActions([
                EditAction::make()
                    ->label(__('filament/admin/employments_relation_manager.edit')),
                DetachAction::make(),
                DeleteAction::make()
                    ->label(__('filament/admin/employments_relation_manager.delete')),
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
        return __('filament/admin/employments_relation_manager.title');
    }
}
