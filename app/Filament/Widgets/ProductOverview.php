<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProductOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalProducts = \App\Models\Product::count();
        $totalWebsite = \App\Models\Product::whereHas('category', function ($query) {
            $query->where('slug', 'website');
        })->count();
        $totalIoT = \App\Models\Product::whereHas('category', function ($query) {
            $query->where('slug', 'iot');
        })->count();
        $totalGames = \App\Models\Product::whereHas('category', function ($query) {
            $query->where('slug', 'games');
        })->count();

        return [
            Stat::make('Total Produk', $totalProducts)
                ->description('Semua produk inovasi')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('primary'),
            Stat::make('Produk Website', $totalWebsite)
                ->description('Aplikasi berbasis web')
                ->descriptionIcon('heroicon-m-globe-alt')
                ->color('success'),
            Stat::make('Produk IoT', $totalIoT)
                ->description('Hardware & Internet of Things')
                ->descriptionIcon('heroicon-m-cpu-chip')
                ->color('warning'),
            Stat::make('Produk Games', $totalGames)
                ->description('Game interaktif')
                ->descriptionIcon('heroicon-m-device-phone-mobile')
                ->color('info'),
        ];
    }
}
