<?php

namespace App\Filament\Widgets;

use App\Models\Scan;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('User', count(User::all())),
            Card::make('Scans', count(Scan::all()))
        ];
    }
}
