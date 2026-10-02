<?php

namespace App\Filament\Resources\Characteristics\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CharacteristicForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('filament/admin/characteristic_resource.name'))
                    ->required(),
                TextInput::make('code')
                    ->label(__('filament/admin/characteristic_resource.code'))
                    ->required(),
            ]);
    }
}
