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

    public static function canCreate():bool{
        return Filament::getCurrentPanel()->getId() =='web';
    }

     public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

     
        if (auth()->guard('vet')->check()) {
            return $query->where('vet_id', auth()->guard('vet')->id());
        }

        return $query;
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
                
            ])
         

   ->actions([
   
   

    Action::make('Accept')
        ->color('success')
        ->label('Accept')
      ->visible(fn ($record) => $record->status === 'Pending')

        ->action(function ($record) {
            logger('Accept clicked'); 
            $record->update(['status' => 'Approved']);

            Notification::make()
                ->title('Appointment Accepted')
                ->success()
                ->send();
        }),

    Action::make('Decline')
        ->color('danger')
        ->label('Decline')

           ->visible(fn ($record) => $record->status === 'Pending')
        ->action(function ($record) {
            logger('Decline clicked');
            $record->update(['status' => 'Canceled']);

            Notification::make()
                ->title('Appointment Declined')
                ->danger()
                ->send();
        }),

        Action::make('Done')
    ->color('primary')
    ->label('Done')
    ->visible(fn ($record) => $record->status === 'Approved') 
    ->action(function ($record) {
        $record->update(['status' => 'Completed']); 

        Notification::make()
            ->title('Appointment marked as done')
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

    public static function getRelations(): array
    {
        return [
            //
        ];
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
