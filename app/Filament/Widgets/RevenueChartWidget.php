<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RevenueChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Revenue Trend';
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = Payment::select(
                DB::raw('DATE(paid_at) as date'),
                DB::raw('SUM(amount) as total')
            )
            ->where('status', 'paid')
            ->where('paid_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Revenue',
                    'data' => $data->pluck('total')->toArray(),
                    'backgroundColor' => '#10B981',
                    'borderColor' => '#10B981',
                ],
            ],
            'labels' => $data->pluck('date')->map(fn ($date) => Carbon::parse($date)->format('M d'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}