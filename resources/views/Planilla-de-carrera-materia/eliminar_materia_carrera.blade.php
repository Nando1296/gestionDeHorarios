@extends('plantilla2')
@section('title', 'Materia-carrera')

<header>
  <nav class="navbar navbar-light ">
     <div class="nav">
      
        <img src="{{asset('imagenes/INF-SIS.png')}}" alt="" >
        <div class="titulo">Departamento de Informática y Sistemas </div>
      
        <h3 text-center id="Titulo">Administración de carrera-materia </h3>
       
       <a href="#" class="material-symbols-outlined" id="menu">menu</a>
       <form class="d-flex m-0">
        <a class="nav-link active" aria-current="page" href="{{url('/menu')}}">Inicio</a>
        <a class="nav-link active" aria-current="page" href="{{url('/materia_carrera')}}">Registrar</a>
        {{-- <a class="nav-link active" aria-current="page" href="{{url('/materiaEdit')}}">Editar</a> --}}
        <a class="nav-link active" aria-current="page" href="{{url('/eliminar-materia-carrera')}}">Eliminar</a>
        <a class="nav-link active" aria-current="page" href="{{url('/reporte_carrera_materia')}}">Ver reporte</a>

      </form>
     </div>
   </nav>
 </header> 


@section('Contenido formulario')

<div class="d-flex align-items-center justify-content-center row p-2" id="formulario">
  <div class="col-12">

    <form id="formulario" method="GET" action="{{route('eliminar-materia-carrera')}}">
      <h3 text-center class="titulo-form">Eliminar carrera-materia</h3>
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
      @if (count($materiasCarrera) <= 0) @elseif (count($materiasCarrera)> 1)

        @elseif (count($materiasCarrera) == 1)
        @foreach ($materiasCarrera as $materiaCarrera )
        @if ($materiaCarrera->estado == true && ($materiaCarrera->materia->estado == true &&
        $materiaCarrera->carrera->estado == true))
        <div class="p-1" id="datosEliminar">
          <h6> <b>Datos de la carrera-materia</b></h6>

          <span> <b>Carrera:</b> {{$materiaCarrera->carrera->Nombre}}</span>
          <br>
          <span> <b>Materia:</b> {{$materiaCarrera->materia->nombre_materia}}</span>

        </div>


    </form>
  </div>
  <div class="d-flex justify-content-center">

    <form action="{{route('materiasCarreras-destroy', ['materiaCarrera'=>$materiaCarrera->id])}}" method="POST"
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
            title: '¿Estás seguro que quieres eliminar la materia asignada a la carrera?',
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
  title: 'Materia asiganada a la carrera eliminada',
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
  text: 'No se encontro ninguna asignacion materia-carrera con ese id',
  showConfirmButton: true,
  })

</script>
@endif
@php
use App\Models\Materia_Carrera;
$mcs=Materia_Carrera::all();
@endphp
<script>
  var buscar=document.getElementById("buscar");
var nombre=document.getElementById("inputNombre");
buscar.onclick=function(evento){
  var encontrado=0

  @foreach ($mcs as $mc)
    if(nombre.value== '{{$mc->id}}' && {{$mc->estado}}==1){
      encontrado=1;
    }
  @endforeach
  if(encontrado==0){
    event.preventDefault();
    Swal.fire({
position: 'center',
icon: 'error',
title: 'Oops...',
text: 'No se encontro ninguna asignacion materia-carrera con ese id',
showConfirmButton: true,

})
  }
  

}
</script>
@endsection