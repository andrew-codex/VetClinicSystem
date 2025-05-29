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
use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;

class MedicalRecordsResource extends Resource
{
    protected static ?string $model = MedicalRecords::class;
    protected static ?string $navigationGroup = 'Clinic Management';

    public static function canCreate(): bool
    {
        return auth()->guard('vet')->check();
    }

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

     
        if (auth()->guard('vet')->check()) {
            return $query->where('vet_id', auth()->guard('vet')->id());
        }

        return $query;
    }
    public static function form(Form $form): Form
    {
        return $form
        
            ->schema([
              Select::make('pet_id')
                    ->options(function () {
                        return \App\Models\Pet::pluck('pet_name', 'id');
                    })
                    ->label('Pet Name')
                    ->searchable()
                    ->required(),


         Select::make('Owner_name')
    ->label('Owner')
    ->options(fn () => Customer::pluck('name', 'name'))
    ->searchable()
    ->required(),
                DatePicker::make('visit_date')->required(),
                TextInput::make('diagnosis')->required(),
                TextInput::make('treatment')->required(),
                TextInput::make('prescription')->required(),
                TextInput::make('notes')->required(),
                DatePicker::make('next_visit_date')->required(),

                Select::make('status')
    ->label('Visit Status')
    ->options([
        'Pending' => 'Pending',
        'Follow-Up' => 'Follow-Up Scheduled',
        'Completed' => 'Completed',
    ])
    ->default('Pending')
    ->required(),


  
            ]);
            
    }
public static function mutateFormDataBeforeCreate(array $data): array
{
    $data['vet_id'] = auth()->guard('vet')->id(); 
    return $data;
}




    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pet.pet_name')->searchable(),
                TextColumn::make('Owner_name')->searchable(),
                TextColumn::make('visit_date')->searchable(),
                TextColumn::make('diagnosis')->searchable(),
                TextColumn::make('treatment')->searchable(),
                TextColumn::make('prescription')->searchable() ->sortable(),
                TextColumn::make('notes')->searchable(),
                TextColumn::make('next_visit_date')->searchable(),
                TextColumn::make('status')
    ->label('Status')
    ->formatStateUsing(function ($state, $record) {
        if ($record->next_visit_date && now()->gt($record->next_visit_date) && $state !== 'Completed') {
            return 'Follow-Up Due';
        }

        return $state;
    })
    ->badge()
    ->color(fn ($state) => match ($state) {
        'Pending' => 'warning',
        'Follow-Up' => 'info',
        'Completed' => 'success',
        default => 'gray',
    }),

            ])
            ->filters([
            
            ])
            ->actions([
                Action::make('MarkCompleted')
    ->label('Mark as Done')
    ->icon('heroicon-o-check-circle')
    ->color('success')
    ->visible(fn ($record) => $record->status !== 'Completed')
    ->action(function ($record) {
        $record->update(['status' => 'Completed']);

        Notification::make()
            ->title('Record marked as completed.')
            ->success()
            ->send();
    }),

              
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
