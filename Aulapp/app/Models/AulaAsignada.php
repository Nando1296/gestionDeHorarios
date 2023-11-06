<?php

namespace App\Models;

use App\Models\Aula;
use App\Models\reserva;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AulaAsignada extends Model
{
    use HasFactory;
    protected $table = 'aula_asignadas';
    protected $primaryKey = 'id';
    public function reserva()
    {
        return $this->belongsTo(reserva::class, 'reserva_id');
    }
    public function aula()
    {
        return $this->belongsTo(Aula::class, 'aula_id');
    }
}