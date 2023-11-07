<?php

namespace App\Models;

use App\Models\Materia_Carrera;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'carreras';
    public function materia__carreras()
    {
        return $this->hasMany(Materia_Carrera::class);
    }
}