<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membresia extends Model
{
    protected $table = 'membresia';
    protected $primaryKey = 'id_membresia';

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    public function tipoMembresia()
    {
        return $this->belongsTo(TipoMembresia::class, 'id_tipo', 'id_tipo');
    }

    public function membresiaAnterior()
    {
        return $this->belongsTo(Membresia::class, 'id_membresia_anterior', 'id_membresia');
    }

    public function pago()
    {
        return $this->hasOne(Pago::class, 'id_membresia', 'id_membresia');
    }
}