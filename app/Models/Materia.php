<?php

namespace App\Models;

use App\Models\Materia_Carrera;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'materias';

    public function materia__carreras()
    {
        return $this->hasMany(Materia_Carrera::class);
    }
}