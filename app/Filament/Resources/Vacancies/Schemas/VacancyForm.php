<?php

namespace App\Filament\Resources\Vacancies\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class VacancyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label(__('filament/admin/vacancy_resource.title'))
                    ->required(),
                TextInput::make('salary')
                    ->label(__('filament/admin/vacancy_resource.salary'))
                    ->required()
                    ->numeric(),
                TextInput::make('description')
                    ->label(__('filament/admin/vacancy_resource.description'))
                    ->required(),
                TextInput::make('contact')
                    ->label(__('filament/admin/vacancy_resource.contact'))
                    ->required(),
            ]);
    }
}
