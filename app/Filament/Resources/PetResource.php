<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PetResource\Pages;
use App\Filament\Resources\PetResource\RelationManagers;
use App\Models\Pet;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Facades\Filament;

class PetResource extends Resource
{
    protected static ?string $model = Pet::class;


    protected static ?string $navigationGroup = 'Clinic Management';
      public static function canDelete($record): bool{
return Filament::getCurrentPanel()->getId() !== 'vet';
    }

    public static function canEdit($record): bool{
        return Filament::getCurrentPanel()->getId() !== 'vet';
            }

            public static function canCreate(): bool{
                return Filament::getCurrentPanel()->getId() !== 'vet';
                    }

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer.name')
                ->label('Owner name')
                ->searchable(),

                TextColumn::make('breed')
                ->searchable(),

                TextColumn::make('age')
                ->searchable(),

                  TextColumn::make('pet.species')  
                ->label('Species')
                ->searchable(),

                TextColumn::make('medical_history')
                ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }


  public static function getNavigationBadge(): ?string
{
    return static::getModel()::count();
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
            'index' => Pages\ListPets::route('/'),
            'create' => Pages\CreatePet::route('/create'),
            'edit' => Pages\EditPet::route('/{record}/edit'),
        ];
    }
}
