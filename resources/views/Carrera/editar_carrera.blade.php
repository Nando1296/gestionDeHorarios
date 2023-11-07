@extends('plantilla')
{{--Se extiende del archivo plantilla--}}
@section('title', 'Carrera')
@section('Titulo')
@section("editar","carreraEdit")
@section("registrar","carreras")
@section("reporte","reporte_carrera")
@section("eliminar","eliminar-carrera")
<h3 text-center id="Titulo">Administración de carreras</h3>
@endsection
{{-- Contenido del formula de editar carrera--}}
@section('Contenido formulario')

<div class="row">
<div >
  <div class="d-flex" id="formularioEditar">
    <form method="GET" action="" id="formulario">
      
      @csrf
      <h3 text-center>Editar carrera</h3>

      <label for="inputtexto" class="form-label ">Coloque el codigo de la carrera que quiere editar y presione buscar</label>
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
      <label for="Codigo" class="form-label ed">Codigo</label>
      <input type="text" id="inputCodigo" class="form-control ed" name="Codigo" value="{{old('Codigo')}}" autofocus>
      @if ($errors->has('Codigo'))
      <span class="error text-danger" for="inputApellido">{{ $errors->first('Codigo') }}</span>
      @endif
   
      <br>
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
@if ($errors->has('Codigo') || $errors->has('Nombre') )
{{--En caso de que se tenga errores en el llenado de del formulario se entrara a esta seccion para recuperar
  los datos de los campos de texto--}}
<script>
   var ed=document.getElementsByClassName("ed");
      for(var i=0;i<ed.length;i++){
        ed[i].style.display="block"
      }
      var texto=document.getElementById("inputtexto");
      texto.disabled=true
      texto.value=localStorage.getItem('id')
  formulario.action=localStorage.getItem("ruta");
  var codigo=document.getElementById("inputCodigo");
  codigo.disabled=true;
</script>
@endif
{{-- Para mostrar el modal de cambios guardados--}}
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
@section('js')
<script>
  var buscar=document.getElementById("buscar");
  var nombre= document.getElementById("inputNombre");
  var codigo=document.getElementById("inputCodigo");
  var texto=document.getElementById("inputtexto");
  var estado=document.getElementById("estado")
  var estadoE=document.getElementById("estadoE")
  estadoE.value=1
  var asignado=0
  //Funcionalidad de buscar la carrera
  buscar.onclick=function(){
  var encontrado=0;
  var formulario=document.getElementById("formulario");
  //Busca entre todas las carreras existentes
  @foreach ($carreras as $carrera)
    if(texto.value =='{{$carrera->Codigo}}'){
      nombre.value='{{$carrera->Nombre}}'
      codigo.value='{{$carrera->Codigo}}'
      codigo.disabled=true
      buscar.disabled=true;
      //Cuando encientra entonces se le es asignado una ruta para editar esa carrera en especifico
      formulario.action="{{route('carreras-update', ['id'=>$carrera->id])}}"
      localStorage.setItem('ruta',formulario.action)
      localStorage.setItem('id',texto.value)
      var ed=document.getElementsByClassName("ed");
      encontrado=1;
      for(var i=0;i<ed.length;i++){
        ed[i].style.display="block"
      }
      texto.disabled=true;
      //En caso de que el aula se encuentre en baja se muestra un mensaje que lo indica
      if({{$carrera->estado}}==0){
            Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'La carrera se encuentra de baja, dar de alta para poder editarlo',
            })
            //CCuando se llenan todos los campos de texto y se los quiere mostrar dentro el formulario
            var oculto=document.getElementsByClassName("oculto");
           
            for(var i=0;i<oculto.length;i++){
            oculto[i].style.display="block"
            nombre.disabled=true
            codigo.disabled=true
          }
          estadoE.value=0
          }
          //En caso de que la carrera tenga alguna asignacion con materias no se puede habilitar su edicion en sus campos de texto
          @foreach ($mcs as $mc)
            if({{$carrera->id}} == {{$mc->carrera_id}}){
             asignado=1
             nombre.disabled=true
              codigo.disabled=true
              }
           @endforeach
    }
  @endforeach
  //En caso de que la carrera no sea encontrada entonces se muestra el mensaje
  if(encontrado == 0){
    Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: 'No se encontro ninguna carrera con ese codigo',
    })
  }
  //Cuando la carrera esta de baja y se quiere habilitar esta es la funcionalidad
  estado.onclick=function(){
    
    estadoE.value=1
    estado.disabled=true
    if(asignado == 0){
            nombre.disabled=false
            codigo.disabled=true
    }
  }
  //Antes de mandar el formulario se habilitan todos los campos de texto 
  var registrar=document.getElementById("botonRegistrar");
  registrar.onclick=function(){
    nombre.disabled=false
            nombre.disabled=false
            codigo.disabled=false
            estado.disabled=false
  }
  }
</script>
@endsection