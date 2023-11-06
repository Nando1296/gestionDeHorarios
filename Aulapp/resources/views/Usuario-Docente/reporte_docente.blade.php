@extends('plantilla')
@section('title', 'Docente')
@section('Titulo')
@section("editar","docenteEdit")
@section("registrar","docente")
@section("reporte","reporte_docente")
@section("eliminar","eliminar-docente")
<h3 text-center>Administracion de docentes </h3>
@endsection
@section('Contenido formulario')
<div id="C_tabla">
      <h3 id="T_tabla">Lista de docentes</h3>
      <table class="table table-striped">
      
            <thead>                
                  <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">CI</th>
                        <th scope="col">Email</th>
                  </tr>
            </thead>
            <tbody>
                    @foreach($usuarios as $usuario)
                   <tr>
                         <td>{{$usuario->Nombre}}</td>
                         <td>{{$usuario->Apellido}}</td>
                         <td>{{$usuario->CI}}</td>
                         <td>{{$usuario->Email}}</td>
                         
                         <td>
                               <div><a href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    </svg>
                               </a>
                               </div>
                             
                         </td>
                         
                   </tr>   
                   @endforeach  
                  
            </tbody>
      </table>
</div>
@endsection