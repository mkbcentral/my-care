<?php

namespace App\Filament\Resources\BloodGroupResource\Pages;

use App\Filament\Resources\BloodGroupResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageBloodGroups extends ManageRecords
{
    protected static string $resource = BloodGroupResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
