<?php

namespace App\Filament\Resources\EducationLevels\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EducationLevelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('filament/admin/education_level_resource.name'))
                    ->required(),
                TextInput::make('code')
                    ->label(__('filament/admin/education_level_resource.code'))
                    ->required(),
            ]);
    }
}
