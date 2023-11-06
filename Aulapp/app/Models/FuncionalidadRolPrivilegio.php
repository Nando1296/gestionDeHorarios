<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuncionalidadRolPrivilegio extends Model
{
    protected $table = 'funcionalidad_rol_privilegios';

    public function funcionalidad()
    {
        return $this->belongsTo(Funcionalidad::class);
    }
}
