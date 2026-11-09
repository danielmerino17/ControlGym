<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    // Apunta a la tabla correcta de la migración.
    protected $table = 'prestamos';

    // Campos que el usuario puede llenar desde la interfaz de registro.
    protected $fillable = [
        'id_cliente',
        'articulo',
        'fecha_prestamo',
        'fecha_devolucion',
        'estado',
        'observaciones',
    ];

    // Un préstamo individual pertenece (fue solicitado por) a un solo cliente.
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }
}