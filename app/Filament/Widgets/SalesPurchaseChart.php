<?php

namespace App\Filament\Widgets;

use Filament\Widgets\BarChartWidget;
use App\Models\Transaction;

class SalesPurchaseChart extends BarChartWidget
{
    protected static ?string $heading = 'Sales vs Purchases';

    protected static ?string $icon = 'heroicon-o-chart-bar';

    protected function getData(): array
    {
        $totalSales = Transaction::where('transaction_type', 'sale')->sum('total_amount');
        $totalPurchases = Transaction::where('transaction_type', 'purchase')->sum('total_amount');
        return [
            'datasets' => [
                [
                    'label' => 'Sales',
                    'backgroundColor' => '#00b39f',
                    'data' => [number_format(floatval($totalSales), 2, '.', '')]
                ],
                [
                    'label' => 'Purchases',
                    'backgroundColor' => '#ff0000',
                    'data' => [number_format(floatval($totalPurchases), 2, '.', '')]
                ],
            ],
            'labels' => ["Sales Vs Purchases"]
        ];
    }
 
    protected function getType(): string
    {
        return 'bar';
    }
}
