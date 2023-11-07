<?php

namespace App\Models;

use App\Models\Aula;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
 use HasFactory;
 protected $primaryKey = 'id';
 protected $table      = 'sections';
 public function aulas()
 {
  return $this->hasMany(Aula::class, 'section_id');
 }
}