<?php

namespace App\Filament\Resources\CenterHospitalResource\Pages;

use App\Filament\Resources\CenterHospitalResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCenterHospitals extends ListRecords
{
    protected static string $resource = CenterHospitalResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
