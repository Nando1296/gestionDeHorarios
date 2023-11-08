<!DOCTYPE html>
<html lang="es">
  
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('css/styles.css')}}">
  <title>PROYECTO DPTO INF-SIS</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  <form action="#" method="POST" class="formulario">
    <div>
    <h2>Formulario de MODIFICACIÓN DE HORARIOS </h2>
    <h4>Procedimientos y Reglas</h4>
    <button type="submit">Descargar PDF</button>
  </div>
<br>

    <h2>Formulario de MODIFICACIÓN DE HORARIOS sector Académico</h2>
    <h1>(Valido Solamente para Horarios de CLASES de Docentes y Auxiliares de Docencia)</h1>
    <h3>Seleccione las opciones que se requiera: </h3>

   <div class="grid grid-cols-2">
    <div><span>Cambio de Horario</span> <input type="checkbox" name="Cambio de Horario" id="Cambio de Horario"></div>
    <div><span>Cambio de Aula </span> <input type="checkbox" name="Cambio de Aula" id="Cambio de Aula"></div>
    <div class="col-start-2"> <span>Otro. Especificar </span><input type="label" name="Otro. Especificar" id="Otro. Especificar"></div>
   </div>
   <hr>
  <br>

  <div class="grid grid-cols-6" >
  <div class="col-span-6"><span>Primero por direccion de planificacion academica (DPA)</span></div>
  <div class="col-span-2"><span>Cambio de Docente</span></div><div><input type="checkbox" name="" id=""></div>
  <div class="col-span-2"><span>Eliminar Horario/Grupo</span></div><div><input type="checkbox" name="" id=""></div>
  <div class="col-span-2"><span>Abrir Grupo y/o Materia</span></div><div><input type="checkbox" name="" id=""></div>
  <div class="col-span-2"><span>Desactivar Materia</span></div><div><input type="checkbox" name="" id=""></div>
  <div class="col-span-2"><span>Activar solo ME</span></div><div><input type="checkbox" name="" id=""></div>
  </div>
  <hr>
  <br>

   <table>
    <tbody>
      <tr>
        <td colspan="7">Horario (actual) a modificar --> Coloque la informacion (del día) que se encuentra en el websis </td></tr>

      <tr>
        <td colspan="5"><div><select name="docente" id="" onchange="llenar()">
            <option value="none">Seleccione un docente</option>
            @foreach ($docentes as $docente)
             <option value="{{$docente->id}}" onclick="llenarDocente()">{{$docente->Nombre}} {{$docente->Apellido}}</option>
         @endforeach    
        </select></div><br><div>Apellido Paterno Ap. Materno Nombres(s) </div></td>
        <td colspan="1"><span>Docente</span></div><div><input type="radio" name="option" id="" ></td>
        <td colspan="1"><span>Auxiliar</span></div><div><input type="radio" name="option" id=""></td>
      </tr>

      <tr>
        <td>Codigo SIS Materia</td>
        <td>Nombre Materia</td>
        <td>Grupo</td>
        <td>Carrera</td>
        <td>Dia</td>
        <td>Horario</td>
        <td>Aula</td>
      </tr>
      
      <tr>
        <td class="h-8">
            <select name="materia" id="">
                <option value="none">Seleccione una materia</option>
                @foreach ($materia_carreras as $materia)
                <option value="{{$materia->id}}" onclick="llenarMateria()">{{$materia->materia->Cod_materia}}</option>    
                @endforeach
            </select>
        </td>

        <td></td>
        
        <td>
            <select name="grupo" id="">
                 <option value="none">Grupo</option>
            </select>
        </td>
        <td></td>
        <td>
            <select name="dia" id="">
                <option value="">Lunes</option>
                <option value="">Marte</option>
                <option value="">Miercoles</option>
                <option value="">Juves</option>
                <option value="">Viernes</option>
                <option value="">Sábado</option>
            </select>
        </td>
        <td></td>
        <td>
            <select name="aula" id="">
                @foreach ($aulas as $aula)
                    <option value="{{$aula->id}}">{{$aula->nombre}}</option>
                @endforeach
            </select>
        </td>
      </tr>
      <tr>
        <td class="h-8"></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td class="h-8"></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>

      <tr>
        <td colspan="7"><div></div><div>Nota: Deben ser llenados todos los datos requeridos en este formulario, caso contrario sera rechazado.</div><div>OJO! La carga horaria debe mantenerse en ambas tablas</div></td>
       </tr>

    </tbody>
   </table>
   <br>
   <hr>
   <br>
   

<!-- HORARIO AL QUE SE DESA MODIFICAR-->

   <table>
    <tbody>
      <tr>
        <td colspan="7">Horario al que se desea modificar (Si es nuevo grupo SOLO llene en esta tabla) </td>
      </tr>

      <tr>
        <td colspan="5"><div></div><br><div>Apellido Paterno Ap. Materno Nombres(s) </div></td>
        <td colspan="1"><span>Docente</span></div><div><input type="radio" name="" id=""></td>
        <td colspan="1"><span>Auxiliar</span></div><div><input type="radio" name="" id=""></td>
      </tr>

      <tr>
        <td>Codigo SIS Materia</td>
        <td>Nombre Materia</td>
        <td>Grupo</td>
        <td>Carrera</td>
        <td>Dia</td>
        <td>Horario</td>
        <td>Aula</td>
      </tr>
      
      <tr>
        <td class="h-8"><span  id="docente"></span></td>
        <td><span id="codMateria"></span></td>
        <td><span id="nomMateria"></span></td>
        <td><span id="grupos"></span></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td class="h-8"></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td class="h-8"></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>

      <tr>
        <td colspan="7"><div></div><div>Nota: Deben ser llenadas todas las columnas y datos requeridos en este formulario, caso contrario sera rechazado.</div></td>
       </tr>

    </tbody>
   </table>

<script>
    function llenarMateria(){
        console.log('a');
    }

    function llenar(){
        console.log('a');
    }
</script>


</body>
</html>