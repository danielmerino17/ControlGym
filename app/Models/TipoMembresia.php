<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoMembresia extends Model
{
    protected $table = 'tipo_membresia';
    protected $primaryKey = 'id_tipo';

    public function membresias()
    {
        return $this->hasMany(Membresia::class, 'id_tipo', 'id_tipo');
    }
}