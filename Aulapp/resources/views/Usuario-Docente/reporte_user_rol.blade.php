@extends('plantilla')
@section('title', 'Docente')
@section('Titulo')
@section("editar","docenteEdit")
@section("registrar","docente")
@section("reporte","reporte_user_rol")
@section("eliminar","eliminar-docente")
<h3 text-center>Administración de docentes </h3>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
@endsection
@section('Contenido formulario')

      <h3 class="row justify-content-center justify-content-md-start">&nbsp;&nbsp;Lista de docentes</h3>

    
      
      <table class="table table-striped" id="tablaDocente">
      
            <thead>                
                  <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">CI</th>
                        <th scope="col">Email</th>
                        <th scope="col">Activo</th>
                  </tr>
            </thead>
            <tbody>
                 
                    @foreach($user_rols as $user_rol)
                    @if ($user_rol->rol_id == 2) 
                    
                   <tr>
                         <td>{{$user_rol->usuario->Nombre}}</td>
                         <td>{{$user_rol->usuario->Apellido}}</td>
                         <td>{{$user_rol->usuario->CI}}</td>
                         <td>{{$user_rol->usuario->Email}}</td>

                         @if($user_rol->estado==1)
                                                
                            <td>SI</td>

                          @else
                           <td>NO</td>
                                          
                          @endif
                         
                   </tr>   
                   
                   @endif
                   @endforeach
                  
                  
            </tbody>
      </table>

@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>
<script>
      $('#tablaDocente').DataTable({
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
@endsection