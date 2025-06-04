<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\ServiceProvider;
use App\Providers\Filament\CustomersPanelProvider;
   use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Events\MessageSending;
use App\Providers\Filament\AdminPanelProvider;
use Filament\Facades\Filament; 
use Filament\Navigation\NavigationBuilder as Navigation; 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {


Mail::listen(function (MessageSending $event) {
    logger('Sending email: ' . $event->message->getSubject());
});

    }


    
    }

