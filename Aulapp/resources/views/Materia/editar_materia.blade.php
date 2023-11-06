@extends('plantilla')
@section('title', 'Materia')
@section("editar","materiaEdit")
@section("registrar","materias")
@section("reporte","reporte_materia")
@section("eliminar","eliminar-materia")
@section('Titulo')
<h3 text-center id="Titulo">Administración de materias</h3>
@endsection
@section('Contenido formulario')

<div class="row">
<div >
  <div class="d-flex" id="formularioEditar">
    {{--Formulario para la edicion de la materia--}}
    <form method="GET" action="" id="formulario">
      
      @csrf
      <h3 text-center>Editar materia</h3>

      <label for="inputtexto" class="form-label ">Coloque el código de la materia que quiere editar y presione buscar</label>
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
      <br>
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
        <a href="" class="btn btn-danger btn-block btn-lg ed " 
          type="button">Cancelar</a>
      </div>
    </form>
  </div>

</div>
{{--En caso de tener errores al momento  de editar la materia esta seccion recupera los campos de texto llenados--}}
@if ($errors->has('Codigo') || $errors->has('Nombre') )
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
  var codigo=document.getElementById("inputCodigo");
  codigo.disabled=true;
</script>
@endif
{{--Mensaje de cambios guardados--}}
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
  var estado=document.getElementById("estado")
  var estadoE=document.getElementById("estadoE")
  var nombre= document.getElementById("inputNombre");
  var codigo=document.getElementById("inputCodigo");
  estadoE.value=1
  //Funcionalidad de buscar la materia
  buscar.onclick=function(){
  var texto=document.getElementById("inputtexto");
  var encontrado=0;
  var formulario=document.getElementById("formulario");
  var asignado=0
  @foreach ($materias as $materia)
    if(texto.value =='{{$materia->Cod_materia}}'){

        buscar.disabled=true;
      nombre.value='{{$materia->nombre_materia}}'
      codigo.value='{{$materia->Cod_materia}}'
      codigo.disabled=true
      //Se introduce la ruta para editar la materia en especifico
      formulario.action="{{route('materias-update', ['id'=>$materia->id])}}"
      localStorage.setItem('ruta',formulario.action)
      localStorage.setItem('id',texto.value)
      var ed=document.getElementsByClassName("ed");
      //Mostrar los campos de texto en el formulario
      for(var i=0;i<ed.length;i++){
        ed[i].style.display="block"
      }
      texto.disabled=true;
      encontrado=1;
      //En caso de que este dado de baja entonces se mostrara el mensaje
      if({{$materia->estado}}==0){
            Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'La materia se encuentra de baja, dar de alta para poder editarlo',
            })
            var oculto=document.getElementsByClassName("oculto");
           // se muestra el boton de estado
            for(var i=0;i<oculto.length;i++){
            oculto[i].style.display="block"
            nombre.disabled=true
            codigo.disabled=true
          }
          estadoE.value=0
          }
          // En caso de que este relacionado con carreras no es posible editar los campos de texto
      @foreach ($mcs as $mc)
        if({{$materia->id}}== {{$mc->materia_id}}){
          asignado=1
          nombre.disabled=true
          codigo.disabled=true
        }
      @endforeach
    }
  @endforeach
          //En caso de que no fue encontrada la materia se muestra el mensaje
  if(encontrado==0){
      Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: 'No se encontro ninguna materia con ese codigo',
    })

    }
    //Cuando se da de alta la materia se habilita el campo nombre de la materia
    estado.onclick=function(){
    console.log(estado.value)
    estadoE.value=1
    estado.disabled=true
    if(asignado == 0){
            nombre.disabled=false
            codigo.disabled=true
    }
  }
  }
  //Se habilitan todos los campos de texto antes de mandar
  var registrar=document.getElementById("botonRegistrar");
  registrar.onclick=function(){
    nombre.disabled=false
            nombre.disabled=false
            codigo.disabled=false
            estado.disabled=false
  }
</script>
@endsection
