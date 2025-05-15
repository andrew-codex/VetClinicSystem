<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicalRecordsResource\Pages;
use App\Filament\Resources\MedicalRecordsResource\RelationManagers;
use App\Models\MedicalRecords;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\DatePicker;

class MedicalRecordsResource extends Resource
{
    protected static ?string $model = MedicalRecords::class;
    protected static ?string $navigationGroup = 'Clinic Management';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('pet_name')->required(),
                TextInput::make('Owner_name')->required(),
                DatePicker::make('visit_date')->required(),
                TextInput::make('diagnosis')->required(),
                TextInput::make('treatment')->required(),
                TextInput::make('prescription')->required(),
                TextInput::make('notes')->required(),
                DatePicker::make('next_visit_date')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pet_name')->searchable(),
                TextColumn::make('Owner_name')->searchable(),
                TextColumn::make('visit_date')->searchable(),
                TextColumn::make('diagnosis')->searchable(),
                TextColumn::make('treatment')->searchable(),
                TextColumn::make('prescription')->searchable() ->sortable(),
                TextColumn::make('notes')->searchable(),
                TextColumn::make('next_visit_date')->searchable(),
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
            'index' => Pages\ListMedicalRecords::route('/'),
            'create' => Pages\CreateMedicalRecords::route('/create'),
            'edit' => Pages\EditMedicalRecords::route('/{record}/edit'),
        ];
    }
}
