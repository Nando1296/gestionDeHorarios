@extends('plantilla')
@section('title', 'Seccion')
@section("editar","seccionEdit")
@section("registrar","seccion")
@section("reporte","reporte_section")
@section("eliminar","eliminar-seccion")
@section('Titulo')
<h3 text-center>Administración de secciones </h3>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
@endsection
@section('Contenido formulario')

<h3 class="row justify-content-center justify-content-md-start">&nbsp;&nbsp;Lista de secciones</h3>
     
      @if(count($sections) == 0)
      
      <br>
      <br>
      <br>
      <h4 class="row justify-content-center">No hay resultados</h4>
 
      @else
      <table class="table table-striped" id="tablaSeccion">
      
            <thead>                
                  <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Activo</th>
                  </tr>
            </thead>
            <tbody>
                    @foreach($sections as $section)
                   <tr>
                         <td>{{$section->nombre}}</td>
                         <td>{{$section->descripcion}}</td>

                         @if($section->estado==1)
                                                
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
     $('#tablaSeccion').DataTable({
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
@endsection