<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Prestamo;

class PrestamosGrafica extends ChartWidget
{
    protected static ?int $sort = 2;

    // Título del widget que se muestra en la interfaz de usuario.
    public function getHeading(): ?string
    {
        return 'Estado de Préstamos de Equipo';
    }

    protected function getData(): array
    {
        // Se consulta directamente a la tabla de préstamos para obtener los totales reales.
        $prestados = Prestamo::where('estado', 'prestado')->count();
        $devueltos = Prestamo::where('estado', 'devuelto')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Préstamos',
                    'data' => [$prestados, $devueltos],
                    'backgroundColor' => ['#F59E0B', '#10B981'], 
                ],
            ],
            'labels' => ['Prestados (Pendientes)', 'Devueltos'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}