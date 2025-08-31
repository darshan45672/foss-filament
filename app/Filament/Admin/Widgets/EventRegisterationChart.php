<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\EventRegisteration;
use Illuminate\Support\Facades\DB;

class EventRegisterationChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        $registrations = EventRegisteration::select(
                DB::raw('COUNT(*) as count'),
                DB::raw("strftime('%m', created_at) as month"),
                DB::raw("strftime('%Y', created_at) as year")
            )
            ->where('created_at', '>=', now()->subMonths(11))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $labels = [];
        $data = [];

        for ($i = 0; $i < 12; $i++) {
            $date = now()->subMonths(11 - $i);
            $labels[] = $date->format('M Y');

            $count = $registrations
                ->firstWhere('month', $date->format('m'))?->count ?? 0;

            $data[] = $count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Registrations',
                    'data' => $data,
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59,130,246,0.4)',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
