<?php

namespace App\Filament\Resources\ActivityTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ActivityTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('filament/admin/activity_type_resource.name'))
                    ->required(),
                TextInput::make('code')
                    ->label(__('filament/admin/activity_type_resource.code'))
                    ->required(),
            ]);
    }
}
