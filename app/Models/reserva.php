<?php

namespace App\Models;

use App\Models\AulaAsignada;
use App\Models\UserRol;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reserva extends Model
{use HasFactory;

    protected $table = 'reservas';
    protected $primaryKey = 'id';

    public function user_rol()
    {
        return $this->belongsTo(UserRol::class, 'user_rol_id');
    }
    public function aula_asignada()
    {
        return $this->hasMany(AulaAsignada::class, 'reserva_id');
    }
}