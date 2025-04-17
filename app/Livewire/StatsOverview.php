<?php

namespace App\Livewire;

use App\Models\Customer;
use App\Models\Products;
use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $total_products = Products::count();
        $total_customers = Customer::count();
        $total_orders = Transaction::count();
        return [
            Stat::make('Total Products', $total_products)
                ->description('Updated 2 hours ago')
                ->descriptionIcon('heroicon-o-clock'),
            Stat::make('Total Customer', $total_customers)
                ->description('Updated 2 hours ago')
                ->descriptionIcon('heroicon-o-clock'),
            Stat::make('Total Order', $total_orders)
                ->description('Updated 2 hours ago')
                ->descriptionIcon('heroicon-o-clock'),
        ];
    }
}
