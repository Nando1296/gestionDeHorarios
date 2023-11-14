@extends('plantilla_planillas')
@section('Titulo')
<h3 text-center >Administración de materia-carrera</h3>
@endsection
@section("registrar","materia_carrera")
@section("reporte","reporte_carrera_materia")
@section("eliminar","eliminar-materia-carrera")
@section("action")
action={{route('materia_carrera')}}
@endsection
@section('Titulo form')
<h3 class="titulo-form">Registro de asignacion de materia a carrera</h3>
@endsection
@section('Contenido formulario')
    
    <label class="form-label">Carrera</label>
    <select name="carrera" id="carrera" class="form-select">
        <option>Seleccione una carrera</option>
        @foreach($carreras as $carrera)          
        <option value="{{$carrera->id}}">{{$carrera->Nombre}}</option>
        @endforeach
    </select>
    @if ($errors->has("carrera"))
        <span class="error text-danger" for="input1">{{ $errors->first("carrera") }}</span>
        @endif
        <br>
    <label class="form-label">Materia</label>
    <select name="materia" id="materia" class="form-select">
        <option selected>Seleccione una materia</option>
       
    </select>
    @if ($errors->has("materia"))
        <span class="error text-danger" for="input1">{{ $errors->first("materia") }}</span>
        @endif
    <script>
        

        var carrera=document.getElementById("carrera");
        carrera.addEventListener('change', (event) => {
            var materias=document.getElementById("materia");
            materia.innerHTML="";
            materia.innerHTML+="<option>Seleccione una materia</option>"
                    
           @foreach($materias as $materia)
           var bandera=0;
              @foreach($carrera_materias as $carrera_materia)
                
                if('{{$materia->id}}'=='{{$carrera_materia->materia_id}}' && '{{$carrera_materia->carrera_id}}'==carrera.options[carrera.selectedIndex].value){
                    bandera=1;
                    
                }
              @endforeach
              if(bandera==0){
                materias.innerHTML+="<option value='{{$materia->id}}'>{{$materia->Cod_materia}} - {{$materia->nombre_materia}}</option>"
                
              }
           @endforeach
        })
    </script>

@endsection
