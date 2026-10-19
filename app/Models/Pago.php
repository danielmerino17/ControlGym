<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pago';
    protected $primaryKey = 'id_pago';

    public function membresia()
    {
        return $this->belongsTo(Membresia::class, 'id_membresia', 'id_membresia');
    }

    public function metodoPago()
    {
        return $this->belongsTo(MetodoPago::class, 'id_metodo_pago', 'id_metodo_pago');
    }

    public function usuarioRegistra()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario_registra', 'id_usuario');
    }
}