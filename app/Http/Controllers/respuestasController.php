<?php

namespace App\Http\Controllers;

use App\Models\AulaAsignada;
use App\Models\reserva;
use App\Models\UserRol;
use App\Models\nuevasnotificacion;
use Illuminate\Support\Facades\Auth;


class respuestasController extends Controller
{
 public function verBandeja()
 {
  $usuario = Auth::user();

  $ur = UserRol::where("usuario_id",$usuario->id)->get();
  $not= nuevasnotificacion::where("user_rol_id",$ur[0]->id)->get();
  if($not!="[]"){
    $not[0]->cantidad_not=0;
    $not[0]->save();
  }
  $respuestas = reserva::where('docentes', 'LIKE', '%' . $usuario->Nombre." ".$usuario->Apellido . '%')
  ->get()->sortDesc();
  return view('Bandejas.bandeja_docente', ['respuestas' => $respuestas]);
 }

 public function respuestas($tipo,$id)
 {
  $mensaje = reserva::firstWhere('id', $id);
  $aulas   = AulaAsignada::join("aulas", "aulas.id", "aula_asignadas.aula_id")->where('reserva_id', $mensaje->id)
  ->select("aulas.nombre")->get();

  $aulas = $aulas->implode('nombre', ',');

  return view('Bandejas.respuesta_solicitud', ['mensaje' => $mensaje, 'aulas' => $aulas,'tipo'=>$tipo]);
 }
}