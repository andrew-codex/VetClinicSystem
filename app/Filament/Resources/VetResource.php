<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VetResource\Pages;
use App\Filament\Resources\VetResource\RelationManagers;
use App\Models\Vet;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VetResource extends Resource
{
    protected static ?string $model = Vet::class;
    protected static ?string $navigationGroup = 'Clinic Management';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->label('Vet name'),

                TextInput::make('email')
                ->label('Email'),

                TextInput::make('password')
                ->label('Password')->password()
                  ->dehydrateStateUsing(fn ($state) => Hash::make($state)),

                TextInput::make('phone')
                ->label('Phone')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Vet name')->searchable(),

                TextColumn::make('phone')->label('Phone')->searchable()
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    




   public static function getNavigationBadge(): ?string
{
    return static::getModel()::count();
}

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVets::route('/'),
            'create' => Pages\CreateVet::route('/create'),
            'edit' => Pages\EditVet::route('/{record}/edit'),
        ];
    }
}
