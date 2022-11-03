<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScanResource\Pages;
use App\Models\Scan;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ScanResource extends Resource
{
    protected static ?string $model = Scan::class;
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'NMT';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('status')
                    ->options([
                        'ok' => 'ok',
                        'error' => 'error',
                        'unset' => 'unset'
                    ])->required(),
                Forms\Components\DateTimePicker::make('timestamp')->minDate(now())->required(),
                Forms\Components\Repeater::make('addresses')
                    ->relationship()
                    ->schema([
                        Forms\Components\TextInput::make('ip')->required(),
                        Forms\Components\TextInput::make('mac'),
                        Forms\Components\TextInput::make('manufacturer'),
                        Forms\Components\Toggle::make('online'),
                    ])
                    ->createItemButtonLabel('Add Addresses to Scan')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\BadgeColumn::make('status')->enum([
                    'ok' => 'ok',
                    'error' => 'error',
                    'unset' => 'unset'
                ])->colors([
                    'primary',
                    'secondary' => 'draft',
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
                        'unset' => 'unset'
                    ])
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageScans::route('/'),
        ];
    }
}
