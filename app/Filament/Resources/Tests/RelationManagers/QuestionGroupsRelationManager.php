<?php

namespace App\Filament\Resources\Tests\RelationManagers;

use App\Filament\Resources\Tests\TestResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class QuestionGroupsRelationManager extends RelationManager
{
    protected static string $relationship = 'questionGroups';

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make()
                    ->label(__('filament/admin/question_groups_relation_manager.create')),
            ]);
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('filament/admin/question_groups_relation_manager.title');
    }
}
