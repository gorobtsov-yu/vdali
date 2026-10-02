<?php

namespace App\Filament\Resources\Characteristics\Pages;

use App\Filament\Resources\Characteristics\CharacteristicResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCharacteristic extends EditRecord
{
    protected static string $resource = CharacteristicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
    public function getTitle(): string
    {
        return __('filament/admin/edit_characteristic.title');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament/admin/edit_characteristic.title');
    }

}
