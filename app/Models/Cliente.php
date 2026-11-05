<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    // Apunta a la tabla correcta de la migración
    protected $table = 'cliente'; 

    protected $primaryKey = 'id_cliente'; // Clave primaria personalizada.

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'telefono',
        'correo',
        'documento_identidad',
        'fecha_registro',
        'contacto_emergencia',
        'observaciones',
        'activo', // Campo importante para la baja lógica
    ];

    // Atributo para mostrar el nombre completo en selects y tablas
    public function getNombreCompletoAttribute(): string
    {
        return trim("{$this->nombre} {$this->apellido_paterno} {$this->apellido_materno}");
    }

    // Relación: un cliente tiene muchas membresías.
    public function membresias()
    {
        return $this->hasMany(Membresia::class, 'id_cliente');
    }

    // Relación: Un cliente tiene muchos pagos.
    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }

    // Relación: Un cliente tiene muchos préstamos de material.
    public function prestamos()
    {
        return $this->hasMany(Prestamo::class);
    }
}