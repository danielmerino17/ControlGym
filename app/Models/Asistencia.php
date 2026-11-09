<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $table = 'asistencia';
    protected $primaryKey = 'id_asistencia';

    // Asignación de campos que pueden ser llenados desde la interfaz de usuario.
    protected $fillable = [
        'id_cliente',
        'fecha_hora',
        'resultado', // Permitido o denegado.
        'motivo_denegacion',
    ];

    // Conversión automática de tipos de datos para ciertos campos.
    protected $casts = [
        'fecha_hora' => 'datetime',
    ];

    // Cada registro de acceso / asistencia pertenece a un cliente específico.
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }
}