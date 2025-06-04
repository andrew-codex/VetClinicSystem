<?php

namespace App\Filament\Vet\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Product;
use App\Models\Customer;
class vetStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
              Stat::make('Total Products',Product::count()),
                Stat::make('Total Customer',Customer::count())
            ->color('success')
            ->label('Total Customers'),
        ];
    }
}
