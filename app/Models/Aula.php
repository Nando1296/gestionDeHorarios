<?php

namespace App\Models;

use App\Models\AulaAsignada;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
 use HasFactory;
 protected $table      = 'aulas';
 protected $primaryKey = 'id';
 public function section()
 {
  return $this->belongsTo(Seccion::class, 'section_id');
 }
 public function aula_asignada()
 {
  return $this->hasMany(AulaAsignada::class, 'aula_id');
 }

}