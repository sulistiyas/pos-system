<?php

namespace App\Livewire;

use App\Models\DetailTransaction;
use App\Models\Transaction;
use Filament\Widgets\ChartWidget;

class SalesChartOverview extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    public ?string $filter = 'last_week';

    protected static ?string $pollingInterval = '10s';

    protected static ?string $maxHeight = '400px';

    protected function getFilters(): ?array
    {
        return [
            'last_week' => 'Last Week',
            'last_month' => 'Last Month',
            'last_year' => 'Last Year',
        ];
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter;
        $data = Transaction::selectRaw('count(id_transaction) as id_transaction')
            ->groupBy('transaction_date')
            // ->selectRaw('SUM(transaction_total) as transaction_total')
            // ->selectRaw('MONTH(created_at) as month')
            // ->selectRaw('YEAR(created_at) as year')
            // ->groupBy('transaction_month', 'transaction_year')
            // ->when($activeFilter === 'today', function ($query) {
            //     return $query->where('transaction_date',date('d'));
            // })
            // ->when($activeFilter === 'last_month', function ($query) {
            //     return $query->where('transaction_month',date('m'));
            // })
            // ->when($activeFilter === 'last_year', function ($query) {
            //     return $query->where('transaction_year',date('Y'));
            // })
            // ->when($activeFilter === 'last_week', function ($query) {
            //     return $query->whereBetween('created_at', [now()->subWeek(), now()]);
            // })
            // ->when($activeFilter === 'last_month', function ($query) {
            //     return $query->whereBetween('created_at', [now()->subMonth(), now()]);
            // })
            // ->when($activeFilter === 'last_year', function ($query) {
            //     return $query->whereBetween('created_at', [now()->subYear(), now()]);
            // })
            ->get();
            if ($activeFilter ==='last_week') {
                return [
                    'datasets' => [
                        [
                            'label' => 'Sales Report',
                            'data' => $data->pluck('id_transaction'),
                            'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                            'borderColor' => 'rgba(75, 192, 192, 1)',
                            'fill' => true,
                        ],
                    ],
                    // 'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    'labels' => ['1', '2', '3', '4', '5', '6', '7'],
        
                ];
            } else if ($activeFilter ==='last_month') {
                return [
                    'datasets' => [
                        [
                            'label' => 'Sales Report',
                            'data' => $data->pluck('id_transaction'),
                            'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                            'borderColor' => 'rgba(75, 192, 192, 1)',
                            'fill' => true,
                        ],
                    ],
                    'labels' => ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30'],
        
                ];
            } else if ($activeFilter ==='last_month') {
                return [
                    'datasets' => [
                        [
                            'label' => 'Sales Report',
                            'data' => $data->pluck('id_transaction'),
                            'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                            'borderColor' => 'rgba(75, 192, 192, 1)',
                            'fill' => true,
                        ],
                    ],
                    'labels' => ['2021', '2022', '2023', '2024'],
        
                ];
            }else {
                return [
                    'datasets' => [
                        [
                            'label' => 'Sales Report',
                            'data' => $data->pluck('id_transaction'),
                            'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                            'borderColor' => 'rgba(75, 192, 192, 1)',
                            'fill' => true,
                        ],
                    ],
                    // 'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    // 'labels' => ['1', '2', '3', '4', '5', '6', '7'],
        
                ];
            }
        
    }

    protected function getType(): string
    {
        return 'line';
    }
}
