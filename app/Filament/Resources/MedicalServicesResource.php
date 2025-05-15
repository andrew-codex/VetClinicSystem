<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicalServicesResource\Pages;
use App\Filament\Resources\MedicalServicesResource\RelationManagers;
use App\Models\MedicalServices;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Facades\Filament;

class MedicalServicesResource extends Resource
{
    protected static ?string $model = MedicalServices::class;
    protected static ?string $navigationGroup = 'Clinic Management'; 
    public static function canDelete($record): bool{
        return Filament::getCurrentPanel()->getId() !== 'customer';
            }
        
            public static function canEdit($record): bool{
                return Filament::getCurrentPanel()->getId() !== 'customer';
                    }
        
                    public static function canCreate(): bool{
                        return Filament::getCurrentPanel()->getId() !== 'customer';
                            }
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('service_name')->label('Service name')->required() ,
                TextInput::make('description')->label('Description ') ->required(),

                TextInput::make('price')->label('Price') ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('service_name')->label('Service name') 
                ->searchable(),

                TextColumn::make('description')->label('Description ') ->searchable(),

                TextColumn::make('price')->label('Price') ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions(
                Filament::getCurrentPanel()->getId() === 'customer'
                    ? []
                    : [
                        Tables\Actions\BulkActionGroup::make([
                            Tables\Actions\DeleteBulkAction::make(),
                        ]),
                    ]
            );
            
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
            'index' => Pages\ListMedicalServices::route('/'),
            'create' => Pages\CreateMedicalServices::route('/create'),
            'edit' => Pages\EditMedicalServices::route('/{record}/edit'),
        ];
    }
}
