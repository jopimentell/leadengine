<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Lead;
use App\Models\Property;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total de Corretores', User::count())
                ->icon('heroicon-o-users')
                ->chart([7, 12, 9, 15, 20, 18, 25])
                ->color('primary'),
            Stat::make('Imóveis Cadastrados', Property::count())
                ->icon('heroicon-o-building-office')
                ->chart([10, 18, 22, 30, 28, 35, 40])
                ->color('success'),
            Stat::make('Leads Capturados', Lead::count())
                ->icon('heroicon-o-inbox')
                ->chart([5, 8, 12, 10, 15, 20, 28])
                ->color('warning'),
            Stat::make('Leads Convertidos', Lead::where('status', 'converted')->count())
                ->icon('heroicon-o-check-circle')
                ->color('success'),
        ];
    }
}