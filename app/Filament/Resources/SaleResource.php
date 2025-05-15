<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SaleResource\Pages;
use App\Filament\Resources\SaleResource\RelationManagers;
use App\Models\Sale;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Set;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Log;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SaleResource extends Resource
{
    protected static ?string $model = Sale::class;

       protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
 Select::make('product_id')
    ->label('Product')
    ->options(\App\Models\Product::all()->pluck('name', 'id'))
    ->searchable()
    ->afterStateUpdated(function ($state, Set $set) {
        $product = \App\Models\Product::find($state);
        if ($product) {
            $set('price', $product->price);
        }
    })
    ->required(),


                Forms\Components\TextInput::make('price')
                    ->label('Price per unit')
    ->disabled()
    ->reactive() 
    ->required(),


TextInput::make('quantity')
    ->label('Quantity')
    ->required()
    ->numeric()
    ->afterStateUpdated(function ($state, Set $set, $get) {
        $price = $get('price');
        if ($price && $state) {
            $set('total', $price * $state); 
        }
    }),

                Forms\Components\TextInput::make('total')
                    ->label('Total')
                  ->reactive() 
                    ->disabled() 
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 TextColumn::make('id')->label('Sale ID'),
              TextColumn::make('product.name')->label('Product'),
               TextColumn::make('quantity')->label('Quantity'),
                TextColumn::make('product.price')->label('Price')->money('PHP'),
               TextColumn::make('total')->label('Total')->money('PHP'),
                TextColumn::make('created_at')->label('Sale Date')->dateTime('Y-m-d H:i:s'),
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

   public static function afterSave($record)
    {
       
        $record->total = $record->quantity * $record->price;
        $record->save();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSales::route('/'),
            'create' => Pages\CreateSale::route('/create'),
            'edit' => Pages\EditSale::route('/{record}/edit'),
        ];
    }
}
