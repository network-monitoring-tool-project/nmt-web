<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScanResource\Pages;
use App\Models\Scan;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Icetalker\FilamentTableRepeater\Forms\Components\TableRepeater;

class ScanResource extends Resource
{
    protected static ?string $model = Scan::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('status')
                    ->options([
                        'ok' => 'ok',
                        'error' => 'error',
                        'running' => 'running',
                        'unset' => 'unset'
                    ])->required(),
                Forms\Components\DateTimePicker::make('timestamp')->minDate(now())->required(),
                Forms\Components\Grid::make(1)->schema([
                    TableRepeater::make('addresses')
                        ->relationship()
                        ->schema([
                            Forms\Components\TextInput::make('ip')->required(),
                            Forms\Components\TextInput::make('mac'),
                            Forms\Components\TextInput::make('manufacturer'),
                            Forms\Components\Toggle::make('online')
                                ->default(false)
                                ->onIcon('heroicon-s-lightning-bolt')
                                ->onColor('success'),
                        ])
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\BadgeColumn::make('status')->enum([
                    'ok' => 'ok',
                    'error' => 'error',
                    'running' => 'running',
                    'unset' => 'unset'
                ])->colors([
                    'primary',
                    'secondary' => 'running',
                    'warning' => 'unset',
                    'success' => 'ok',
                    'danger' => 'error',
                ]),
                Tables\Columns\TextColumn::make('timestamp')->dateTime()->sortable()
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'ok' => 'ok',
                        'error' => 'error',
                        'running' => 'running',
                        'unset' => 'unset'
                    ])
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //todo
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListScans::route('/'),
            'view' => Pages\ViewScan::route('/{record}')
        ];
    }
}
