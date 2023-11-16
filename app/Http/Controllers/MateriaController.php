<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMateria;
use App\Models\Carrera;

//use Illuminate\Support\Facades\Session;
use App\Models\Materia;
use App\Models\Materia_Carrera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Funcion para llamar a la vista de registro
    public function vistaRegistro()
    {
        //Selecciona todas las carreras
        $carreras = Carrera::all();
        //Retorna la vista de registro de materia y envia los datos que se mostraran 
        return view('Materia.registrar_materia', ['carreras' => $carreras]);

    }
    public function reporte()
    {
        $materias = Materia::all();
        return view('Materia.reporte_materia', compact('materias'));

    }
    public function vistaEditar()
    {
        //Recuperar todas las materias, carreras y materias carreras
        $materias = Materia::all();
        $carreras = Carrera::all();
        $mcs = Materia_Carrera::all();

//Redireccionar a la vista de editar materia
        return view('Materia.editar_materia', ['materias' => $materias, 'carreras' => $carreras, 'mcs' => $mcs]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //  return view('materia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     //Guardado de datos del registro de materia
    public function registro(StoreMateria $request)
    {
        //Almacena un nuevo registro de materia
        $materia = new Materia();
        $materia->nombre_materia = $request->nombre;
        $materia->Cod_materia = $request->codigo;
        $materia->save();
        //Redirecciona a la vista de registro de materia con el modal de registro exitoso
        return redirect()->route('materias')->with('registrar', 'ok');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function show(Materia $materia)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function edit(Materia $materia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function editar(Request $request, $id)
    {
        //Recuperar la materia que sera editada
        $materia = Materia::find($id);
        //Validar los campos del formulario
        $request->validate([
            'Nombre' => 'required|regex:/^[\pL\s\-]+$/u|min:5|max:60',
            'Codigo' => 'required|numeric|digits_between:6,10|unique:materias,Cod_materia,' . $materia->id,
        ]);
        //Asignar los nuevos valores a la materia
        $materia->nombre_materia = $request->Nombre;
        $materia->Cod_materia = $request->Codigo;
        $materia->estado = $request->estadoE;
        //Guardar los cambios 
        $materia->save();
        //Redireccionar a la visra editar materia
        return redirect()->route('materia_edit')->with('actualizar', 'ok');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function busqueda(Request $request)
    {

        try {
            $materia = Materia::query();

            if ($request->has('search')) {
                $materia->where('Cod_materia', 'like', $request->search);
            }
            $materias = $materia->get();
            return view('Materia.eliminar_materia', compact('materias'));

        } catch (\Throwable $th) {
            return redirect()->route('eliminar-materia')->with('buscar', 'error');

        }

    }
    public function estado(Request $request, $materia)
    {
        $materia = Materia::find($materia);
        $materia->where('id', $request->materia)->update(['estado' => false]);

        $materia->materia__carreras()->each(function ($materia_carrera) {
            $materia_carrera->where('id', $materia_carrera->id)->update(['estado' => false]);
            $materia_carrera->grupos()->each(function ($grupo) {
                $grupo->where('id', $grupo->id)->update(['estado' => false]);
                $grupo->asignacionDocentes()->each(function ($asignacionDocentes) {
                    $asignacionDocentes->where('id', $asignacionDocentes->id)->update(['estado' => false]);
                });
            });
        });

        return redirect()->route('eliminar-materia')->with('eliminar', 'ok');
    }


    public function reporteD(){
        $user=Auth::user();

        return view('reporteMaterias',['user'=>$user]);
    }
}