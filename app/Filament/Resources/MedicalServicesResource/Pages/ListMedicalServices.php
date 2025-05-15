<?php

namespace App\Filament\Resources\MedicalServicesResource\Pages;

use App\Filament\Resources\MedicalServicesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMedicalServices extends ListRecords
{
    protected static string $resource = MedicalServicesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
