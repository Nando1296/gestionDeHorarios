<?php

namespace App\Models;

use App\Models\Carrera;
use App\Models\Materia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia_Carrera extends Model
{
 use HasFactory;
 protected $table      = 'materia_carreras';
 protected $primaryKey = 'id';

 public function carrera()
 {
  return $this->belongsTo(Carrera::class, 'carrera_id');
 }
 public function materia()
 {
  return $this->belongsTo(Materia::class, 'materia_id');
 }
 public function grupos()
 {
  return $this->hasMany(Grupo::class, 'materia_carrera_id');
 }

}
