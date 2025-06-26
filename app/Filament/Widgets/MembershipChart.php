<?php

namespace App\Filament\Widgets;

use App\Models\Membership;
use App\Models\User;
use App\Models\UserMembership;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class MembershipChart extends ChartWidget
{
    protected static ?string $heading = 'Membership Subscriptions';
    protected static ?string $description = 'Shows number of subscriptions per membership type';
    protected static ?string $pollingInterval = '30s';
    protected static ?int $sort = 6;

    protected function getData(): array
    {
        return Cache::remember('membership_chart', 3600, function () {
            $subscriptions = UserMembership::query()
                ->select('membership_id', DB::raw('COUNT(*) as count'))
                ->groupBy('membership_id')
                ->orderByDesc('count')
                ->get();

            $membershipNames = Membership::pluck('name', 'id');

            return [
                'datasets' => [[
                    'label' => 'Number of Subscribers',
                    'data' => $subscriptions->pluck('count')->toArray(),
                    'backgroundColor' => 'rgb(54, 162, 235)',
                ]],
                'labels' => $subscriptions->pluck('membership_id')->map(function ($id) use ($membershipNames) {
                    return $membershipNames[$id] ?? 'Unknown';
                })->toArray(),
            ];
        });
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'indexAxis' => 'y',
            'scales' => [
                'x' => [
                    'beginAtZero' => true,
                    'title' => [
                        'display' => true,
                        'text' => 'Number of Subscribers'
                    ]
                ],
                'y' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Membership Type'
                    ]
                ]
            ],
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
        ];
    }
} 