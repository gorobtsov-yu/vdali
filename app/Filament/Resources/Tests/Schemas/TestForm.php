<?php

namespace App\Filament\Resources\Tests\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('filament/admin/test_resource.name'))
                    ->required(),
                TextInput::make('code')
                    ->label(__('filament/admin/test_resource.code'))
                    ->required(),
                Textarea::make('description')
                    ->label(__('filament/admin/test_resource.description'))
                    ->columnSpanFull(),
                TextInput::make('results_count')
                    ->label(__('filament/admin/test_resource.results_count'))
                    ->required()
                    ->numeric()
                    ->default(1),
            ]);
    }
}
