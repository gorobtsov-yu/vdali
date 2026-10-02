<?php

namespace App\Filament\Resources\EducationLevels\Pages;

use App\Filament\Resources\EducationLevels\EducationLevelResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEducationLevel extends EditRecord
{
    protected static string $resource = EducationLevelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
    public function getTitle(): string
    {
        return __('filament/admin/edit_education_level.title');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament/admin/edit_education_level.title');
    }

}
