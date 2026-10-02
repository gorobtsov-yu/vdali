<?php

namespace App\Filament\Resources\Tests\Pages;

use App\Filament\Resources\Tests\TestResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTest extends EditRecord
{
    protected static string $resource = TestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
    public function getTitle(): string
    {
        return __('filament/admin/edit_test.title');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament/admin/edit_test.title');
    }

}
