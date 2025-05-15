<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
use App\Models\Appointment;
use App\Models\Order;
use App\Models\Product;
use App\Models\Vet;
use App\Models\User;
use App\Models\Products;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Stats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Customer',Customer::count())
            ->color('success')
            ->label('Total Customers'),
          
            Stat::make('Total Appointments', Appointment::count()),
            Stat::make('Total Vet', Vet::count()),
           Stat::make('Total Products',Product::count()),
           
        ];
    }
}
