<?php

namespace App\Filament\Resources\Vacancies\Pages;

use App\Filament\Resources\Vacancies\VacancyResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVacancies extends ListRecords
{
    protected static string $resource = VacancyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
    public function getTitle(): string
    {
        return __('filament/admin/list_vacancies.title');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament/admin/list_vacancies.title');
    }

}
