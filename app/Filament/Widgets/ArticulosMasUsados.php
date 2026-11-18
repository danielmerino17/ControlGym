<?php

namespace App\Filament\Widgets;

use App\Models\Prestamo;
use Filament\Widgets\ChartWidget;

class ArticulosMasUsados extends ChartWidget
{
    protected static ?int $sort = 4;

    public function getHeading(): ?string
    {
        return 'Artículos Más Prestados';
    }

    protected function getData(): array
    {
        $datos = Prestamo::selectRaw('articulo, COUNT(*) as total')
            ->groupBy('articulo')
            ->orderByDesc('total')
            ->pluck('total', 'articulo');

        return [
            'datasets' => [
                [
                    'label' => 'Préstamos',
                    'data' => $datos->values()->toArray(),
                    'backgroundColor' => ['#F59E0B', '#10B981', '#3B82F6', '#EF4444', '#8B5CF6'],
                ],
            ],
            'labels' => $datos->keys()->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}