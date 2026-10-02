<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('first_name')
                    ->label(__('filament/admin/user_resource.first_name'))
                    ->required(),
                TextInput::make('last_name')
                    ->label(__('filament/admin/user_resource.last_name'))
                    ->required(),
                TextInput::make('middle_name')
                    ->label(__('filament/admin/user_resource.middle_name')),
                TextInput::make('login')
                    ->label(__('filament/admin/user_resource.login'))
                    ->required(),
                TextInput::make('email')
                    ->label(__('filament/admin/user_resource.email'))
                    ->required(),
                TextInput::make('password')
                    ->label(__('filament/admin/user_resource.password'))
                    ->password()
                    ->required(),
                TextInput::make('desired_salary')
                    ->label(__('filament/admin/user_resource.desired_salary'))
                    ->numeric(),
            ]);
    }
}
