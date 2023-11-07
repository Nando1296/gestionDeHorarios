<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\asignacionDocentes;
use App\Models\Aula;
use App\Models\AulaAsignada;
use App\Models\diasExamen;
use App\Models\gestion;
use App\Models\nuevasnotificacion;
use App\Models\reserva;
use App\Models\UserRol;
use App\Notifications\NotificacionReserva;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class reservaController extends Controller
{

 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function index()
 {
 }

 public function vistaRegistro()
 {
  //Recuperamos el usuario autentificado
  $usuario = Auth::user();
  //Filtrar las gestiones y recuperar la habilitada
  $gestion=gestion::where("estado",1)->get();
  //Para la campanade notificaciones recuperar el numero de notificaciones nuevas
  $ur = UserRol::where("usuario_id",$usuario->id)->get();
  $not= nuevasnotificacion::where("user_rol_id",$ur[0]->id)->get();
  $cantidad=0;
       if($not!="[]"){
            $cantidad=$not[0]->cantidad_not;
        }
        //Recuperar solo las materias que son dictadas por el docente
  $materias= asignacionDocentes::join("user_rols","user_rols.id","=","asignacion_docentes.user_rol_id")->where("user_rols.usuario_id",$usuario->id)->where("asignacion_docentes.gestion_id",$gestion[0]->id)->join("grupos","grupos.id",'=','asignacion_docentes.grupo_id')->join("materia_carreras","materia_carreras.id","=","grupos.materia_carrera_id")->join("materias","materias.id","=","materia_carreras.materia_id")->select("materias.nombre_materia")->get()->unique("nombre_materia");
        //Recuperar las asignaciones vigentes en la gestion
  $ads = asignacionDocentes::where("gestion_id",$gestion[0]->id)->get();
        // Recuperar los dias no habiles
  $diasNoHabiles=diasExamen::where("estado",false)->get();

//Redireccionar a la vista de registro de reserva
  return view('Reserva.registrar_reserva', ['ads' => $ads, 'materias'=>$materias, 'usuario'=>$usuario,'diasNoHabiles'=>$diasNoHabiles,"not" =>$cantidad ,"id"=>$ur[0]->id]);


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
 public function registro(Request $request)
 {
  //Registrar la reserva en la base de daros juto a todos sus atributos
  $reserva                 = new reserva();
  $reserva->motivo         = $request->motivo;
  $reserva->estado         = "enviado";
  $reserva->fecha_examen   = $request->fecha;
  $reserva->hora_inicio    = $request->horario;
  $reserva->hora_fin       = $request->fechaf;
  $reserva->cantE          = $request->cantidad;
  $reserva->grupos         = $request->grupos;
  $reserva->docentes       = $request->docentes;
  $reserva->materia        = $request->materia;
  $reserva->user_rol_id    = $request->id;
  $reserva->motivo_rechazo = "";

  //Guardar el registro
 $reserva->save();
 //buscar si el administraor recibio solicitudes con anterioridad
  $buscar_usuario=UserRol::where("rol_id",1)->get();
  $buscar_not=nuevasnotificacion::where("user_rol_id",$buscar_usuario[0]->id)->get();
    //En caso de no encontrar se crea una nueva asignacion para que tenga su contador de nuevas reservas
  if($buscar_not=="[]"){
    $notificacion=new nuevasnotificacion();
    $notificacion->user_rol_id=$buscar_usuario[0]->id;
    $notificacion->cantidad_not=1;
    $notificacion->save();

  }else{
    //En caso de encotrar su contador de notificaciones aumentara en uno
    $buscar_not[0]->cantidad_not=$buscar_not[0]->cantidad_not+1;
    $buscar_not[0]->save();

  }
    //Redirecciona a la vista de registro de reserva 
  return redirect()->route('registro_reserva')->with('actualizar', 'ok');
 }

 /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */

 public function respuesta(Request $request, $id, $estado)
 {
  $aulas_asignadas = [];
  //El estado 0  es en caso de que la reserva fue rechazada
  if ($estado == 0) {
    //Se valida el motivo
   $request->validate([
    'motivo_rechazo' => 'required',
   ]);
   //modificar los valores de la reserva con los nuevos valores
   $rechazado                 = reserva::find($id);
   $rechazado->estado         = "rechazado";
   $rechazado->motivo_rechazo = $request->motivo_rechazo;
   //Guardar cambios en la reserva
   $rechazado->save();
   //Enviar email al docente
   Notification::route('mail', $rechazado->user_rol->usuario->Email)->notify(new NotificacionReserva($rechazado)); /* para usar cuando se guarde la reserva */

  } else {
    //en caso de que la reserva sea aceptada
   $aceptado         = reserva::find($id);
   $aceptado->estado = "aceptado";
   //guardar los cambios en la reserva
   $aceptado->save();
   //Reservar las aulas correspondientes
   $aulas = explode(",", $request->aulas_nombres);
   for ($i = 0; $i < sizeof($aulas); $i++) {
    $aula_asignada             = new AulaAsignada();
    $sql                       = Aula::where("nombre", $aulas[$i])->value("id");
    $aula_asignada->reserva_id = $id;
    $aula_asignada->aula_id    = $sql;
    $aula_asignada->save();
    $aulas_asignadas[] = $aula_asignada;
   }
   //Enviar email al docente
   Notification::route('mail', $aceptado->user_rol->usuario->Email)->notify(new NotificacionReserva($aceptado, $aulas_asignadas)); /* para usar cuando se guarde la reserva */
   
}
$buscar_reserva=reserva::find($id);
//Buscar si el docente que hizo la reserva tuvo alguna ves una respuesta a sus solicitudes
$buscar_not=nuevasnotificacion::where("user_rol_id",$buscar_reserva->user_rol_id)->get();
//En caso de que no se crea una nueva asignacion de nuevas reservas
  if($buscar_not=="[]"){
    $notificacion=new nuevasnotificacion();
    $notificacion->user_rol_id=$buscar_reserva->user_rol_id;
    $notificacion->cantidad_not=1;
    $notificacion->save();
// En caso de que si haya tenido su contador de reservas aumenta en 1
  }else{
    $buscar_not[0]->cantidad_not=$buscar_not[0]->cantidad_not+1;
    $buscar_not[0]->save();

  }
  //Redireccionar a la bandeja del administrador
return redirect()->route('respuestaAdmin')->with('actualizar', 'ok');
}

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $reserva        = reserva::find($id);
    $aulasAsignadas = AulaAsignada::all();
    return view('Reserva.respuesta', compact('reserva', 'aulasAsignadas'));
  }

  public function reportePeticiones()
  {
    $usuario = Auth::user();
    $ur = UserRol::where("usuario_id",$usuario->id)->get();
    $not= nuevasnotificacion::where("user_rol_id",$ur[0]->id)->get();
    if($not!="[]"){
      $not[0]->cantidad_not=0;
      $not[0]->save();
    }
    $reservas = reserva::orderBy('created_at','DESC')->get();
    $date=new DateTime('now');
    $date=$date->format('Y-m-d H:i:s');
    $filtered = $reservas->filter(function ($value, $key) {
      $date=new DateTime('now');
      $date=$date->format('Y-m-d');
      
      return $date < $value->fecha_examen && $value->estado=="enviado";
    });
    
    $filtered=$filtered->sortBy('fecha_examen');
    return view('Bandejas.bandeja_administrador', ['reservas'=>$reservas,'urgentes'=>$filtered]);
  }



  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}