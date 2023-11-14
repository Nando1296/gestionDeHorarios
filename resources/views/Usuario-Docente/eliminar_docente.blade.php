@extends('plantilla2')
@section('title', 'Docente')
@section("editar","docenteEdit")
@section("registrar","docente")
@section("reporte","reporte_docente")
@section("eliminar","eliminar-docente")





<header>
  <nav class="navbar navbar-light ">
     <div class="nav">
      
        <img src="{{asset('imagenes/INF-SIS.png')}}" alt="" >
        <div class="titulo">Departamento de Informática y Sistemas </div>
      
      
       
       <h3  id="Titulo">Administración de docentes </h3>
       <a href="#" class="material-symbols-outlined" id="menu">menu</a>
       <form class="d-flex nav">
        <a class="nav-link active" aria-current="page" href="{{url('menu')}}">Inicio</a>
        <a class="nav-link active" aria-current="page" href="{{url('/docente')}}">Registrar</a>
        <a class="nav-link active" aria-current="page" href="{{url('/docenteEdit')}}">Editar</a>
        <a class="nav-link active" aria-current="page" href="{{url('/eliminar-docente')}}">Eliminar</a>
        <a class="nav-link active" aria-current="page" href="{{url('/reporte_user_rol')}}">Ver reporte</a>

      </form>
     </div>
   </nav>
 </header> 


@section('Contenido formulario')

<div class="d-flex align-items-center justify-content-center row p-2" id="formulario">
  <div class="col-12">

    <form id="formulario" method="GET" action="{{route('eliminar-docente')}}">
      <h3 text-center class="titulo-form">Eliminar docente</h3>
      @csrf

      <label for="inputNombre" class="form-label">Coloque el CI del docente</label>
      <input type="text" id="inputNombre" class="form-control search" name="search" autofocus>

      <br>
      <div class="d-flex justify-content-center">
        <button class="btn btn-dark btn-block btn-lg" id="buscar">
          Buscar
        </button>
      </div>


      <br>
      @foreach ($rols as $userRol)


      @if (count($usuarios) <= 0) @elseif (count($usuarios)> 1)


        @elseif (count($usuarios) == 1)
        @foreach ($usuarios as $usuario )
        @if ($usuario->estado == true && $userRol->usuario_id == $usuario->id && $userRol->rol->id == 2)


        <div class="p-1" id="datosEliminar">
          <h6> <b>Datos del docente</b></h6>

          <span><b>CI:</b>{{$usuario->CI}}</span>
          <br>
          <span><b>Docente:</b> {{$usuario->Nombre}}
            {{$usuario->Apellido}}</span>



        </div>


    </form>
  </div>
  <div class="d-flex justify-content-center">

    <form action="{{route('docente-destroy', ['usuario'=>$usuario->id])}}" method="POST" class="Eliminar">
      @method('DELETE')
      @csrf
      <button class="btn btn-dark btn-block btn-lg" type="submit">Eliminar</button>
    </form>


    @endif
    @endforeach
    @endif
    @endforeach

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
            title: '¿Estás seguro que quieres eliminar el docente?',
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
  title: 'Docente eliminado',
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
  text: 'No se encontro ningun docente con ese codigo',
  showConfirmButton: true,
  })

</script>
@endif
@php
use App\Models\Usuario;
$docentes=Usuario::all();
@endphp
<script>
  var buscar=document.getElementById("buscar");
var nombre=document.getElementById("inputNombre");
buscar.onclick=function(evento){
  var encontrado=0
  
@foreach ($rols as $userRol)
  

  @foreach ($docentes as $docente)
    if(nombre.value== '{{$docente->CI}}' && {{$docente->estado}}==1 && '{{$userRol->usuario_id}}'=='{{$docente->id}}' && '{{$userRol->rol->id}}'==2){
      encontrado=1;
    }
  @endforeach
  @endforeach
  if(encontrado==0){
    event.preventDefault();
    Swal.fire({
position: 'center',
icon: 'error',
title: 'Oops...',
text: 'No se encontro ningun docente con ese codigo',
showConfirmButton: true,

})
  }
  

}
</script>
@endsection