<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\Pages\POS;
use App\Filament\Resources\MedicalRecordsResource;
use App\Filament\Resources\PetResource;
use App\Filament\Resources\AppointmentResource;




class VetPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('vet')
            ->path('vet')
            ->login()
              ->default()
               ->passwordReset()
            ->authGuard('vet')
            ->brandName('Veterinary Clinic')
          
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Vet/Resources'), for: 'App\\Filament\\Vet\\Resources')
            ->resources([
                PetResource::class,
                MedicalRecordsResource::class,
                AppointmentResource::class,

            ])
            ->discoverPages(in: app_path('Filament/Vet/Pages'), for: 'App\\Filament\\Vet\\Pages')
            ->pages([
                Pages\Dashboard::class,
                // POS::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Vet/Widgets'), for: 'App\\Filament\\Vet\\Widgets')
            ->widgets([
             
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
