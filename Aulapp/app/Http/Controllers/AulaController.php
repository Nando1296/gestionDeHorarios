<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAula;
use App\Models\Aula;
use App\Models\AulaAsignada;
use App\Models\reserva;
use App\Models\Seccion;
use App\Notifications\NotificacionReserva;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;

class AulaController extends Controller
{
 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
//Funcion para llamar a la vista de registro y envio de los datos necesarios para la vista
 public function vistaRegistro()
 {
 //Seleccion de secciones
  $seccions = Seccion::where('estado', true)->get();
  //Retorna la vista de registro de aulas con los datos de las secciones
  return view('Aula.registrar_aula', ['seccions' => $seccions]);
 }
 public function reporte()
 {

  $aulas = Aula::all();
  return view('Aula.reporte_aula', compact('aulas'));

 }

 public function vistaEditar()
 {
    //envia la informacion de todas las aulas y secciones , accede a la vista de editar aulas
  $aulas     = Aula::all();
  $secciones = Seccion::all();
  return view('Aula.editar_aula', ['secciones' => $secciones, 'aulas' => $aulas]);

 }
 /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function create()
 {
  //
 }

 /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
//Guardado de datos del registro de aula
 public function registro(StoreAula $request)
 {
 //Almacenado de aula
  $aula             = new Aula();
  $aula->nombre     = $request->nombre;
  $aula->capacidad  = $request->capacidad;
  $aula->section_id = $request->seccion;

  $aula->save();
    //Redireccion a la vista de registro de aulas con el modal de registro exitoso
  return redirect()->route('aulas')->with('registrar', 'ok');
 }

 /**
  * Display the specified resource.
  *
  * @param  \App\Models\Aula  $aula
  * @return \Illuminate\Http\Response
  */
 public function show(Aula $aula)
 {
  //
 }

 /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Models\Aula  $aula
  * @return \Illuminate\Http\Response
  */
 public function edit(Aula $aula)
 {
  //
 }

 /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Models\Aula  $aula
  * @return \Illuminate\Http\Response
  */
 public function editar(Request $request, $id)
 {
    //recupera el aula a ser editada 
  $aula = Aula::find($id);
  //validar la informacion de los campos
  $request->validate([
   'Nombre'    => 'bail|required|regex:/^[a-zA-Z\s áéíóúÁÉÍÓÚñÑ 0-9]+$/|min:3|max:10|unique:aulas,nombre,' . $aula->id,
   'capacidad' => 'bail|required|numeric|between:1,300',
  ]);
  //llenar los atributos del aula con los nuevos
  $aula->nombre     = $request->Nombre;
  $aula->capacidad  = $request->capacidad;
  $aula->section_id = $request->section;
  $aula->estado     = $request->estadoE;
  //guardar los datos del aula
  $aula->save();
  //redirigir a la pagina de edicion de aula
  return redirect()->route('aulas_edit')->with('actualizar', 'ok');
 }

 /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Models\Aula  $aula
  * @return \Illuminate\Http\Response
  */
 public function busqueda(Request $request)
 {
  try {
   $aula = Aula::query();

   if ($request->has('search')) {
    $aula->where('nombre', 'like', $request->search);
   }
   $aulas = $aula->get();
   return view('Aula.eliminar_aula', compact('aulas'));

  } catch (\Throwable $th) {
   return redirect()->route('eliminar-aula')->with('buscar', 'error');

  }

 }
 public function estado($id)
 {
  $aulas_asignadas = AulaAsignada::all();
  $aula            = Aula::find($id);
  $reservas        = reserva::all();
  $fecha           = Carbon::now();
  foreach ($aulas_asignadas as $aula_asignada) {
   if ($aula_asignada->aula_id == $aula->id) {
    foreach ($reservas as $reserva) {

     if ($reserva->id == $aula_asignada->reserva_id && $reserva->fecha_examen == $fecha->toDateString() && $reserva->estado == 'aceptado' && ($fecha->toTimeString() < $reserva->hora_inicio || $reserva->hora_fin > $fecha->toTimeString())) {
      foreach ($aulas_asignadas as $aula_asignada) {
       if ($aula_asignada->reserva_id == $reserva->id) {
        $aula_asignada->delete();
       }
      }

      $reserva->estado = "reasignar";
      $reserva->save();
      Notification::route('mail', $reserva->user_rol->usuario->Email)->notify(new NotificacionReserva($reserva));
     } else if ($reserva->id == $aula_asignada->reserva_id && $reserva->fecha_examen > $fecha->toDateString() && $reserva->estado == 'aceptado') {
      foreach ($aulas_asignadas as $aula_asignada) {
       if ($aula_asignada->reserva_id == $reserva->id) {
        $aula_asignada->delete();
       }
      }

      $reserva->estado = "reasignar";
      $reserva->save();

      Notification::route('mail', $reserva->user_rol->usuario->Email)->notify(new NotificacionReserva($reserva));
     }
    }
   }
  }

  $aula->estado = false;
  $aula->save();

  return redirect()->route('eliminar-aula')->with('eliminar', 'ok');

 }
}