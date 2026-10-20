<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $fillable = ['user_id', 'accion', 'modulo', 'detalles', 'ip_address'];

public function usuario() {
    return $this->belongsTo(Usuario::class, 'user_id');
}
}
