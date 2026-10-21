<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'rol'; 
    

    protected $fillable = ['nombre', 'descripcion'];

    public function usuarios() {
        return $this->hasMany(User::class);
    }

    public function permisos() {
        return $this->belongsToMany(Permiso::class, 'rol_permiso', 'rol_id', 'permiso_id');
    }
}