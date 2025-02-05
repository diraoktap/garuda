<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FlightResource\Pages;
use App\Filament\Resources\FlightResource\RelationManagers;
use App\Models\Flight;
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
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Repeater;


class FlightResource extends Resource
{
    protected static ?string $model = Flight::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
 
                Wizard::make([
                    Wizard\Step::make('Flight Information')
                        ->schema([
                            TextInput::make('flight_number')
                            ->required()
                            ->unique(ignoreRecord:true)
                            ->maxLength(255),
 
                            Select::make('airline_id')
                            ->relationship('airline', 'name')
                            ->required(),
                        ]),
                    Wizard\Step::make('Flight Segments')
                        ->schema([                            
                            Repeater::make('members')
                                ->schema([
                                    TextInput::make('name')->required(),
                                    Select::make('role')
                                        ->options([
                                            'member' => 'Member',
                                            'administrator' => 'Administrator',
                                            'owner' => 'Owner',
                                        ])
                                        ->required(),
                                ])
                                ->columns(2)
                        ]),
                    Wizard\Step::make('Flight Class')
                        ->schema([
                            // ...
                        ]),
                ])->columnSpan(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListFlights::route('/'),
            'create' => Pages\CreateFlight::route('/create'),
            'edit' => Pages\EditFlight::route('/{record}/edit'),
        ];
    }
}
