<?php

namespace App\Observers;

use App\Models\Prestamo;
use Illuminate\Support\Facades\DB;

class PrestamoObserver
{
    public function created(Prestamo $prestamo): void
    {
        DB::table('material')
            ->where('nombre', $prestamo->articulo)
            ->decrement('cantidad_total');
    }

    public function updated(Prestamo $prestamo): void
    {
        if ($prestamo->wasChanged('estado') && $prestamo->estado === 'devuelto') {
            DB::table('material')
                ->where('nombre', $prestamo->articulo)
                ->increment('cantidad_total');
        }
    }

    public function deleted(Prestamo $prestamo): void
    {
        // Regresar el artículo si se elimina el registro accidentalmente antes de devolverlo
        if ($prestamo->estado !== 'devuelto') {
            DB::table('material')
                ->where('nombre', $prestamo->articulo)
                ->increment('cantidad_total');
        }
    }
}