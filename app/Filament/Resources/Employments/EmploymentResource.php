<?php

namespace App\Filament\Resources\Employments;

use App\Filament\Resources\Employments\Pages\CreateEmployment;
use App\Filament\Resources\Employments\Pages\EditEmployment;
use App\Filament\Resources\Employments\Pages\ListEmployments;
use App\Filament\Resources\Employments\RelationManagers\ActivityTypesRelationManager;
use App\Filament\Resources\Employments\RelationManagers\EducationLevelsRelationManager;
use App\Filament\Resources\Employments\RelationManagers\EducationSpheresRelationManager;
use App\Filament\Resources\Employments\Schemas\EmploymentForm;
use App\Filament\Resources\Employments\Schemas\EmploymentInfolist;
use App\Filament\Resources\Employments\Tables\EmploymentsTable;
use App\Models\Employment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EmploymentResource extends Resource
{
    protected static ?string $model = Employment::class;

    protected static ?string $navigationLabel = null;

    protected static ?string $modelLabel = null;

    protected static ?string $pluralModelLabel = null;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return EmploymentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return EmploymentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EmploymentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ActivityTypesRelationManager::class,
            EducationLevelsRelationManager::class,
            EducationSpheresRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEmployments::route('/'),
            'create' => CreateEmployment::route('/create'),
            'edit' => EditEmployment::route('/{record}/edit'),
        ];
    }
    public static function getNavigationLabel(): string
    {
        return __('filament/admin/employment_resource.navigation_label');
    }
    public static function getModelLabel(): string
    {
        return __('filament/admin/employment_resource.model_label');
    }
    public static function getPluralModelLabel(): string
    {
        return __('filament/admin/employment_resource.plural_model_label');
    }



}
