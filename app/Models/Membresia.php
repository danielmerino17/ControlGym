<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membresia extends Model
{
    use HasFactory;

    protected $table = 'membresia';
    protected $primaryKey = 'id_membresia'; // Definir la PK correcta

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

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'fecha_cancelacion' => 'datetime',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    public function tipoMembresia()
    {
        return $this->belongsTo(TipoMembresia::class, 'id_tipo', 'id_tipo');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'id_membresia', 'id_membresia');
    }
}