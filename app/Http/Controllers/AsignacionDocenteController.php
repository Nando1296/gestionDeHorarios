<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAsignacion;
use App\Models\asignacionDocentes;
use App\Models\gestion;
use App\Models\Grupo;
use App\Models\Materia;
use App\Models\UserRol;
use App\Models\Aula;
use App\Models\horario;
use Illuminate\Http\Request;

class AsignacionDocenteController extends Controller
{

 //Funcion para llamar a la vista de registro y envio de los datos necesarios para la vista
 public function vistaRegistro()
 {
  //Seleccion de materias y los grupos asociados a cada materia de todas las carreras
  $materias       = Materia::where('estado', true)->get();
  $grupos         = Grupo::join("materia_carreras", "materia_carreras.id", "=", "grupos.materia_carrera_id")->join("materias", "materias.id", "=", "materia_carreras.materia_id")->where('grupos.estado', true)->select("grupos.*", "materias.id as materia_id")->get();
  //Filtro de un solo grupo de una materia para todas las carreras asociadas
  $grupos=$grupos->unique(function ($item) {
    return $item['nombre'].$item['materia_id'];
  });
  //Seleccion de todos los docentes, la gestion actual y todas las asignaciones de la gestion actual
  $docentes       = UserRol::all();
  $gestion        = gestion::firstWhere('estado', true);
  $docente_grupos = asignacionDocentes::where('gestion_id', $gestion->id)->get();
 //Filtro de grupos que aun no tienen una asignacion de docente
  $filtered       = $grupos->reject(function ($value, $key) {
   $gestion        = gestion::firstWhere('estado', true);
   $docente_grupos = asignacionDocentes::where('gestion_id', $gestion->id)->where('estado', true)->get();
   return $docente_grupos->contains('grupo_id', $value->id);
  });
  //Devuelve la vista de registro de asignaciones
  return view('Asignacion-Docente.registro_asignacion_docente', ['materias' => $materias, 'docentes' => $docentes,'grupos' => $filtered]);
 }

 //Guardado de datos del registro de asignacion
 public function registro(StoreAsignacion $request)
 {
  //Seleccion de los grupos de la materia en las distintas carreras
  $grupos = Grupo::join("materia_carreras", "materia_carreras.id", "=", "grupos.materia_carrera_id")->join("materias", "materias.id", "=", "materia_carreras.materia_id")->where('grupos.estado', true)->where('grupos.nombre', $request->grupo)->where('materias.id', $request->materia)->select("grupos.id")->get();
  
  //Seleccion de la gestion actual
  $gestion = gestion::firstWhere('estado', true);
  //Insertar un registro o habilitar un registro deshabilitado
  foreach ($grupos as $grupo) {
    $deshabilitado=asignacionDocentes::where('grupo_id',$grupo->id)->where('user_rol_id', $request->docente)->where('gestion_id',$gestion->id)->where('estado',false)->get();
    
    if($deshabilitado->isNotEmpty()){
        $deshabilitado[0]->estado=true;
        $deshabilitado[0]->save();
    }else{
        $asignacion_docente              = new asignacionDocentes();
        $asignacion_docente->user_rol_id = $request->docente;
        $asignacion_docente->grupo_id    = $grupo->id;
        $asignacion_docente->gestion_id  = $gestion->id;
        $asignacion_docente->save();
    }
  
  }
 
  //regireccion a la pagina con el modal de registro exitoso
  return redirect()->route('materia_docente')->with('registrar', 'ok');
 }

 public function busqueda(Request $request)
 {

  try {
   $asignacionDocente = asignacionDocentes::query();

   if ($request->has('search')) {
    $asignacionDocente->where('id', 'like', $request->search);
   }
   $asignacionDocentes = $asignacionDocente->get();
   return view('Asignacion-Docente.eliminar_asignacion_docente', compact('asignacionDocentes'));

  } catch (\Throwable $th) {
   return redirect()->route('eliminar-asignacion-docente')->with('buscar', 'error');

  }

 }
 public function reporte()
 {

  
 
 
  $asignacionDocentesH = asignacionDocentes::join("grupos","grupos.id","=","asignacion_docentes.grupo_id")->join('materia_carreras','materia_carreras.id',"=","grupos.materia_carrera_id")->where('asignacion_docentes.estado',true)->select('asignacion_docentes.*','grupos.nombre','materia_id')->get();
  $asignacionDocentesI = asignacionDocentes::join("grupos","grupos.id","=","asignacion_docentes.grupo_id")->join('materia_carreras','materia_carreras.id',"=","grupos.materia_carrera_id")->where('asignacion_docentes.estado',false)->select('asignacion_docentes.*','grupos.nombre','materia_id')->get();
  
  $asignacionDocentesH=$asignacionDocentesH->unique(function ($item) {
    return $item['nombre'].$item['materia_id'];
    });
 
  $asignacionDocentesI=$asignacionDocentesI->unique(function ($item) {
      return $item['nombre'].$item['materia_id'];
    });
    
   
    $asignacionDocentes=$asignacionDocentesH->merge($asignacionDocentesI);
    
   

    $asignacionDocentes=$asignacionDocentes->unique(function ($item) {
      return $item['nombre'].$item['materia_id'];
    });


  return view('Asignacion-Docente.reporte_asignacion_docente', compact('asignacionDocentes'));

 }
 public function estado($asignacion_docente)
 {
  $asignacion_docente  = asignacionDocentes::find($asignacion_docente);
  $asignacion_docentes = asignacionDocentes::all();
  foreach ($asignacion_docentes as $asignacion_docente_) {
   if ($asignacion_docente_->user_rol->usuario->Nombre == $asignacion_docente->user_rol->usuario->Nombre && $asignacion_docente_->grupos->nombre == $asignacion_docente->grupos->nombre && $asignacion_docente_->grupos->materia_carrera->materia->nombre_materia == $asignacion_docente->grupos->materia_carrera->materia->nombre_materia) {
    $asignacion_docente_->estado = false;
    $asignacion_docente_->save();
   }
  }

  // dump($asignacion_docente->user_rol->usuario->Nombre);
  return redirect()->route('eliminar-asignacion-docente')->with('eliminar', 'ok');
 }

 public function horarios(){
  $asignaciones=asignacionDocentes::all();
  $aulas=Aula::all();

  return view('horarios',['asignaciones'=>$asignaciones,'aulas'=>$aulas]);
 }

 public function storeHorario(Request $request){
  $horario=new horario;
  $horario->grupo_id=$request->grupo;
  $horario->dia=$request->dia;
  $horario->horario=$request->horario;
  $horario->aula=$request->aula;

  $horario->save();

  return  redirect('horarios')->with('registrar', 'ok');
 }
}