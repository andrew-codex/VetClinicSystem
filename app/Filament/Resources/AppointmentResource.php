<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentResource\Pages;
use App\Filament\Resources\AppointmentResource\RelationManagers;
use App\Models\Appointment;
use DateTime;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    public static function canCreate (): bool{
        return Filament::getCurrentPanel()->getId() =='customer';
    }
    protected static ?string $navigationGroup = 'Clinic Management';

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
                Tables\Columns\TextColumn::make('status')->badge(),


                TextColumn::make('customer.name') 
                ->label('Customer Name')
                ->searchable(),  
    
            TextColumn::make('pet.pet_name')  
                ->label('Pet Name')
                ->searchable(),  

                   TextColumn::make('pet.species')  
                ->label('Species')
                ->searchable(), 
    
            TextColumn::make('vet.name')  
                ->label('Vet Name')
                ->searchable(),
                TextColumn::make('appointment_date')  
            ->label('Appointment Date')              
            ->dateTime('Y-m-d H:i:s')              
        

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
Action::make('Accept')
    ->color('success')
    ->label('Accept')
    ->action(function ($record) {
        logger('Accept clicked'); 
        $record->update(['status' => 'accepted']);

        Notification::make()
            ->title('Appointment Accepted')
            ->success()
            ->send();

    }),
    


Action::make('Decline')
    ->color('danger')
    ->label('Decline')
    ->action(fn ($record) => $record->update(['status' => 'declined'])),

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
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }
}
