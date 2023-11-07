<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMateriaCarrera;
use App\Models\Carrera;
use App\Models\Materia;
use App\Models\Materia_Carrera;
use Illuminate\Http\Request;

class MateriaCarreraController extends Controller
{
 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function index()
 {
  //
 }
 public function reporte()
 {
  $materia_carreras = Materia_Carrera::all();
  return view('Planilla-de-carrera-materia.reporte_materia_carrera', compact('materia_carreras'));
 }

 //Funcion para llamar a la vista de registro
 public function vistaRegistro()
 {
  //Seleccion de materias, carreras y la asociacion de estas
  $materias         = Materia::where('estado', true)->get();
  $carrera_materias = Materia_Carrera::where('estado',true)->get();
  $carreras         = Carrera::where('estado', true)->get();
  //Retorna vista de registro de materia-carrera y envia los datos necesarios
  return view('Planilla-de-carrera-materia.registro_planilla_carrera_materia', ['carreras' => $carreras, 'materias' => $materias, 'carrera_materias' => $carrera_materias]);
 }
 /**s
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
 public function registro(StoreMateriaCarrera $request)
 {
  //Busca si la materia que se desea asociar a la carrera ya existe
  $existe=Materia_Carrera::where('carrera_id',$request->carrera)->where('materia_id',$request->materia)->get();
  //Si existe (no esta vacio)
  if($existe->isNotEmpty()){
    //Habilita el registro
    $existe[0]->estado=true;
    $existe[0]->save();
  }else{
    //Almacena un nuevo registro
    $materia_carrera             = new Materia_Carrera();
    $materia_carrera->carrera_id = $request->carrera;
    $materia_carrera->materia_id = $request->materia;
    $materia_carrera->save();
  
  }
  //Redirecciona a la vista de registro de materia con el modal de registro exitoso
  return redirect()->route('materia_carrera')->with('registrar', 'ok');
 }

 /**
  * Display the specified resource.
  *
  * @param  \App\Models\Materia_Carrera  $materia_Carrera
  * @return \Illuminate\Http\Response
  */
 public function show(Materia_Carrera $materia_Carrera)
 {
  //
 }

 /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Models\Materia_Carrera  $materia_Carrera
  * @return \Illuminate\Http\Response
  */
 public function edit(Materia_Carrera $materia_Carrera)
 {
  //
 }

 /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Models\Materia_Carrera  $materia_Carrera
  * @return \Illuminate\Http\Response
  */
 public function update(Request $request, Materia_Carrera $materia_Carrera)
 {
  //
 }

 /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Models\Materia_Carrera  $materia_Carrera
  * @return \Illuminate\Http\Response
  */
 public function busqueda(Request $request)
 {
  try {
   $materiaCarrera = Materia_Carrera::query();

   if ($request->has('search')) {
    $materiaCarrera->where('id', 'like', $request->search);
   }
   $materiasCarrera = $materiaCarrera->get();
   return view('Planilla-de-carrera-materia.eliminar_materia_carrera', compact('materiasCarrera'));
  } catch (\Throwable $th) {
   return redirect()->route('eliminar-materia-carrera')->with('buscar', 'error');

  }

 }
 public function estado($materia_carrera)
 {
  $materia_carrera         = Materia_Carrera::find($materia_carrera);
  $materia_carrera->estado = false;
  $materia_carrera->save();
  $materia_carrera->grupos()->each(function ($grupo) {
   $grupo->where('id', $grupo->id)->update(['estado' => false]);
   $grupo->asignacionDocentes()->each(function ($asignacionDocentes) {
    $asignacionDocentes->where('id', $asignacionDocentes->id)->update(['estado' => false]);
   });
  });

  return redirect()->route('eliminar-materia-carrera')->with('eliminar', 'ok');
 }
}