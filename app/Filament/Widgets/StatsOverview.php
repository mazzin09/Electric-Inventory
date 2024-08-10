<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Item;
use App\Models\Transaction;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $totalSales = Transaction::where('transaction_type', 'sale')->sum('total_amount');
        $toalPurchases = Transaction::where('transaction_type', 'purchase')->sum('total_amount');
        return [
            Card::make('Total Item', Item::count()),
            Card::make('Total Sales',number_format(floatval($totalSales), 2, '.', '')),
            Card::make('Total Purchases', number_format(floatval($toalPurchases), 2, '.', '')),
        ];
    }
}
