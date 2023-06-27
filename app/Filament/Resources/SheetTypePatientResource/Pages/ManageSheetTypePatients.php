<?php

namespace App\Filament\Resources\SheetTypePatientResource\Pages;

use App\Filament\Resources\SheetTypePatientResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSheetTypePatients extends ManageRecords
{
    protected static string $resource = SheetTypePatientResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
