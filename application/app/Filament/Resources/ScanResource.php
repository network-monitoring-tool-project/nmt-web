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
    protected static ?string $navigationGroup = 'Database';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('status')
                    ->options([
                        'ok' => 'ok',
                        'error' => 'error'
                    ])->required(),
                Forms\Components\DateTimePicker::make('timestamp')->required(),
                Forms\Components\Repeater::make('addresses')->schema([
                    Forms\Components\TextInput::make('ip')->required(),
                    Forms\Components\TextInput::make('mac')->required(),
                    Forms\Components\TextInput::make('manufacturer')->required(),
                    Forms\Components\Toggle::make('online')->required(),
                ])
                    ->createItemButtonLabel('Add Addresses to Scan')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('timestamp'),
            ])
            ->filters([
                //
            ])
            ->actions([
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
