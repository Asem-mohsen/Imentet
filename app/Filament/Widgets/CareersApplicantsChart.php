<?php

namespace App\Filament\Widgets;

use App\Models\Career;
use App\Models\CareerApplication;
use App\Models\Place;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Services\Filament\Calculations;

class CareersApplicantsChart extends ChartWidget
{
    protected static ?string $heading = 'Career Applicants by Place';
    protected static ?string $description = 'Shows number of applicants per career position by place';
    protected static ?string $pollingInterval = '30s';
    protected static ?int $sort = 5;

    protected function getData(): array
    {
        $data = Cache::remember('careers_applicants_chart', 3600, function () {
            $applicants = CareerApplication::with('career') // no need for 'place'
                ->get()
                ->groupBy(fn($application) => $application->career->place_id)
                ->map(function ($groupedByPlace) {
                    return $groupedByPlace
                        ->groupBy('career_id')
                        ->map(fn($apps) => $apps->count());
                });

            $careers = Career::pluck('title', 'id');
            $places = Place::pluck('name', 'id');

            $datasets = [];
            
            foreach ($places as $placeId => $placeName) {
                $datasets[] = [
                    'label' => $placeName,
                    'data' => $careers->map(function ($careerTitle, $careerId) use ($applicants, $placeId) {
                        return $applicants[$placeId][$careerId] ?? 0;
                    })->toArray(),
                ];
            }

            return [
                'datasets' => $datasets,
                'labels' => $careers->values()->toArray(),
            ];
        });

        return $data;
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
                        'text' => 'Number of Applicants'
                    ]
                ],
                'x' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Career Position'
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