<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CenterHospitalResource\Pages;
use App\Filament\Resources\CenterHospitalResource\RelationManagers;
use App\Models\CenterHospital;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CenterHospitalResource extends Resource
{
    protected static ?string $model = CenterHospital::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Hospital';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('hospital_id')
                    ->relationship('hospital', 'name')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('center_phone')
                    ->tel(),
                Forms\Components\Select::make('city_id')
                    ->relationship('city', 'name')
                    ->required(),
                Forms\Components\TextInput::make('municipality'),
                Forms\Components\TextInput::make('street'),
                Forms\Components\TextInput::make('number_street'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('hospital.name'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('center_phone'),
                Tables\Columns\TextColumn::make('city.name'),
                Tables\Columns\TextColumn::make('street'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListCenterHospitals::route('/'),
            'create' => Pages\CreateCenterHospital::route('/create'),
            'edit' => Pages\EditCenterHospital::route('/{record}/edit'),
        ];
    }
}
