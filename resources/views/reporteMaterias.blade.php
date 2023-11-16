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
     
        <h3>Materias</h3>

        <a href="#" class="material-symbols-outlined" id="menu">menu</a>
        <form class="d-flex">
      
          <a class="nav-link active" aria-current="page" href="/menu" id="inicio">Inicio</a>
        </form>
      </div>
    </nav>
  </header>
  <div id="Container" class="container-fluid">
   

  <h3 class="row justify-content-center justify-content-md-start titulo-form">&nbsp;&nbsp;Lista de materias</h3>
  @if(count($user->user_rol[0]->asignacionDocentes) == 0)
  
  <br>
  <br>
  <br>
  <h4 class="row justify-content-center">No hay resultados </h4>

  @else

  <table class="table table-striped" id="tablaMateria">
  
        <thead>                
              <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Materia</th>
                    <th scope="col">Grupo</th>
                    <th scope="col">Horario</th>
              </tr>
        </thead>
        <tbody>
               @foreach($user->user_rol[0]->asignacionDocentes as $asignacion)
               <tr>
                     
                     <td>{{$asignacion->grupos->materia_carrera->materia->Cod_materia}}</td>
                     <td>{{$asignacion->grupos->materia_carrera->materia->nombre_materia}}</td>  
                     <td>{{$asignacion->grupos->nombre}}</td>      
                     <td>
                        @foreach ($asignacion->grupos->horarios as $horario)
                           {{$horario->dia}} - {{$horario->horario}} <br>
                        @endforeach
                        
                     </td>                   
  
               </tr>    
               @endforeach 
              
        </tbody>
  </table>
  @endif
</div>

  </body>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>
  <script>
        $('#tablaMateria').DataTable({
        responsive:true,
        autoWidth:false,
        "language": {
              "lengthMenu": "Mostrar _MENU_  ",
              "zeroRecords": "No hay resultados",
              "info": "Mostrando la página _PAGE_ de _PAGES_",
              "infoEmpty": "No records available",
              "infoFiltered": "(filtrado de _MAX_ registros totales)",
              "search":"Buscar",
              "paginate":{
                    "next":"Siguiente",
                    "previous":"Anterior"
              }
          }
        });
        var row=document.getElementsByClassName("row")
        row[1].id="primero"
        row[3].id="tercero"
  </script>
</html>
