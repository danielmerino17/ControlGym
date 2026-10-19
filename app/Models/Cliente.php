<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';
    protected $primaryKey = 'id_cliente';

    public function membresias()
    {
        return $this->hasMany(Membresia::class, 'id_cliente', 'id_cliente');
    }
}