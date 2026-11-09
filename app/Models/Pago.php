<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pago';
    protected $primaryKey = 'id_pago';

    // Se especifica qué controlamos respecto a los datos financieros se pueden guardar desde el sistema.
    protected $fillable = [
        'id_membresia',
        'id_metodo_pago',
        'id_usuario_registra',
        'id_usuario_autoriza',
        'monto',
        'descuento',
        'fecha_hora',
        'folio_comprobante',
    ];

    // Asegura que los montos financieros se manejen siempre con 2 decimales para evitar errores de cálculo, y convierte la fecha_hora a un formato manipulable.
    protected $casts = [
        'fecha_hora' => 'datetime',
        'monto' => 'decimal:2',
        'descuento' => 'decimal:2',
    ];

    // Relación: cada pago está amarrado a una única membresía.
    public function membresia()
    {
        return $this->belongsTo(Membresia::class, 'id_membresia', 'id_membresia');
    }

    // Relación: cada pago se realiza mediante un método de pago específico (Efectivo, Tarjeta, etc.).
    public function metodoPago()
    {
        return $this->belongsTo(MetodoPago::class, 'id_metodo_pago', 'id_metodo_pago');
    }
}