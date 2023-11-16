<?php

namespace App\Models;

use App\Models\Grupo;
use App\Models\UserRol;
use App\Models\gestion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asignacionDocentes extends Model
{
    use HasFactory;
    public function grupos()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }
    public function gestion()
    {
        return $this->belongsTo(gestion::class, 'gestion_id');
    }
    public function user_rol()
    {
        return $this->belongsTo(UserRol::class, 'user_rol_id');
    }

    public function horarios()
    {
        return $this->hasMany(horario::class, 'grupo_id');
    }
}