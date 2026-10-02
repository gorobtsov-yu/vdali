<?php

namespace App\Filament\Resources\EducationSpheres\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EducationSphereForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('filament/admin/education_sphere_resource.name'))
                    ->required(),
                TextInput::make('code')
                    ->label(__('filament/admin/education_sphere_resource.code'))
                    ->required(),
            ]);
    }
}
