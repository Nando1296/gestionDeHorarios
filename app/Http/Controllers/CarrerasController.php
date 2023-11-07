<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreCarrera;
use App\Models\Carrera;
use App\Models\Materia_Carrera;
use Illuminate\Http\Request;

class CarrerasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Funcion para llamar a la vista de registro
    public function vistaRegistro()
    {
        return view('Carrera.registrar_carrera');
    }
    public function reporte()
    {
        $carreras = Carrera::all();
        return view('Carrera.reporte_carrera', compact('carreras'));

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
    //Guardado de datos del registro de carrera
    public function registro(StoreCarrera $request)
    {
        //almacenado de carrera
        $carrera = new Carrera();
        $carrera->Nombre = $request->nombre;
        $carrera->Codigo = $request->codigo;

        $carrera->save();
        //Redirección a la vista de registro de carreras con el modal de registro exitoso
        return redirect()->route('carreras')->with('registrar', 'ok');
    }

    public function cancelar()
    {

        return redirect()->route('carreras');

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $carrera = Carrera::find($id);

        return redirect()->route('carreras')->cookie('id', $carrera->id)->cookie('nombre', $carrera->Nombre)->cookie('codigo', $carrera->Codigo)->cookie('editar', 'ok');
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
    public function vistaEditar()
    {
        //recuperar todas las carreras y asignaciones materia carrera, acceder a la vista editar carrera
        $carreras = Carrera::all();
        $mcs = Materia_Carrera::all();
        return view('Carrera.editar_carrera', ['carreras' => $carreras, 'mcs' => $mcs]);

    }
    public function editar(Request $request, $id)
    {
        //Recuperar la carrera a ser editada
        $carrera = Carrera::find($id);
        //Validar los campos nuevos de la carrera
        $request->validate([
            'Nombre' => 'bail|required|min:20|max:60|regex:/^[a-zA-Z\s áéíóúÁÉÍÓÚñÑ]+$/u|unique:carreras,Nombre,' . $carrera->id,
            'Codigo' => 'bail|required|numeric|digits_between:5,8|unique:carreras,Codigo,' . $carrera->id,
        ]);
        //Asignar los nuevos valores a la carrera
        $carrera->Nombre = $request->Nombre;
        $carrera->Codigo = $request->Codigo;
        $carrera->estado = $request->estadoE;
        //Guardar los cambios de la carrera
        $carrera->save();
        //Redireccionar a la vista editar carrera
        return redirect()->route('carrera_edit')->with('actualizar', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function busqueda(Request $request)
    {
        try {
            $carrera = Carrera::query();

            if ($request->has('search')) {
                $carrera->where('Codigo', 'like', $request->search);
            }
            $carreras = $carrera->get();
            return view('Carrera.eliminar_carrera', compact('carreras'));

        } catch (\Throwable $th) {
            return redirect()->route('eliminar-carrera')->with('buscar', 'error');

        }

    }
    public function estado(Request $request, $carrera)
    {
        $carrera = Carrera::find($carrera);
        $carrera->where('id', $request->carrera)->update(['estado' => false]);

        $carrera->materia__carreras()->each(function ($materia_carrera) {
            $materia_carrera->where('id', $materia_carrera->id)->update(['estado' => false]);
            $materia_carrera->grupos()->each(function ($grupo) {
                $grupo->where('id', $grupo->id)->update(['estado' => false]);
                $grupo->asignacionDocentes()->each(function ($asignacionDocentes) {
                    $asignacionDocentes->where('id', $asignacionDocentes->id)->update(['estado' => false]);
                });
            });
        });

        return redirect()->route('eliminar-carrera')->with('eliminar', 'ok');
    }
}