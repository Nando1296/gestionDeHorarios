<?php

namespace App\Models;

use App\Models\UserRol;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class Usuario extends Authenticable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';

    public function user_rol()
    {
        return $this->hasMany(UserRol::class, 'usuario_id');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getRol()
    {
        $usuario = Auth::user();
        $roles = $usuario->user_rol;

        if (count($roles) == 0) throw new \Exception('Usuario no tiene rol asignado.');

        return $roles[0]->rol;
    }

    public function getAuthPassword() {
        return $this->contrasenia;
    }
}
