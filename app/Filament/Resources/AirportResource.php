<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AirportResource\Pages;
use App\Filament\Resources\AirportResource\RelationManagers;
use App\Models\Airport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

//Form Import
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
//Table Import
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;


class AirportResource extends Resource
{
    protected static ?string $model = Airport::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('image')
                ->image()
                ->directory('airports')
                ->required()
                ->columnSpan(2),

                TextInput::make('iata_code')
                ->required(),

                TextInput::make('name')
                ->required(),

                TextInput::make('city')
                ->required(),

                TextInput::make('country')
                ->required(),                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image'),
                TextColumn::make('iata_code'),
                TextColumn::make('name'),
                TextColumn::make('city'),
                TextColumn::make('country'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAirports::route('/'),
            'create' => Pages\CreateAirport::route('/create'),
            'edit' => Pages\EditAirport::route('/{record}/edit'),
        ];
    }
}
