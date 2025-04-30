<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use App\Models\Place;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class EventsByCategoryChart extends ChartWidget
{
    protected static ?string $heading = 'Events by Category';
    protected static ?string $description = 'Shows number of events by category with place filter';
    protected static ?string $pollingInterval = '30s';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $placeId = $this->filter;

        $data = Cache::remember('events_by_category_' . $placeId, 3600, function () use ($placeId) {
            $query = Event::query()
                ->select('event_category_id', DB::raw('COUNT(*) as count'))
                ->with('category')
                ->groupBy('event_category_id');

            if ($placeId) {
                $query->where('place_id', $placeId);
            }

            $events = $query->get();

            return [
                'datasets' => [[
                    'label' => 'Number of Events',
                    'data' => $events->pluck('count')->toArray(),
                ]],
                'labels' => $events->pluck('category.name')->toArray(),
            ];
        });

        return $data;
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getFilters(): ?array
    {
        return Place::pluck('name', 'id')->toArray();
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'title' => [
                        'display' => true,
                        'text' => 'Number of Events'
                    ]
                ],
                'x' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Category'
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