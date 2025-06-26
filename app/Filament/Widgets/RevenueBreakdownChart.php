<?php

namespace App\Filament\Widgets;

use App\Models\ShopItem;
use App\Models\Event;
use App\Models\Donation;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Cache;
use App\Services\Filament\Calculations;

class RevenueBreakdownChart extends ChartWidget
{
    protected static ?string $heading = 'Revenue Breakdown';
    protected static ?string $description = 'Shows revenue distribution across different sources';
    protected static ?string $pollingInterval = '30s';
    protected static ?int $sort = 8;

    protected function getData(): array
    {
        $data = Cache::remember('revenue_breakdown', 3600, function () {
            $eventRevenue = app(Calculations::class)->getTotalAmountByPayableType(Event::class);
            $shopRevenue = app(Calculations::class)->getTotalAmountByPayableType(ShopItem::class);
            $donationRevenue = app(Calculations::class)->getTotalAmountByPayableType(Donation::class);

            return [
                'datasets' => [[
                    'label' => 'Revenue (EGP)',
                    'data' => [
                        $eventRevenue,
                        $shopRevenue,
                        $donationRevenue,
                    ],
                    'backgroundColor' => [
                        'rgb(54, 162, 235)',
                        'rgb(255, 99, 132)',
                        'rgb(75, 192, 192)',
                    ],
                ]],
                'labels' => [
                    'Events Revenue',
                    'Shop Revenue',
                    'Donations Revenue',
                ],
            ];
        });

        return $data;
    }

    protected function getType(): string
    {
        return 'pie';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                ],
                'tooltip' => [
                    'callbacks' => [
                        'label' => 'function(context) {
                            const label = context.label || "";
                            const value = context.raw || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = Math.round((value / total) * 100);
                            return `${label}: ${value.toLocaleString()} EGP (${percentage}%)`;
                        }'
                    ]
                ]
            ],
        ];
    }
} 