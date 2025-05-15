<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use App\Models\Category;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Facades\Filament;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

     protected static ?string $navigationGroup = 'Manage Products';
   

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
                TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->label('Product Name'),
            TextInput::make('description')
                ->required()
                ->maxLength(255)
                ->label('Description'),
            TextInput::make('price')
                ->required()
                ->numeric()
                ->label('Price'),

           Select::make('category_id')->options( function () {

                return Category::all()->pluck('name', 'id');
            })
                ->required()
                ->label('Category'),

                FileUpload::make('image')->disk('public')
                ->directory('images')
                ->label('Image'),


            TextInput::make('stock')
                ->required()
                ->numeric()
                ->label('Stock'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->label('Product Name'),
                TextColumn::make('description')
                    ->searchable()
                    ->sortable()
                    ->label('Description'),
                TextColumn::make('price')
                    ->searchable()
                    ->label('Price'),
                TextColumn::make('category.name')
                    ->searchable()
                    ->label('Category'),
                ImageColumn::make('image')
                    ->label('Image')
                    ->square()
                   ->disk('public'),
                    
                  
                TextColumn::make('stock')
                    ->searchable()
                    ->label('Stock'),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
