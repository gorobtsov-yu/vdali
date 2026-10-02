<?php

namespace App\Filament\Resources\EducationSpheres;

use App\Filament\Resources\EducationSpheres\Pages\CreateEducationSphere;
use App\Filament\Resources\EducationSpheres\Pages\EditEducationSphere;
use App\Filament\Resources\EducationSpheres\Pages\ListEducationSpheres;
use App\Filament\Resources\EducationSpheres\Schemas\EducationSphereForm;
use App\Filament\Resources\EducationSpheres\Tables\EducationSpheresTable;
use App\Models\EducationSphere;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EducationSphereResource extends Resource
{
    protected static ?string $model = EducationSphere::class;

    protected static ?string $navigationLabel = null;

    protected static ?string $modelLabel = null;

    protected static ?string $pluralModelLabel = null;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return EducationSphereForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EducationSpheresTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEducationSpheres::route('/'),
            'create' => CreateEducationSphere::route('/create'),
            'edit' => EditEducationSphere::route('/{record}/edit'),
        ];
    }
    public static function getNavigationLabel(): string
    {
        return __('filament/admin/education_sphere_resource.navigation_label');
    }
    public static function getModelLabel(): string
    {
        return __('filament/admin/education_sphere_resource.model_label');
    }
    public static function getPluralModelLabel(): string
    {
        return __('filament/admin/education_sphere_resource.plural_model_label');
    }



}
