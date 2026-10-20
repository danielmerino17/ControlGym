<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios'; // Especificamos que usamos la tabla en español

    protected $fillable = [
        'name',
        'email',
        'password',
        'rol_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relación con la tabla Roles
    public function rol() 
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    // Relación con la bitácora
    public function bitacoras() 
    {
        return $this->hasMany(Bitacora::class, 'user_id');
    }
}