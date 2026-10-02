<?php

namespace App\Filament\Resources\Employments\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class EmploymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('filament/admin/employment_resource.name'))
                    ->required(),
                TextInput::make('code')
                    ->label(__('filament/admin/employment_resource.code'))
                    ->required(),
                Textarea::make('description')
                    ->label(__('filament/admin/employment_resource.description'))
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('salary_from')
                    ->label(__('filament/admin/employment_resource.salary_from'))
                    ->required()
                    ->numeric(),
                TextInput::make('salary_to')
                    ->label(__('filament/admin/employment_resource.salary_to'))
                    ->required()
                    ->numeric(),
            ]);
    }
}
