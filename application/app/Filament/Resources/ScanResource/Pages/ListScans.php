<?php

namespace App\Filament\Resources\ScanResource\Pages;

use App\Filament\Resources\ScanResource;
use App\Http\Controllers\NmtApiController;
use App\Models\User;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListScans extends ListRecords
{
    protected static string $resource = ScanResource::class;

    protected function getActions(): array
    {
        return [
            Action::make('create')->action(function () {
                $this->callApi(Auth::user());
            }),
        ];
    }

    private function callApi(User $user): void
    {
        $nmtApiController = new NmtApiController($user);
        $nmtApiController->run();
    }
}
