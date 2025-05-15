<?php

namespace App\Filament\Widgets;
use App\Models\Sale;
use Filament\Widgets\ChartWidget;

class SalesChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        $sales = Sale::query()
            ->selectRaw('MONTH(created_at) as month, SUM(total) as total')
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        return [
    'datasets' => [
        [
            'label' => 'Sales',
            'data' => array_values($sales),
            'borderColor' => '#3b82f6',
            'fill' => false, 
            'tension' => 0.3, 
        ],
    ],
    'labels' => array_map(fn($month) => date('F', mktime(0, 0, 0, $month, 1)), array_keys($sales)),
];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
