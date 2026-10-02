<?php

namespace App\Filament\Resources\EducationSpheres\Pages;

use App\Filament\Resources\EducationSpheres\EducationSphereResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEducationSpheres extends ListRecords
{
    protected static string $resource = EducationSphereResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
    public function getTitle(): string
    {
        return __('filament/admin/list_education_spheres.title');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament/admin/list_education_spheres.title');
    }

}
