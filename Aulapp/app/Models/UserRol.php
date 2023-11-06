<?php

namespace App\Models;

use App\Models\asignacionDocentes;
use App\Models\reserva;
use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRol extends Model
{
    use HasFactory;
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
    public function asignacionDocentes()
    {
        return $this->hasMany(asignacionDocentes::class, 'user_rol_id');
    }
    public function reserva()
    {
        return $this->hasMany(reserva::class, 'user_rol_id');
    }
}