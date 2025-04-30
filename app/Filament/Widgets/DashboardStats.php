<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Event;
use App\Models\Collection;
use App\Models\ShopItem;
use App\Services\Filament\Calculations;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends BaseWidget
{
    protected static ?string $pollingInterval = '30s';
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('All registered users')
                ->descriptionIcon('heroicon-o-users')
                ->color('success'),

            Stat::make('Total Revenue', app(Calculations::class)->getTotalAmountByPayableType(ShopItem::class))
                ->description('From all shop orders')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('success'),

            Stat::make('Total Events', Event::count())
                ->description('All events')
                ->descriptionIcon('heroicon-o-calendar')
                ->color('info'),

            Stat::make('Pending Events', Event::where('status', 'pending')->count())
                ->description('Events awaiting approval')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning'),

            Stat::make('Cancelled Events', Event::where('status', 'cancelled')->count())
                ->description('Cancelled events')
                ->descriptionIcon('heroicon-o-x-circle')
                ->color('danger'),

            Stat::make('Completed Events', Event::where('status', 'completed')->count())
                ->description('Successfully completed events')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('Membership Subscribers', User::whereHas('memberships')->count())
                ->description('Active membership holders')
                ->descriptionIcon('heroicon-o-user-group')
                ->color('info'),

            Stat::make('Total Collections', Collection::count())
                ->description('All collections')
                ->descriptionIcon('heroicon-o-archive-box')
                ->color('info'),
        ];
    }
} 