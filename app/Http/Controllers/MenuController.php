<?php

namespace App\Http\Controllers;

use App\Models\nuevasnotificacion;
use App\Models\UserRol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function loadMenu(Request $request)
    {
        $usuario = Auth::user();
        $rol = $usuario->getRol();

        $privilegios = $this->obtenerPrivilegios($rol);
        $ur = UserRol::where("usuario_id",$usuario->id)->get();

       return view('menu', [
            'rol' => $rol,
            'privilegios' => $privilegios,
           "not"=> 0
        ]);

    }


    public function loadPerfil()
    {
        $usuario = Auth::user();
    
     return view('Perfil-Usuario.perfil', ['usuario' => $usuario]);
    }

    private function obtenerPrivilegios($rol)
    {
        return $rol->privilegios()
            ->with('funcionalidad')
            ->where('listar', true)
            ->get();
    }
}
