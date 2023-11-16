<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
  <link rel="stylesheet" href="{{asset('css/plantilla.css')}}" />
  <link rel="stylesheet" href="{{asset('css/editar.css')}}" />
  <title>Gestion</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gruppo&family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>


  <header>
    <nav class="navbar navbar-light "  text-center>
      <div class="container-fluid">
        <div class="gestion-nav">
        <img src="{{asset('imagenes/INF-SIS.png')}}" alt="" >
        <div class="titulo">Departamento de Informática y Sistemas </div>
       
        </div>
     
        <h3 class="titulo-form">Administración de horarios</h3>

        <a href="#" class="material-symbols-outlined" id="menu">menu</a>
        <form class="d-flex">
      
          <a class="nav-link active" aria-current="page" href="/menu" id="inicio">Inicio</a>
        </form>
      </div>
    </nav>
  </header>

 
  <div id="Container" class="container-fluid">
    <div class="row">
        <div >
          {{--Contenido del formulario que tiene las gestiones del año
            las gestiones son añadidas desde el js para que se actualice a medida que los años se van cambiando--}}
          <div class="d-flex" id="formularioEditar">
            <form method="POST" action="{{route('horario')}}" id="formulario">
              
              @csrf

              <h3 text-center  class="titulo-form">Registrar horarios</h3>
             
              <label for="grupo" class="form-label ">Grupo</label>
              <select name="grupo" id="grupo" class="form-control ">
                @foreach($asignaciones as $grupo)
                    <option value="{{$grupo->id}}">{{$grupo->grupos->nombre}} - {{$grupo->grupos->materia_carrera->materia->nombre_materia}} - {{$grupo->user_rol->usuario->Nombre}} {{$grupo->user_rol->usuario->Apellido}}</option>
                @endforeach
              </select>
              
              <label for="dia" class="form-label ">Día</label>
              <select name="dia" id="dia" class="form-control">
                <option>Lunes</option>
                <option>Martes</option>
                <option>Miercoles</option>
                <option>Jueves</option>
                <option>Viernes</option>
                <option>Sábado</option>
              </select>

              <label for="horario" class="form-label ">Horario</label>
              <select name="horario" id="horario" class="form-control ">
                <option>6:45 - 8:15</option>
                <option>8:15 - 9:45</option>
                <option>9:45 - 11:15</option>
                <option>11:15 - 12:45</option>
                <option>12:45 - 14:15</option>
                <option>14:15 - 15:45</option>
                <option>15:45 - 17:15</option>
                <option>17:15 - 18:45</option>
                <option>18:45 - 20:15</option>
                <option>20:15 - 21:45</option>
              </select>

              <label for="aula" class="form-label ">Aula</label>
              <select name="aula" id="aula" class="form-control ">
                @foreach ($aulas as $aula)
                    <option >{{$aula->nombre}}</option>
                @endforeach
              </select>
              <div class="d-grid gap-2">
                <button class="btn btn-dark btn-block btn-lg " id="botonRegistrar" type="submit">Guardar</button>
                
              </div>
            </form>
          </div>
        
        </div>
  </div>
  {{-- Mensaje de actualizado correctamente--}}
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
  </body>