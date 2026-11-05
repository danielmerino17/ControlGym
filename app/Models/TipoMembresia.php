<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMembresia extends Model
{
    use HasFactory;

    protected $table = 'tipo_membresia';
    protected $primaryKey = 'id_tipo';
    protected $keyType = 'int';
    public $incrementing = true;

    protected $fillable = [
        'nombre',
        'duracion_dias',
        'costo',
        'activo',
    ];

    public function membresias()
    {
        return $this->hasMany(Membresia::class, 'id_tipo_membresia');
    }
}