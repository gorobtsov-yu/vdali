<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Forms\Components\Checkbox;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class Login extends BaseLogin
{
    public function form(Schema $form): Schema
    {
        return $form
            ->schema([
                TextInput::make('login')
                    ->label('Логин')
                    ->required()
                    ->autocomplete()
                    ->autofocus()
                    ->placeholder('Введите логин или email'),
                    
                TextInput::make('password')
                    ->label('Пароль')
                    ->password()
                    ->required()
                    ->placeholder('Введите пароль'),
                    
                Checkbox::make('remember')
                    ->label('Запомнить меня на этом устройстве'),
            ])
            ->statePath('data');
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        return [
            'login' => $data['login'],
            'password' => $data['password'],
        ];
    }
}