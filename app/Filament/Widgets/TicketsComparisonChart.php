<?php

namespace App\Filament\Widgets;

use App\Models\UserTicket;
use App\Models\Place;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class TicketsComparisonChart extends ChartWidget
{
    protected static ?string $heading = 'Tickets Comparison';
    protected static ?string $description = 'Compares ticket usage between Pyramids and GEM';
    protected static ?string $pollingInterval = '30s';
    protected static ?int $sort = 7;

    protected function getData(): array
    {
        return Cache::remember('tickets_comparison_chart', 3600, function () {
            // Define the relevant place IDs (e.g., 1 = Pyramids, 2 = GEM)
            $placeIds = [1, 2];
            $places = Place::whereIn('id', $placeIds)->pluck('name', 'id');

            // Get ticket usage data grouped by date and place_id (from visit_ticket_id)
            $tickets = UserTicket::query()
                ->select(
                    DB::raw('DATE(visit_date) as date'),
                    'visit_ticket_id',
                    DB::raw('COUNT(*) as count')
                )
                ->whereIn('visit_ticket_id', $placeIds)
                ->groupBy('date', 'visit_ticket_id')
                ->orderBy('date')
                ->get();

            // Get all unique dates
            $dates = $tickets->pluck('date')->unique()->sort()->values();

            // Build datasets per place
            $datasets = [];
            foreach ($places as $placeId => $placeName) {
                $datasets[] = [
                    'label' => $placeName,
                    'data' => $dates->map(function ($date) use ($tickets, $placeId) {
                        return $tickets
                            ->where('date', $date)
                            ->where('visit_ticket_id', $placeId)
                            ->sum('count');
                    })->toArray(),
                ];
            }

            return [
                'datasets' => $datasets,
                'labels' => $dates->toArray(),
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
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'title' => [
                        'display' => true,
                        'text' => 'Number of Tickets Used'
                    ]
                ],
                'x' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Date'
                    ]
                ]
            ],
            'plugins' => [
                'legend' => [
                    'position' => 'top',
                ],
            ],
        ];
    }
} 