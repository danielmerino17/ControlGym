<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Cliente;
use App\Models\Prestamo;
use App\Models\Asistencia;
use Carbon\Carbon;

class GymStatsOverview extends BaseWidget
{
    // Widget aparece en la pantalla principal.
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        // Card para contar clientes por estado (Activos / Inactivos)
        $clientesActivos = Cliente::where('activo', true)->count();
        $clientesInactivos = Cliente::where('activo', false)->count();
        $totalClientes = Cliente::count();

        // Card para préstamos de equipo por estado
        $prestamosPendientes = Prestamo::where('estado', 'prestado')->count();
        $prestamosDevueltos = Prestamo::where('estado', 'devuelto')->count();
        $totalPrestamos = Prestamo::count();

        // Card para asistencias (Accesos)
        // Suponiendo que usaste el campo created_at para el acceso, o adáptalo a fecha_hora
        $asistenciasHoy = Asistencia::whereDate('created_at', Carbon::today())->count();
        $asistenciasAyer = Asistencia::whereDate('created_at', Carbon::yesterday())->count();

        return [
            // Card del total de clientes por estado
            Stat::make('Total de Clientes', $totalClientes)
                ->icon('heroicon-o-users')
                ->description("Activos: $clientesActivos | Inactivos: $clientesInactivos"),

            // Card Total de Préstamos
            Stat::make('Préstamos de Equipo', $totalPrestamos)
                ->icon('heroicon-o-key')
                ->description("Pendientes: $prestamosPendientes | Devueltos: $prestamosDevueltos"),

            // Card de Asistencias
            Stat::make('Asistencias de hoy', $asistenciasHoy)
                ->icon('heroicon-o-qr-code')
                ->description("Accesos ayer: $asistenciasAyer"),
        ];
    }

    protected function getColumns(): int
    {
        return 3; 
    }
}