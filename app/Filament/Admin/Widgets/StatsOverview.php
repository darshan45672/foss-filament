<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Event;
use App\Models\EventRegisteration;
use App\Models\User;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Events', Event::count())
                ->description('All created events')
                ->color('success'),

            Stat::make('Total Registrations', EventRegisteration::count())
                ->description('All event registrations')
                ->color('info'),

            Stat::make('Total Users', User::count())
                ->description('Registered users')
                ->color('warning'),
                
            Stat::make('Approved Registrations', EventRegisteration::where('status', 'approved')->count())
                ->description('Confirmed participants')
                ->color('success'),
        ];
    }
}
