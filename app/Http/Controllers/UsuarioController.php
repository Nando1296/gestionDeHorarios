<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsuario;
use App\Models\UserRol;
use App\Models\Usuario;
use App\Notifications\Usuario as NotificationsUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
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
  $usuarios = Usuario::all();
  return view('Usuario-Docente.reporte_docente', compact('usuarios'));

 }

 //Funcion para llamar a la vista de registro
 public function vistaRegistro()
 {
  return view('Usuario-Docente.registrar_docente');
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

  //Guardado de datos del registro de docente
 public function registro(StoreUsuario $request)
 {
//Almacena un nuevo registro de docente
  $usuario           = new Usuario();
  $usuario->Nombre   = $request->nombre;
  $usuario->Apellido = $request->apellido;
  $usuario->CI       = $request->ci;
  $usuario->Email    = $request->email;
//Separamos por espacion
  $user       = explode(" ", $request->nombre);
  $iniciales  = "";
  $caracteres = "";
  //Recorremos todo el nombre
  for ($i = 0; $i < sizeof($user); $i++) {
    //Si no es vacio
   if ($user[$i] != "") {
    //Obtenemos la primera letra y la concatenamos a una variable para guardar la inicial
    $iniciales = $iniciales . substr($user[$i], 0, 1);
    //Concatenamos el nombre a una variable para guardar
    $caracteres .= $user[$i];
   }
  }
  //Concatenamos el CI para obtener un conjunto de caractere
  $caracteres .= $request->ci;
  //Obtenemos una cadena de 10 caracteres de la mezcla de caracteres
  $Usercontrasenia = substr(str_shuffle($caracteres), 0, 10);
  //Concatenamos si CI mas sus iniciales para el nombre de usuario
  $User            = $request->ci . $iniciales;

  $usuario->usuario     = $User;
  $usuario->contrasenia = $Usercontrasenia;
  $usuario->save();

  //Asignamos en user rol el rol de docente
  $userRol             = new UserRol();
  $id_usuario          = Usuario::firstWhere('CI', $request->ci);
  $userRol->usuario_id = $id_usuario->id;
  $userRol->rol_id     = 2;
  $userRol->save();
 //Redirecciona al registro de docente con el modal de registro exitoso
  return redirect()->route('docentes')->with('registrar', "ok");
 }

 /**
  * Display the specified resource.
  *
  * @param  \App\Models\Usuario  $usuario
  * @return \Illuminate\Http\Response
  */
 public function show(Usuario $usuario)
 {
  //
 }

 /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Models\Usuario  $usuario
  * @return \Illuminate\Http\Response
  */
 public function edit(Usuario $usuario)
 {
  //
 }

 /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Models\Usuario  $usuario
  * @return \Illuminate\Http\Response
  */
 public function editar(Request $request, $id)
 {
    //Buscar el docente para editar
  $docente = Usuario::find($id);
  //Validar los campos 
  $request->validate([
   'Nombre'   => 'bail|required|regex:/^[a-zA-Z\s áéíóúÁÉÍÓÚñÑ]+$/u|min:3|max:25',
   'Apellido' => 'bail|required|regex:/^[a-zA-Z\s áéíóúÁÉÍÓÚñÑ]+$/u|min:2|max:30',
   'CI'       => 'bail|required|numeric|digits_between:6,10|unique:usuarios,CI,' . $docente->id,
   'Correo'   => 'bail|required|email|regex:/^[a-zA-Z\s 0-9 @ . _]+$/|unique:usuarios,Email,' . $docente->id,
  ]);
  //Asignar los nuevos valores al docente
  $docente->estado   = $request->estadoE;
  $docente->Nombre   = $request->Nombre;
  $docente->Apellido = $request->Apellido;
  $docente->CI       = $request->CI;
  $docente->Email    = $request->Correo;
  //Guardar los cambios
  $docente->save();
  //Cambiar el estado del docente en caso de que sea dado de alta
  $sql=DB::table("user_rols")->where(['usuario_id'=>$id])->value('id');
  $asignacion=UserRol::find($sql);
  $asignacion->estado=$request->estadoE;
  //Guardar los cambios
  $asignacion->save();
  //Redireccionar a vista  de editar docente
  return redirect()->route('docentes_edit')->with('actualizar', 'ok');
 }

 public function vistaEditar()
 {
    //Recuperar todos los usuarios y todas las asignaciones usuario rol
  $docentes = Usuario::all();
  $urs      = UserRol::all();

//Redireccionar a la vista editar docente
  return view('Usuario-Docente.editar_docente', ['docentes' => $docentes, 'urs' => $urs]);


 }

 /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Models\Usuario  $usuario
  * @return \Illuminate\Http\Response
  */
 public function busqueda(Request $request)
 {
  $rols = UserRol::all();
  try {
   $usuario = Usuario::query();

   if ($request->has('search')) {
    $usuario->where('CI', 'like', $request->search);
   }
   $usuarios = $usuario->get();
   return view('Usuario-Docente.eliminar_docente', compact('usuarios', 'rols'));

  } catch (\Throwable $th) {
   return redirect()->route('eliminar-docente')->with('buscar', 'error');

  }

 }
 public function estado(Request $request, $usuario)
 {
  $usuario = Usuario::find($usuario);
  $usuario->where('id', $request->usuario)->update(['estado' => false]);

  $usuario->user_rol()->each(function ($user_rol) {
   $user_rol->where('id', $user_rol->id)->update(['estado' => false]);
   $user_rol->asignacionDocentes()->each(function ($asignacion_docente) {
    $asignacion_docente->where('id', $asignacion_docente->id)->update(['estado' => false]);

   });
  });

  return redirect()->route('eliminar-docente')->with('eliminar', 'ok');
 }


}
