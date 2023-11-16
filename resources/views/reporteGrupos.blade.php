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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
</head>

<body>


  <header>
    <nav class="navbar navbar-light "  text-center>
      <div class="container-fluid">
        <div class="gestion-nav">
        <img src="{{asset('imagenes/INF-SIS.png')}}" alt="" >
        <div class="titulo">Departamento de Informática y Sistemas </div>
       
        </div>
     
        <h3>Estado de gestion</h3>

        <a href="#" class="material-symbols-outlined" id="menu">menu</a>
        <form class="d-flex">
      
          <a class="nav-link active" aria-current="page" href="/menu" id="inicio">Inicio</a>
        </form>
      </div>
    </nav>
  </header>

 
  
<h3 class="row justify-content-center justify-content-md-start titulo-form">&nbsp;&nbsp;Lista de grupos</h3>
@if(count($grupos) == 0)

<br>
<br>
<br>
<h4 class="row justify-content-center">No hay resultados</h4>

@else

<table class="table table-striped" id="tablaGrupo">

<thead>                
            <tr>  
                  <th scope="col">Id</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Materia</th>
                  <th scope="col">Carrera</th>
                  <th scope="col">Activo</th>
                
              
            </tr>
      </thead>
      <tbody>
              @foreach($grupos as $grupo)
             <tr>
                   <td>{{$grupo->id}}</td>
                   <td>{{$grupo->nombre}}</td>
                   <td>{{$grupo->materia_carrera->materia->nombre_materia}}</td> 
                   <td>{{$grupo->materia_carrera->carrera->Nombre}}</td>
                
                   
                   @if($grupo->estado==1)
                        
                        <td>SI</td>

                   @else
                        <td>NO</td>
                   
                   @endif
                   
            </tr>   
             @endforeach  
            
      </tbody>
</table>
@endif

  </body>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>
<script>
      $('#tablaGrupo').DataTable({
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
     
</script>
<script>
      var editar=document.getElementById("editar")
      editar.style.display="none"
      var row=document.getElementsByClassName("row")
      row[1].id="primero"
      row[3].id="tercero"
</script>
</html>



