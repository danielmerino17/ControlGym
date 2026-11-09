<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membresia extends Model
{
    use HasFactory;

    protected $table = 'membresia';
    protected $primaryKey = 'id_membresia'; // Definir la PK correcta

    // Solo estos campos pueden ser insertados o actualizados directamente desde los formularios de Filament.
    protected $fillable = [
        'id_cliente',
        'id_tipo',
        'id_membresia_anterior',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'motivo_cancelacion',
        'fecha_cancelacion',
    ];

    // Convierte automáticamente las fechas de la base de datos (strings) a objetos de Carbon (biblioteca de PHP que facilita manejo de fechas).
    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'fecha_cancelacion' => 'datetime',
    ];

    // Una membresía pertenece a un único Cliente.
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    // Una membresía pertenece a un Tipo de Membresía específico (Mensual, Anual, etc.).
    public function tipoMembresia()
    {
        return $this->belongsTo(TipoMembresia::class, 'id_tipo', 'id_tipo');
    }

    // Una membresía puede tener muchos Pagos registrados (relación 1 a muchos).
    public function pagos()
    {
        return $this->hasMany(Pago::class, 'id_membresia', 'id_membresia');
    }
}