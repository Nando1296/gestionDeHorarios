<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGrupo;
use App\Models\asignacionDocentes;
use App\Models\Carrera;
use App\Models\gestion;
use App\Models\Grupo;
use App\Models\Materia;
use App\Models\Materia_Carrera;
use App\Models\UserRol;
use App\Models\Usuario;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }
    public function vistaEditar()
    {
        $grupos = Grupo::all();
        $docentes = Usuario::all();
        $carreras = Carrera::all();
        $materias = Materia::all();
        $Urs = UserRol::all();
        $ads = asignacionDocentes::all();
        $mcs = Materia_Carrera::all();
        return view('Grupo.editar_grupo', ['grupos' => $grupos, 'docentes' => $docentes, 'carreras' => $carreras, 'materias' => $materias, 'urs' => $Urs, "ads" => $ads, "mcs" => $mcs]);

    }

    //Funcion para llamar a la vista de registro y enviar los datos necesarios para mostrar
    public function vistaRegistro()
    {
        //Seleccion de carreras, materias y sus asociaciones habilitadas
        $carreras = Carrera::where('estado', true)->get();
        $materia_carrera = Materia_Carrera::where('estado', true)->get();
        $materias = Materia::where('estado', true)->get();

        //Redireccion a la vista de registro con los respectivos datos que se mostraran
        return view('Grupo.registrar_grupo', ['carreras' => $carreras, 'materia_carrera' => $materia_carrera,  'materias' => $materias]);
    }

    /*public function reporte()
    {
    $grupos   = Grupo::all();
    $docentes = Usuario::all();
    $carreras = Carrera::all();
    $materias = Materia::all();
    $Urs      = UserRol::all();
    $ads      = asignacionDocentes::all();
    $mcs      = Materia_Carrera::all();
    return view('Grupo.reporte_grupo', ['grupos' => $grupos, 'docentes' => $docentes, 'carreras' => $carreras, 'materias' => $materias, 'urs' => $Urs, "ads" => $ads, "mcs" => $mcs]);

    }*/
    public function reporte()
    {
        $grupos = Grupo::all();
        return view('Grupo.reporte_grupo', compact('grupos'));

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

     //Guardado de datos del registro de grupo
    public function registro(StoreGrupo $request)
    {
        //Seleccionar todos los registros de materia y carrera relacionado con la materia elegida
        $lista_materia_carrera=Materia_Carrera::where('materia_id',$request->materia)->where('estado',true)->get();
        //Seleccionar un grupo que tenga la materia
        $id_grupo=Grupo::where('materia_carrera_id',$lista_materia_carrera[0]->id)->get();
       
        $id_docente="";
        //Si hay almenos un grupo en esa materia
        if($id_grupo!="[]"){
            //Ver si tiene asignación de docente
            $id_docente=asignacionDocentes::where('grupo_id',$id_grupo[0]->id)->get();
        }
        //Seleccionar la gestion actual
        $id_gestion=gestion::firstWhere('estado', true);
        //Si no se selecciono ninguna carrera
        if($request->carrera=="Seleccione una carrera"){
    
        //Recorrer la lista de la materia y carrera
        for($i=0;$i<sizeof($lista_materia_carrera);$i=$i+1){
            //Si no existe el grupo
            if(!Grupo::where('materia_carrera_id',$lista_materia_carrera[$i]->id)->where('nombre',"G:".$request->nombre)->exists()){
            //Almacenar los datos del grupo
            $grupo                         = new Grupo();
            $grupo->nombre                 = "G:".$request->nombre;
            $grupo->materia_carrera_id     = $lista_materia_carrera[$i]->id;
            $grupo->save();

            //Si no esta vacio (Significa que ese grupo ya tiene asignacion en el mismo grupo de otra carrera)
            if($id_docente!="[]" && $id_docente!=""){
                //Almaceno datos de la asignacion en el grupo recien creado
                $asignacion= new asignacionDocentes();
                $asignacion->user_rol_id=$id_docente[0]->user_rol_id;
                $asignacion->grupo_id=$grupo->id;
                $asignacion->gestion_id=$id_gestion->id;
                $asignacion->save();
            }
            }else{
                //Si existe el grupo y esta deshabilitado
                $grupo=Grupo::where('materia_carrera_id',$lista_materia_carrera[$i]->id)->where('nombre',"G:".$request->nombre)->where('estado',false)->get();
                //Si encuentra la materia y carrera en la que existe y esta deshabilitado
                if($grupo!="[]"){
                   //Se cambia su estado a habilitado
                    $grupo[0]->estado=true;
                    $grupo[0]->save();
                }
                
            }
        }
        
     }else{
         //Si se selecciono una carrera especifica
         //Seleccionar el id de la materia en la carrera especifica
        $id_materia_carrera=Materia_Carrera::where('materia_id',$request->materia)->where('carrera_id',$request->carrera)->get();
        //Selecciona el grupo si es que existe
        $grupo=Grupo::where('materia_carrera_id',$id_materia_carrera[0]->id)->where('nombre',"G:".$request->nombre)->get();
       
            //Si existe
            if($grupo!="[]"){
                //Cambia el estado
                $grupo[0]->estado=true;
                $grupo[0]->save();
            }else{
            //Si no existe crea un nuevo registro
             $grupo                         = new Grupo();
             $grupo->nombre                 = "G:".$request->nombre;
             $grupo->materia_carrera_id     = $id_materia_carrera[0]->id;
             $grupo->save();
            }
            //Si no esta vacio (Significa que ese grupo ya tiene asignacion en el mismo grupo de otra carrera)
            if($id_docente!="[]" && $id_docente!=""){
                //Almaceno datos de la asignacion en el grupo recien creado
                $asignacion= new asignacionDocentes();
                $asignacion->user_rol_id=$id_docente[0]->user_rol_id;
                $asignacion->grupo_id=$grupo->id;
                $asignacion->gestion_id=$id_gestion->id;
                $asignacion->save();
            }
            
  }

    
    

  

  return redirect()->route('grupos')->with('registrar', 'ok');
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function show(Grupo $grupo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function edit(Grupo $grupo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function editar(Request $request, $id)
    {
        $grupo = Grupo::find($id);
        if ($request->docente != 0) {
            $grupo->asignacion_docentes_id = $request->docente;
        }
        $grupo->estado = $request->estadoE;
        $grupo->save();
        return redirect()->route('grupo_edit')->with('actualizar', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function busqueda(Request $request)
    {
        try {
            $grupo = Grupo::query();

            if ($request->has('search')) {
                $grupo->where('id', 'like', $request->search);
            }
            $grupos = $grupo->get();
            $asignacionDocentes = asignacionDocentes::all();
            return view('Grupo.eliminar_grupo', compact('grupos', 'asignacionDocentes'));

        } catch (\Throwable $th) {
            return redirect()->route('eliminar-grupo')->with('buscar', 'error');

        }

    }
    public function estado($id)
    {
        $grupo = Grupo::find($id);
        $grupo->estado = false;
        $grupo->save();
        $grupo->asignacionDocentes()->each(function ($asignacionDocentes) {
            $asignacionDocentes->where('id', $asignacionDocentes->id)->update(['estado' => false]);
        });

        return redirect()->route('eliminar-grupo')->with('eliminar', 'ok');
    }
}