<?php

namespace App\Filament\Resources\CenterHospitalResource\Pages;

use App\Filament\Resources\CenterHospitalResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCenterHospital extends EditRecord
{
    protected static string $resource = CenterHospitalResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
