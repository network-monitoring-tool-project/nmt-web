<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Scan extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'NMT';
    protected static ?string $navigationLabel = 'Scanner';

    protected static string $view = 'filament.pages.scan';
}
