@extends('plantilla')
@section('title', 'Docente')
@section('Titulo')
@section("editar","docenteEdit")
@section("registrar","docente")
@section("reporte","reporte_user_rol")
@section("eliminar","eliminar-docente")
@section('Titulo')

<h3 text-center id="Titulo">Administración de docentes</h3>
@endsection
@section('Contenido formulario')
{{--Formulario de editar docente--}}
<div class="row">
<div >
  <div class="d-flex" id="formularioEditar">
    <form method="GET" action="" id="formulario">
      
      @csrf
      <h3 text-center>Editar docente</h3>

      <label for="inputtexto" class="form-label ">Coloque el CI del docente que quiere editar y presione buscar</label>
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
      <label for="Codigo" class="form-label ed">Apellido</label>
      <input type="text" id="inputApellido" class="form-control ed" name="Apellido" value="{{old('Apellido')}}" autofocus>
      @if ($errors->has('Apellido'))
      <span class="error text-danger" for="inputApellido">{{ $errors->first('Apellido') }}</span>
      @endif
      <br>
      <label for="CI" class="form-label ed">CI</label>
      <input type="text" id="inputCI" class="form-control ed" name="CI" value="{{old('CI')}}" autofocus>
      @if ($errors->has('CI'))
      <span class="error text-danger" for="inputCI">{{ $errors->first('CI') }}</span>
      @endif
      <br>
      <label for="Correo" class="form-label ed">Email</label>
      <input type="text" id="inputCorreo" class="form-control ed" name="Correo" value="{{old('Correo')}}" autofocus>
      @if ($errors->has('Correo'))
      <span class="error text-danger" for="inputCorreo">{{ $errors->first('Correo') }}</span>
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
{{--En caso de tener algun error al moento de editar los campos, esta seccion de codigo sirve para recuperar los valores--}}
@if ($errors->has('Correo') || $errors->has('Nombre') ||$errors->has('CI')  ||$errors->has('Apellido') )
<script>
   var ed=document.getElementsByClassName("ed");
      for(var i=0;i<ed.length;i++){
        ed[i].style.display="block"
      }
      var texto=document.getElementById("inputtexto");
      texto.disabled=true
      texto.value=localStorage.getItem('id')
  formulario.action=localStorage.getItem("ruta");
  var ci=document.getElementById("inputCI");
  var correo=document.getElementById("inputCorreo");
  correo.disabled=false
  ci.disabled=true
</script>
@endif
@if (session('actualizar')=='ok')
  <script>localStorage.setItem('ruta',"")</script>
@endif
@endsection
@section('js')
<script>
  var buscar=document.getElementById("buscar");  
  var nombre= document.getElementById("inputNombre");
  var apellido=document.getElementById("inputApellido");
  var ci=document.getElementById("inputCI");
  var correo=document.getElementById("inputCorreo");
  var estado=document.getElementById("estado")
  var estadoE=document.getElementById("estadoE")
  estadoE.value=1
  //Funcion de buscar el docente para editar fu informacion
  buscar.onclick=function(){
  var texto=document.getElementById("inputtexto");
  var encontrado=0;
  var formulario=document.getElementById("formulario");
  @foreach ($docentes as $docente)
    @foreach ($urs as $ur )
      if(texto.value=='{{$docente->CI}}' && '{{$ur->rol_id}}'=='2' && '{{$docente->id}}'== '{{$ur->usuario_id}}'){
        //En caso de ser encontrado llenar los campos de texto con su informacion
          nombre.value='{{$docente->Nombre}}'
          apellido.value= '{{$docente->Apellido}}'
          ci.value='{{$docente->CI}}'
          correo.value= '{{$docente->Email}}'
          correo.disabled=false
          //El ci no es editable
          ci.disabled=true
          //Se asigna la ruta correspondiente al docente
          formulario.action="{{route('docente-update', ['id'=>$docente->id])}}"
          localStorage.setItem('ruta',formulario.action)
          localStorage.setItem('id',texto.value)
          var ed=document.getElementsByClassName("ed");
          encontrado=1;
          buscar.disabled=true;
          //Se hacen visibles todos los campos de texto
          for(var i=0;i<ed.length;i++){
          ed[i].style.display="block"
          }
          texto.disabled=true;
          //En caso de que el docente se encuentre de baja se muestra el mensaje
          if({{$docente->estado}}==0){
            Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'El docente se encuentra de baja, dar de alta para poder editarlo',
            })
            var oculto=document.getElementsByClassName("oculto");
           //Se muestra el boton de estado para dar de alta al docente
            for(var i=0;i<oculto.length;i++){
            oculto[i].style.display="block"
            nombre.disabled=true
            apellido.disabled=true
            ci.disabled=true
            correo.disabled=true
          }
          estadoE.value=0
          }
          
      }
    @endforeach

  @endforeach
  //Si el docente no fue encontrado se muestra el mensaje
  if(encontrado == 0){
    Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: 'No se encontro ningun docente con ese CI',
    })
  }
  }
  //Cuando es dado de alta al docente se habilitan todos sus campos a excepcion de el ci
  estado.onclick=function(){
    console.log(estado.value)
    if(estadoE.value==0){
      estadoE.value=1
            nombre.disabled=false
            apellido.disabled=false
            ci.disabled=true
            correo.disabled=true
            estado.disabled=true
    }
  }
  //Cuando se envia el formulario se habilitan todos los campos
  var registrar=document.getElementById("botonRegistrar");
  registrar.onclick=function(){
    nombre.disabled=false
            nombre.disabled=false
            apellido.disabled=false
            ci.disabled=false
            correo.disabled=false
            estado.disabled=false
  }
</script>
{{--Si la actualizacion es cprrecta se muestra el mensajes--}}
@if (session('actualizar')=='ok')

<script>
    
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