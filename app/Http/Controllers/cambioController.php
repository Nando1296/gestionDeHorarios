<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Materia_Carrera;
use App\Models\Aula;

class cambioController extends Controller
{
    public function formulario(){
        $docentes=Usuario::all();
        $materia=Materia_Carrera::where('carrera_id',1)->get();
        $aulas=Aula::all();

        return view('formulario_Cambio_Horario',['docentes'=>$docentes,'materia_carreras'=>$materia,'aulas'=>$aulas]);
    }
}
