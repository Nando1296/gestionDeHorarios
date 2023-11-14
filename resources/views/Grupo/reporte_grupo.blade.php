@extends('plantilla')
@section('title', 'Grupo')
@section("editar","grupoEdit")
@section("registrar","grupos")
@section("reporte","reporte_grupo")
@section("eliminar","eliminar-grupo")
@section('Titulo')
<h3 text-center>Administración de grupos </h3>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
@endsection
@section('Contenido formulario')

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

@endsection
@section('js')
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
@endsection