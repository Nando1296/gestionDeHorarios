@extends('plantilla')
@section('title', 'Aulas')
@section("editar","aulaEdit")
@section("registrar","aula")
@section("reporte","reporte_aula")
@section("eliminar","eliminar-aula")

@section('Titulo')
<h3 text-center id="Titulo">Administración de aulas</h3>
@endsection
@section('Contenido formulario')
{{--Formulario de edicion de aula--}}
<div class="row">
<div >
  <div class="d-flex" id="formularioEditar">
    <form method="GET" action="" id="formulario">
      
      @csrf
      <h3 text-center>Editar aula</h3>

      <label for="inputtexto" class="form-label ">Coloque el nombre del aula que quiere editar y presione buscar</label>
      <input type="text" id="inputtexto" class="form-control" name="nombre" value="{{old('nombre')}}" autofocus>
      <br>
      <button type="button" class="btn btn-dark btn-block btn-lg" data-toggle="button" aria-pressed="false" autocomplete="off" id="buscar">
       Buscar
      </button>
      <br>
      <span class="error text-danger" for="input-nombre"></span>
      <label for="inputNombre" class="form-label ed">Nombre</label>
      <input type="text" id="inputNombre" class="form-control ed" name="Nombre" value="{{old('Nombre')}}" autofocus>
      @if ($errors->has('Nombre'))
            <span class="error text-danger" for="input-nombre">{{ $errors->first('Nombre') }}</span>
      @endif
      <br>
      <label for="capacidad" class="form-label ed">Capacidad</label>
      <input type="text" id="inputCodigo" class="form-control ed" name="capacidad" value="{{old('capacidad')}}" autofocus>
      @if ($errors->has('capacidad'))
      <span class="error text-danger" for="inputApellido">{{ $errors->first('capacidad') }}</span>
      <br>
      @endif
      <label for="asignar" class="ed">Sección</label>
      <br>
      <select name="section" id="asignar" class="form-select ed"></select>
      <input type="text" name="estadoE" id="estadoE" value="{{old('estadoE')}}">
      <label class=" oculto">Estado:</label>
      <div class="form-check form-switch oculto">
        <input class="form-check-input" type="checkbox" role="switch" id="estado" name="estado" >
        <label class="form-check-label" for="flexSwitchCheckDefault">Baja/Alta</label>
      </div>
      <div class="d-grid gap-2">
        <button class="btn btn-dark btn-block btn-lg ed" id="botonRegistrar" type="submit">Guardar</button>
        <a href="" class="btn btn-danger btn-block btn-lg ed" id="botonRegistrar"
          type="button">Cancelar</a>
      </div>
    </form>
  </div>

</div>
{{--En caso de cometer errores al editar esta seccion recupera los datos del formulario--}}
@if ($errors->has('capacidad') || $errors->has('Nombre') )
<script>
    var buscar=document.getElementById("buscar");
    buscar.disabled=true;
   var ed=document.getElementsByClassName("ed");
      for(var i=0;i<ed.length;i++){
        ed[i].style.display="block"
      }
      var texto=document.getElementById("inputtexto");
      texto.disabled=true
      texto.value=localStorage.getItem('id')
  formulario.action=localStorage.getItem("ruta");
  var asignaciones= document.getElementById("asignar");
      @foreach ($secciones as $seccion )
        if ({{$seccion->id}} == localStorage.getItem("key")){
            asignaciones.innerHTML+="<option selected='selected'value='{{$seccion->id}}'>{{$seccion->nombre}}</option>"
        }else{
            asignaciones.innerHTML+="<option value='{{$seccion->id}}'>{{$seccion->nombre}}</option>"
        }
        
      @endforeach
      var nombre= document.getElementById("inputNombre");
      nombre.disabled=true
</script>
@endif
{{-- mensaje de actualizacion correcta--}}
@if (session('actualizar')=='ok')
  <script>localStorage.setItem('ruta',"")
  
    
    Swal.fire({
    position: 'center',
    icon: 'success',
    title: 'Cambios guardados exitosamente',
    showConfirmButton: false,
    timer: 1500
    })
  </script>
@endif
@endsection
@section('js')
<script>
  var buscar=document.getElementById("buscar");
  var nombre= document.getElementById("inputNombre");
  var codigo=document.getElementById("inputCodigo");
  var texto=document.getElementById("inputtexto");
  var encontrado=0;
  var estado=document.getElementById("estado")
  var estadoE=document.getElementById("estadoE")
  estadoE.value=1

  //funcionalidad de buscar aula
  buscar.onclick=function(){

  var formulario=document.getElementById("formulario");
  @foreach ($aulas as $aula)
    if(texto.value =='{{$aula->nombre}}'){
      //Aula encontrada, deshabilita el boton buscar
        buscar.disabled=true;
      //Se llena el nombre y no es editable
      nombre.value='{{$aula->nombre}}'
      nombre.disabled=true
      //Se llena la capacidad y es editable
      codigo.value='{{$aula->capacidad}}'
      //Se coloca la ruta del formulario
      formulario.action="{{route('aula-update', ['id'=>$aula->id])}}"
      localStorage.setItem('ruta',formulario.action)
      localStorage.setItem('id',texto.value)
      //Se muestra la informacion del aula
      var ed=document.getElementsByClassName("ed");
      for(var i=0;i<ed.length;i++){
        ed[i].style.display="block"
      }
      // se deshablita el campo buscador
      texto.disabled=true;
      encontrado=1;
      var asignaciones= document.getElementById("asignar");
      //Listado de todas las secciones y se marca la seccion del aula
      @foreach ($secciones as $seccion )
        if ({{$seccion->id}} == {{$aula->section_id}}){
            asignaciones.innerHTML+="<option selected='selected'value={{$seccion->id}}>{{$seccion->nombre}}</option>"
            localStorage.setItem("key",'{{$seccion->nombre}}');
        }else{
            if({{$seccion->estado}}==1){
              asignaciones.innerHTML+="<option value={{$seccion->id}}>{{$seccion->nombre}}</option>"
            }
        }
      @endforeach
      //Si el aula esta en baja
      if({{$aula->estado}}==0){
            Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'El aula se encuentra de baja, dar de alta para poder editarlo',
            })
            var oculto=document.getElementsByClassName("oculto");
           
            for(var i=0;i<oculto.length;i++){
            oculto[i].style.display="block"
            nombre.disabled=true
            codigo.disabled=true
            asignaciones.disabled=true
          }
          estadoE.value=0
          }
    }
  @endforeach
  //Si el aula no fue encontrada
  if(encontrado==0){
      Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: 'No se encontro ningun aula con ese nombre',
    })

    }
  }
  //Cuando se da de alta un aula
        var asignaciones= document.getElementById("asignar");
        estado.onclick=function(){
    console.log(estado.value)
            estadoE.value=1
            nombre.disabled=true
            codigo.disabled=false
            asignaciones.disabled=false
            estado.disabled=true
  }
  var registrar=document.getElementById("botonRegistrar");
  //Se habilita todos los campos antes de enviar el formulario
  registrar.onclick=function(){

    nombre.disabled=false
            nombre.disabled=false
            codigo.disabled=false
            asignaciones.disabled=false
            estado.disabled=false
  }
</script>
@endsection
