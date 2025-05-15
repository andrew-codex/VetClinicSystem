<?php

namespace App\Filament\Resources\MedicalServicesResource\Pages;

use App\Filament\Resources\MedicalServicesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMedicalServices extends EditRecord
{
    protected static string $resource = MedicalServicesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
