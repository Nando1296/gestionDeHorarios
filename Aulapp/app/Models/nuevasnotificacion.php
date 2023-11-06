<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nuevasnotificacion extends Model
{
    use HasFactory;
    public function user_rol()
    {
        return $this->belongsTo(UserRol::class, 'user_rol_id');
    }
}
