<?php

namespace App\Filament\Resources\ActivityTypes;

use App\Filament\Resources\ActivityTypes\Pages\CreateActivityType;
use App\Filament\Resources\ActivityTypes\Pages\EditActivityType;
use App\Filament\Resources\ActivityTypes\Pages\ListActivityTypes;
use App\Filament\Resources\ActivityTypes\RelationManagers\CharacteristicsRelationManager;
use App\Filament\Resources\ActivityTypes\Schemas\ActivityTypeForm;
use App\Filament\Resources\ActivityTypes\Schemas\ActivityTypeInfolist;
use App\Filament\Resources\ActivityTypes\Tables\ActivityTypesTable;
use App\Models\ActivityType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ActivityTypeResource extends Resource
{
    protected static ?string $model = ActivityType::class;

    protected static ?string $navigationLabel = null;

    protected static ?string $modelLabel = null;

    protected static ?string $pluralModelLabel = null;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ActivityTypeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ActivityTypeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ActivityTypesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            CharacteristicsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListActivityTypes::route('/'),
            'create' => CreateActivityType::route('/create'),
            'edit' => EditActivityType::route('/{record}/edit'),
        ];
    }
    public static function getNavigationLabel(): string
    {
        return __('filament/admin/activity_type_resource.navigation_label');
    }
    public static function getModelLabel(): string
    {
        return __('filament/admin/activity_type_resource.model_label');
    }
    public static function getPluralModelLabel(): string
    {
        return __('filament/admin/activity_type_resource.plural_model_label');
    }



}
