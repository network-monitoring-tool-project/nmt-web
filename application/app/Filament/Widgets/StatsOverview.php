<?php

namespace App\Filament\Widgets;

use App\Models\Address;
use App\Models\Scan;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Users', count(User::all())),
            Card::make('Scans', count(Scan::all())),
            Card::make('Addresses', count(Address::all()))
        ];
    }
}
