@extends('plantilla2')
@section('title', 'Asignacion docente')


<header>
  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><span id="Nlogo">Aulapp</span><img id="logo"
          src="{{asset('Imagenes/logo.jpeg')}}" width="50" id="logo"></a>
      <h3 text-center>Administración de docente-grupo </h3>
      <a href="#" class="material-symbols-outlined" id="menu">menu</a>
      <form class="d-flex m-0">
        <a class="nav-link active" aria-current="page" href="{{url('menu')}}">Inicio</a>
        <a class="nav-link active" aria-current="page" href="{{url('materia_docente')}}">Registrar</a>
        {{-- <a class="nav-link active" aria-current="page" href="#">Editar</a> --}}
        <a class="nav-link active" aria-current="page" href="{{url('eliminar-asignacion-docente')}}">Eliminar</a>
        <a class="nav-link active" aria-current="page" href="{{url('/reporte_asignacion_docente')}}">Ver reporte</a>

      </form>
    </div>
  </nav>
</header>
@section('Contenido formulario')

<div class="d-flex align-items-center justify-content-center row p-2" id="formulario">
  <div class="col-12">

    <form id="formulario" method="GET" action="{{route('eliminar-asignacion-docente')}}">
      <h3 text-center>Eliminar docente-grupo</h3>
      @csrf

      <label for="inputNombre" class="form-label">Introduzca el ID</label>
      <input type="text" id="inputNombre" class="form-control search" name="search" autofocus>

      <br>
      <div class="d-flex justify-content-center">
        <button class="btn btn-dark btn-block btn-lg" id="buscar">
          Buscar
        </button>
      </div>


      <br>
      @if (count($asignacionDocentes) <= 0) @elseif (count($asignacionDocentes)> 1)

        @elseif (count($asignacionDocentes) == 1)
        @foreach ($asignacionDocentes as $asignacionDocente )
        @if ($asignacionDocente->estado == true)



        @if ($asignacionDocente->user_rol_id != "")
        <div class="p-1" id="datosEliminar">
          <h6> <b>Datos de la asignacion materia-docente</b></h6>

          <span><b>id:</b> {{$asignacionDocente->id}}</span>
          <br>
          <span><b>Docente:</b> {{$asignacionDocente->user_rol->usuario->Nombre}}
            {{$asignacionDocente->user_rol->usuario->Apellido}}</span>

          <br>

          <span><b>Materia:</b> {{$asignacionDocente->grupos->materia_carrera->materia->nombre_materia}}</span>
        </div>
        @endif






    </form>
  </div>
  <div class="d-flex justify-content-center">

    <form action="{{route('asignacionDocente-destroy', ['asignacionDocente'=>$asignacionDocente->id])}}" method="POST"
      class="Eliminar">
      @method('DELETE')
      @csrf
      <button class="btn btn-dark btn-block btn-lg" type="submit">Eliminar</button>
    </form>


    @endif
    @endforeach
    @endif

  </div>






</div>

@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $('.Eliminar').submit(function(e){
            e.preventDefault();
            Swal.fire({
            title: '¿Estás seguro que quieres eliminar la  asignada al docente?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí',
            cancelButtonText: 'No'
            }).then((result) => {
                  if (result.isConfirmed) {
                  this.submit();
            }
            })
      });
</script>


@if (session('eliminar')=='ok')
<script>
  Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'Asignada al docente eliminada',
  showConfirmButton: false,
  timer: 1500
  })
</script>
@endif
@if (session('buscar')=='error')
<script>
  Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'No se encontro ninguna asignacion  con ese id',
  showConfirmButton: true,
  })

</script>
@endif
@php
use App\Models\asignacionDocentes;
$asignaciones=asignacionDocentes::all();
@endphp
<script>
  var buscar=document.getElementById("buscar");
var nombre=document.getElementById("inputNombre");
buscar.onclick=function(evento){
  var encontrado=0

  @foreach ($asignaciones as $asignacion)
    if(nombre.value== '{{$asignacion->id}}' && {{$asignacion->estado}}==1){
      encontrado=1;
    }
  @endforeach
  if(encontrado==0){
    event.preventDefault();
    Swal.fire({
position: 'center',
icon: 'error',
title: 'Oops...',
text: 'No se encontro ninguna asignacion con ese id',
showConfirmButton: true,

})
  }
  

}
</script>
@endsection