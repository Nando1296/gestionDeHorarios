<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    public function user_rol()
    {
        return $this->hasMany(UserRol::class, 'rol_id');
    }

    public function privilegios()
    {
        return $this->hasMany(FuncionalidadRolPrivilegio::class, 'rol_id');
    }
}
