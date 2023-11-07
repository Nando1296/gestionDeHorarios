@extends('plantilla2')
@section('title', 'Materia')




<header>
  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><span id="Nlogo">Aulapp</span><img id="logo"
          src="{{asset('Imagenes/logo.jpeg')}}" width="50" id="logo"></a>
      <h3 id="Titulo">Administración de materias </h3>
      <a href="#" class="material-symbols-outlined" id="menu">menu</a>

      <form class="d-flex m-0">
        <a class="nav-link active" aria-current="page" href="{{url('/menu')}}">Inicio</a>
        <a class="nav-link active" aria-current="page" href="{{url('/materias')}}">Registrar</a>
        <a class="nav-link active" aria-current="page" href="{{url('/materiaEdit')}}">Editar</a>
        <a class="nav-link active" aria-current="page" href="{{url('/eliminar-materia')}}">Eliminar</a>
        <a class="nav-link active" aria-current="page" href="{{url('/reporte_materia')}}">Ver reporte</a>

      </form>
    </div>
  </nav>
</header>
@section('Contenido formulario')

<div class="d-flex align-items-center justify-content-center row p-2" id="formulario">
  <div class="col-12">

    <form id="formulario" method="GET" action="{{route('eliminar-materia')}}">
      <h3 text-center>Eliminar materia</h3>
      @csrf

      <label for="inputNombre" class="form-label">Introduzca el codigo</label>
      <input type="text" id="inputNombre" class="form-control search" name="search" autofocus>


      <br>
      <div class="d-flex justify-content-center">
        <button class="btn btn-dark btn-block btn-lg" id="buscar">
          Buscar
        </button>
      </div>


      <br>
      @if (count($materias) <= 0) @elseif (count($materias)> 1)

        @elseif (count($materias) == 1)
        @foreach ($materias as $materia )
        @if ($materia->estado == true)
        <div class="p-1" id="datosEliminar">
          <h6> <b>Datos de la carrera</b> </h6>

          <span> <b>Codigo:</b> {{$materia->Cod_materia}}</span>
          <br>
          <span><b>Nombre:</b> {{$materia->nombre_materia}}</span>

        </div>


    </form>
  </div>
  <div class="d-flex justify-content-center">

    <form action="{{route('materias-destroy', ['materia'=>$materia->id])}}" method="POST" class="Eliminar">
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
            title: '¿Estás seguro que quieres eliminar la materia?',
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
  title: 'Materia eliminada',
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
  text: 'No se encontro ninguna  materia con ese codigo',
  showConfirmButton: true,
  })

</script>
@endif
@php
use App\Models\Materia;
$materias=Materia::all();
@endphp
<script>
  var buscar=document.getElementById("buscar");
var nombre=document.getElementById("inputNombre");
buscar.onclick=function(evento){
  var encontrado=0

  @foreach ($materias as $materia)
    if(nombre.value== '{{$materia->Cod_materia}}' && {{$materia->estado}}==1){
      encontrado=1;
    }
  @endforeach
  if(encontrado==0){
    event.preventDefault();
    Swal.fire({
position: 'center',
icon: 'error',
title: 'Oops...',
text: 'No se encontro ninguna materia con ese codigo',
showConfirmButton: true,

})
  }
  

}
</script>
@endsection