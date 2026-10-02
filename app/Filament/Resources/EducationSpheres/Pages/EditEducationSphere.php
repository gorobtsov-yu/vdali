<?php

namespace App\Filament\Resources\EducationSpheres\Pages;

use App\Filament\Resources\EducationSpheres\EducationSphereResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEducationSphere extends EditRecord
{
    protected static string $resource = EducationSphereResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
    public function getTitle(): string
    {
        return __('filament/admin/edit_education_sphere.title');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament/admin/edit_education_sphere.title');
    }

}
