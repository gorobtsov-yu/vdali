<?php

namespace App\Filament\Resources\RegistrationRequests;

use App\Filament\Resources\RegistrationRequests\Pages\CreateRegistrationRequest;
use App\Filament\Resources\RegistrationRequests\Pages\EditRegistrationRequest;
use App\Filament\Resources\RegistrationRequests\Pages\ListRegistrationRequests;
use App\Filament\Resources\RegistrationRequests\Schemas\RegistrationRequestForm;
use App\Filament\Resources\RegistrationRequests\Tables\RegistrationRequestsTable;
use App\Models\RegistrationRequest;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RegistrationRequestResource extends Resource
{
    protected static ?string $model = RegistrationRequest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'email';

    public static function form(Schema $schema): Schema
    {
        return RegistrationRequestForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RegistrationRequestsTable::configure($table);
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
            'index' => ListRegistrationRequests::route('/'),
            'create' => CreateRegistrationRequest::route('/create'),
            'edit' => EditRegistrationRequest::route('/{record}/edit'),
        ];
    }
}
