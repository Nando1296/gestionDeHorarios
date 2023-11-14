@extends('plantilla')
@section("editar","grupoEdit")
@section("registrar","grupos")
@section("reporte","reporte_grupo")
@section("eliminar","eliminar-grupo")
@section('title', 'Grupo')
@section('Titulo')
<h3 text-center >Administración de grupos</h3>
@endsection
@section('Contenido formulario')

<div class="row">
<div >
  <div class="d-flex" id="formularioEditar">
    <form method="GET" action="" id="formulario">
      
      @csrf
      <h3 text-center class="titulo-form">Editar grupo</h3>
      <label  class="form-label " id="titulo">Ingrese el id del grupo que desea editar</label>
      <input type="text" id="buscador" class="form-control">
      <br>
      <button type="button" class="btn btn-dark btn-block btn-lg" data-toggle="button" aria-pressed="false" autocomplete="off" id="buscar">
       Buscar
      </button><br>
      <span id="carrera"></span><br>
      <span id="materia"></span><br>
      <span id="grupo"></span><br>
      <div id="docente"><select name="docente" id="asignado" class="form-select ed"></select></div>
      <input type="text" name="estadoE" id="estadoE" value="{{old('estadoE')}}">
      <label class=" oculto">Estado:</label>
      <div class="form-check form-switch oculto">
        <input class="form-check-input" type="checkbox" role="switch" id="estado" name="estado" >
        <label class="form-check-label" for="flexSwitchCheckDefault">Baja/Alta</label>
      </div>
        <button class="btn btn-dark btn-block btn-lg ed" id="botonRegistrar" type="submit">Guardar</button>
        <a href="" class="btn btn-danger btn-block btn-lg ed" id="botonRegistrar"
          type="button">Cancelar</a>
      </div>
    </form>
  </div>

</div>
@endsection
@section('js')
    <script>
        var buscar=document.getElementById("buscar");
        var buscador=document.getElementById("buscador");
        var estado=document.getElementById("estado")
         var estadoE=document.getElementById("estadoE")
        estadoE.value=1
        buscar.onclick=function(){
            var asignado=document.getElementById("asignado")
            var encontrado=0;
            var carrera=document.getElementById("carrera")
            var materia=document.getElementById("materia")
            var grupo=document.getElementById("grupo")
            @foreach ($grupos as $grupo )
                if('{{$grupo->id}}'==buscador.value ){
                     encontrado=1;
                     console.log("Encontrado")
                     grupo.innerHTML="Grupo: {{$grupo->nombre}}"
                     materia.innerHTML="Materia: {{$grupo->asignacionDocente->materia_carrera->materia->nombre_materia}}"
                     carrera.innerHTML="Carrera: {{$grupo->asignacionDocente->materia_carrera->carrera->Nombre}}"
                     formulario.action="{{route('grupo-update', ['id'=>$grupo->id])}}"
                     ed=document.getElementsByClassName("ed")
                     for(var i=0;i<ed.length;i++){
                        ed[i].style.display="block";
                         }
                         
                         var docente=document.getElementById("docente")
                    if('{{$grupo->asignacionDocente->user_rol_id}}'!=""){
                        @foreach ($urs as $ur )
                            @foreach ($docentes as $docente )
                                if("{{$grupo->asignacionDocente->user_rol_id}}"== "{{$ur->id}}" && "{{$docente->id}}"=="{{$ur->usuario_id}}"){
                                    docente.innerHTML="Docente: {{$docente->Nombre}} {{$docente->Apellido}}"
                                }
                            @endforeach
                        @endforeach
                    }else{
                        var asignado=document.getElementById("asignado")
                        asignado.innerHTML+="<option value='0'>Por designar</option>"
                        @foreach ($docentes as $docente)
                            @foreach ($urs as $ur)
                                @foreach ($ads as $ad)
                                    if('{{$grupo->asignacionDocente->materia_carreras_id}}'=='{{$ad->materia_carreras_id}}' && "{{$ad->user_rol_id}}"=='{{$ur->id}}' && '{{$ur->usuario_id}}'=='{{$docente->id}}' && {{$ad->estado}}==1){
                                        asignado.innerHTML+="<option value='{{$ad->id}}'>{{$docente->Nombre}} {{$docente->Apellido}}</option>"
                                    }
                                @endforeach
                            @endforeach
                        @endforeach
                    }

                } 
                if({{$grupo->estado}}==0){
            Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'El grupo se encuentra de baja, dar de alta para poder editarlo',
            })
            var oculto=document.getElementsByClassName("oculto");
           
            for(var i=0;i<oculto.length;i++){
            oculto[i].style.display="block"
          }
          var asignado=document.getElementById("asignado")
          asignado.disabled=true
          estadoE.value=0
          }
            @endforeach
            if(encontrado==0){
                Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'No se encontro ningun grupo con ese id',
    })
            }
            var asignado=document.getElementById("asignado")
        estado.onclick=function(){
        console.log(estado.value)
            estadoE.value=1
            asignado.disabled=false
            estado.disabled=true
  }
  var registrar=document.getElementById("botonRegistrar");
  registrar.onclick=function(){
            asignado.disabled=false
            estado.disabled=false
  }
        }
    </script>
    @if (session('actualizar')=='ok')
    <script>localStorage.setItem('ruta',"")
    Swal.fire({
      position: 'center',
      icon: 'success',
      title: 'Cambios guardados exitosamente',
      showConfirmButton: false,
      timer: 1500
      })</script>
      @endif
@endsection