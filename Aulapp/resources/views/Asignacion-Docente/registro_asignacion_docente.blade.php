@extends('plantilla_planillas')

@section('Titulo')
<h3>Administración de docente-grupo</h3>

@endsection
@section("registrar","materia_docente")
@section("reporte","reporte_asignacion_docente")
@section("eliminar","eliminar-asignacion-docente")

@section("action")
action={{route('materia_docente')}}
@endsection
@section('Titulo form')
<h3>Registro de asignación de docente a grupo</h3>
@endsection
@section('Contenido formulario')
<label class="form-label">Materia</label>
<select name="materia" id="materia" class="form-select">
    <option selected>Seleccione una materia</option>
    @foreach ($materias as $materia)
        <option value="{{$materia->id}}">{{$materia->Cod_materia}} - {{$materia->nombre_materia}}</option>
    @endforeach
</select>
@if ($errors->has("materia"))
    <span class="error text-danger" for="input1">{{ $errors->first("materia") }}</span>
    @endif
<br>
<label class="form-label">Grupo</label>
<select name="grupo" id="grupo" class="form-select">
<option selected>Seleccione un grupo</option>
    
</select>
@if ($errors->has("grupo"))
    <span class="error text-danger" for="input1">{{ $errors->first("grupo") }}</span>
    @endif

<script>
    var materia=document.getElementById("materia");
    materia.addEventListener('change', (event) => {
     var grupo=document.getElementById("grupo");
     grupo.innerHTML="";
     grupo.innerHTML+="<option>Seleccione un grupo</option>";
     if(materia.options[materia.selectedIndex].text!="Seleccione una materia"){
       @foreach ($grupos as $grupo)
        if("{{$grupo->materia_id}}"==materia.options[materia.selectedIndex].value){
         grupo.innerHTML+="<option>{{$grupo->nombre}}</option>";
        }
       @endforeach
     }
    })
</script>
<br>
<label class="form-label">Docente</label>
    <select name="docente" id="docente" class="form-select">
        <option>Seleccione un docente</option>
        @foreach($docentes as $docente) 
        @if ($docente->rol->id != 1)
        <option value="{{$docente->id}}">{{$docente->usuario->Nombre}} {{$docente->usuario->Apellido}}</option>
        @endif         
        @endforeach
    </select>
    @if ($errors->has("docente"))
        <span class="error text-danger" for="input1">{{ $errors->first("docente") }}</span>
        @endif
        <br>
@endsection
        