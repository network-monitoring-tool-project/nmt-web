<?php

namespace App\Filament\Resources\ScanResource\Pages;

use App\Filament\Resources\ScanResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageScans extends ManageRecords
{
    protected static string $resource = ScanResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
