<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Materia_Carrera;
use App\Models\Aula;
use App\Models\horario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class cambioController extends Controller
{
    public function formulario(){
        $docentes=Usuario::all();
        $materia=Materia_Carrera::with('grupos')->with('materia')->where('carrera_id',1)->get();
        $aulas=Aula::all();
        $horariosOcupados=horario::all();
        $horarios=['6:45 - 8:15','8:15 - 9:45','9:45 - 11:15','11:15 - 12:45','12:45 - 14:15','14:15 - 15:45','15:45 - 17:15','17:15 - 18:45','18:45 - 20:15','20:15 - 21:45'];
        $dias=['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
        return view('formulario_Cambio_Horario',['docentes'=>$docentes,'materia_carreras'=>$materia,'aulas'=>$aulas,'horarios'=>$horarios,'dias'=>$dias,'horariosOcupados'=>$horariosOcupados]);
    }

    public function formularioDocente(){
        $docentes=Auth::user();

        $materias=collect();
         
            foreach ($docentes->user_rol[0]->asignacionDocentes as $asignacion){
                $materias->push($asignacion->grupos->materia_carrera::with('grupos')->with('materia')->where('carrera_id',1)->get());
            }
        $docentes=collect([Auth::user()]);
        $materias=$materias[0]->unique('materia_id');
        $aulas=Aula::all();
        $horarios=['6:45 - 8:15','8:15 - 9:45','9:45 - 11:15','11:15 - 12:45','12:45 - 14:15','14:15 - 15:45','15:45 - 17:15','17:15 - 18:45','18:45 - 20:15','20:15 - 21:45'];
        $dias=['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
       //return $materias;
        return view('formulario_Cambio_Horario',['docentes'=>$docentes,'materia_carreras'=>$materias,'aulas'=>$aulas,'horarios'=>$horarios,'dias'=>$dias]);
    }
}
