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

  

  <form action="#" method="POST" class="formulario" id="form">
    <div>
      <h2><strong>Formulario de MODIFICACIÓN DE HORARIOS</strong> </h2>
      <h4>Procedimientos y Reglas</h4>
      
    </div>
    <br>

    <h2>Formulario de MODIFICACIÓN DE HORARIOS sector Académico</h2>
    <h1>(Valido Solamente para Horarios de CLASES de Docentes y Auxiliares de Docencia)</h1>
    <h3>Seleccione las opciones que se requiera: </h3>

   <div class="grid grid-cols-2">
    <div><span>Cambio de Horario</span> <input type="checkbox" name="Cambio de Horario" id="Cambio de Horario" onchange="cambioDeHorario(this)"></div>
    <div><span>Cambio de Aula </span> <input type="checkbox" name="Cambio de Aula" id="Cambio de Aula" onchange="cambioDeAula(this)"></div>
    <div class="col-start-2"> <span>Otro. Especificar </span><input type="label" name="Otro. Especificar" id="Otro. Especificar"></div>
   </div>
   <hr>
    <br>

    <div class="grid grid-cols-6" >
    <div class="col-span-6"><span>Primero por direccion de planificacion academica (DPA)</span></div>
    <div class="col-span-2"><span>Cambio de Docente</span></div><div><input type="checkbox" name="" id="" onchange="cambioDeDocente(this)"></div>
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
        <td colspan="5">
          <div>
            <select name="docente" id="" onchange="llenarDocente(this)">
            <option value="none">Seleccione un docente</option>
            @foreach ($docentes as $docente)
             <option value="{{$docente}}" >{{$docente->Nombre}} {{$docente->Apellido}}</option>
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
            <select name="materia"  onchange="llenarMateria(this,1)">
                <option value="none"></option>
                @foreach ($materia_carreras as $materia)
                <option  value="{{$materia}}">{{$materia->materia->Cod_materia}}</option>    
                @endforeach
            </select>
        </td>

        <td ><span class="materia1"></span></td>
        
        <td>
            <select name="grupo" id="grupos1" onchange="llenarGrupo(this,1)">
                 
            </select>
        </td>
        <td>Ingeniería de Sistemas</td>
        <td>
            <select name="dia" id="dia" onchange="llenarDia(this,1)">
              <option value="none"></option>
                <option >Lunes</option>
                <option >Martes</option>
                <option >Miércoles</option>
                <option >Jueves</option>
                <option >Viernes</option>
                <option >Sábado</option>
            </select>
        </td>
        <td>
        
            
            <select name="horario" class="horario" id="horario"  onchange="llenarHorario(this,1)">
              <option value="none"></option>
              @foreach ($horarios as $horario)
          
                <option>{{$horario}}</option>
               

              @endforeach 
            </select>
         
        </td>
        <td>
            <select name="aula" onchange="llenarAula(this,1)">
              <option value="none"></option>
                @foreach ($aulas as $aula)
                    <option value="{{$aula->id}}">{{$aula->nombre}}</option>
                @endforeach
            </select>
        </td>
      </tr>

      <tr>
        <td class="h-8">
          <select name="materia"   onchange="llenarMateria(this,2)">
            <option value="none"></option>
            @foreach ($materia_carreras as $materia)
            <option  value="{{$materia}}">{{$materia->materia->Cod_materia}}</option>    
            @endforeach
        </select>
        </td>
        <td ><span class="materia2"></span></td>
        
        <td>
            <select name="grupo" id="grupos2"  onchange="llenarGrupo(this,2)">
                 
            </select>
        </td>
        <td>Ingeniería de Sistemas</td>
        <td>
            <select name="dia" id="dia" onchange="llenarDia(this,2)">
              <option value="none"></option>
                <option >Lunes</option>
                <option >Martes</option>
                <option >Miércoles</option>
                <option >Jueves</option>
                <option >Viernes</option>
                <option >Sábado</option>
            </select>
        </td>
        <td>
        
            
            <select name="horario" class="horario" id="horario"  onchange="llenarHorario(this,2)">
              <option value="none"></option>
              @foreach ($horarios as $horario)
          
                <option>{{$horario}}</option>

              @endforeach 
            </select>
         
        </td>
        <td>
            <select name="aula"  onchange="llenarAula(this,2)">
              <option value="none"></option>
                @foreach ($aulas as $aula)
                    <option value="{{$aula->id}}">{{$aula->nombre}}</option>
                @endforeach
            </select>
        </td>
      </tr>

      <tr>
      
        <td class="h-8">
            <select name="materia"  onchange="llenarMateria(this,3)">
              <option value="none"></option>
              @foreach ($materia_carreras as $materia)
              <option  value="{{$materia}}">{{$materia->materia->Cod_materia}}</option>    
              @endforeach
          </select>
        </td>
        <td ><span class="materia3"></span></td>
        
        <td>
            <select name="grupo" id="grupos3"  onchange="llenarGrupo(this,3)">
                 
            </select>
        </td>
        <td>Ingeniería de Sistemas</td>
        <td>
            <select name="dia" id="dia" onchange="llenarDia(this,3)">
                <option value="none"></option>
                <option >Lunes</option>
                <option >Martes</option>
                <option >Miércoles</option>
                <option >Jueves</option>
                <option >Viernes</option>
                <option >Sábado</option>
            </select>
        </td>
        <td>
        
            
            <select name="horario" class="horario" id="horario" onchange="llenarHorario(this,3)">
              <option value="none"></option>
              @foreach ($horarios as $horario)
          
                <option>{{$horario}}</option>
               

              @endforeach 
            </select>
         
        </td>
        <td>
            <select name="aula" onchange="llenarAula(this,3)">
              <option value="none"></option>
                @foreach ($aulas as $aula)
                    <option value="{{$aula->id}}">{{$aula->nombre}}</option>
                @endforeach
            </select>
        </td>
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
            <td colspan="5">
              
              <div><span id="sdocenteM" ></span></div><br>

              <select name="docenteM" id="docenteM" style="display: none">
                @foreach ($docentes as $docente)
                <option value="{{$docente}}" >{{$docente->Nombre}} {{$docente->Apellido}}</option>
                @endforeach 
              </select>
              
              <div>Apellido Paterno Ap. Materno Nombres(s) </div>
            </td>
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
            <td class="h-8"><span id="codMateria1"></span></td>

            <td><span class="materia1"></span></td>
            
            <td><span id="sgrupos1"></span></td>

            <td><span id="carrera">Ingeniería de Sistemas</span></td>
            <td>
              
              <span class="sdiaM" id="sdia1"></span> 
              
              <select name="dia" class="diaM" style="display: none">
              <option value="none"></option>
              <option >Lunes</option>
              <option >Martes</option>
              <option >Miércoles</option>
              <option >Jueves</option>
              <option >Viernes</option>
              <option >Sábado</option>
            </select></td>
            <td>
              <span class="shorarioM" id="shorario1"></span>

              <select name="horarioM" class="horarioM" style="display: none">
                <option value="none"></option>
                @foreach ($horarios as $horario)
              
                <option>{{$horario}}</option>
                @endforeach 
              </select>
            </td>
            <td>
              <span class="saulaM" id="saula1"></span>

              <select name="aulaM" class="aulaM" style="display: none">
                <option value="none"></option>
                @foreach ($aulas as $aula)
                  <option value="{{$aula->id}}">{{$aula->nombre}}</option>
                @endforeach
              </select>
            </td>
          </tr>
          <tr>
            <td class="h-8"><span id="codMateria2"></span></td>

            <td><span class="materia2"></span></td>
            
            <td><span id="sgrupos2"></span></td>
            
            <td><span id="carrera">Ingeniería de Sistemas</span></td>
            
            <td>
              <span class="sdiaM" id="sdia2"></span> 
              
              <select name="dia" class="diaM" style="display: none">
                <option value="none"></option>
              <option >Lunes</option>
              <option >Martes</option>
              <option >Miércoles</option>
              <option >Jueves</option>
              <option >Viernes</option>
              <option >Sábado</option>
            </select>
            </td>
            
            <td>
              <span class="shorarioM" id="shorario2"></span>

              <select name="horarioM" class="horarioM" style="display: none">
                <option value="none"></option>
                @foreach ($horarios as $horario)
              
                <option>{{$horario}}</option>
                @endforeach 
              </select>
            </td>

            <td>
              <span class="saulaM" id="saula2"></span>

              <select name="aulaM" class="aulaM" style="display: none">
                <option value="none"></option>
                @foreach ($aulas as $aula)
                  <option value="{{$aula->id}}">{{$aula->nombre}}</option>
                @endforeach
              </select>
            </td>

          </tr>
          <tr>
            <td class="h-8"><span id="codMateria3"></span></td>

            <td><span class="materia3"></span></td>
            
            <td><span id="sgrupos3"></span></td>
            
            <td><span id="carrera">Ingeniería de Sistemas</span></td>
            
            <td>
              
              <span class="sdiaM" id="sdia3"></span> 
              
              <select name="dia" class="diaM" style="display: none">
                <option value="none"></option>
              <option >Lunes</option>
              <option >Martes</option>
              <option >Miércoles</option>
              <option >Jueves</option>
              <option >Viernes</option>
              <option >Sábado</option>
            </select></td>
            <td>
              <span class="shorarioM" id="shorario3"></span>

              <select name="horarioM" class="horarioM" style="display: none">
                <option value="none"></option>
                @foreach ($horarios as $horario)
              
                <option>{{$horario}}</option>
                @endforeach 
              </select>
            </td>
            <td>
              <span class="saulaM" id="saula3"></span>

              <select name="aulaM" class="aulaM" style="display: none">
                <option value="none"></option>
                @foreach ($aulas as $aula)
                  <option value="{{$aula->id}}">{{$aula->nombre}}</option>
                @endforeach
              </select>
            </td>
          </tr>

          <tr>
            <td colspan="7"><div></div><div>Nota: Deben ser llenadas todas las columnas y datos requeridos en este formulario, caso contrario sera rechazado.</div></td>
          </tr>

      </tbody>
    </table>
  
  </form>

  <button id="button"  onclick="descargar()">Descargar PDF</button>

<script>

    function cambioDeHorario(obj){
      var shorarioMod=document.getElementsByClassName("shorarioM");
      var horarioMod=document.getElementsByClassName('horarioM');
      var diaMod=document.getElementsByClassName('diaM');
      var sdiaMod=document.getElementsByClassName('sdiaM');


      if(obj.checked){
        
        Array.from(horarioMod).forEach(element => {
          element.style.display="inline";
        });
        


        Array.from(shorarioMod).forEach(element => {
          element.style.display="none";
        });
        

        Array.from(diaMod).forEach(element => {
          element.style.display="inline";
        });
        
        Array.from(sdiaMod).forEach(element => {
          element.style.display="none";
        });
        

      }else{ 
        Array.from(horarioMod).forEach(element => {
          element.style.display="none";
        });
        


        Array.from(shorarioMod).forEach(element => {
          element.style.display="inline";
        });
        

        Array.from(diaMod).forEach(element => {
          element.style.display="none";
        });
        
        Array.from(sdiaMod).forEach(element => {
          element.style.display="inline";
        });


      }
    }

    function cambioDeAula(obj){
      var aulaMod=document.getElementsByClassName('aulaM');
      var saulaMod=document.getElementsByClassName("saulaM");

      if(obj.checked){
        

        Array.from(aulaMod).forEach(element => {
          element.style.display="inline";
        });

        Array.from(saulaMod).forEach(element => {
          element.style.display="none";
        });

      }else{ 
        
        Array.from(aulaMod).forEach(element => {
          element.style.display="none";
        });

        Array.from(saulaMod).forEach(element => {
          element.style.display="inline";
        });

    
      }
    }

    function cambioDeDocente(obj){
      var docenteMod=document.getElementById('docenteM');
      var sdocenteMod=document.getElementById("sdocenteM");

      if(obj.checked){
        
        docenteMod.style.display="inline";
        sdocenteMod.style.display="none";

      }else{ 
      
        docenteMod.style.display="none";
        sdocenteMod.style.display="inline";
      }
    }

    function llenarAula(obj,id){
      var selectAula=obj.options[obj.selectedIndex];

      var spanAula=document.getElementById('saula'+id);

      spanAula.innerHTML=selectAula.textContent;
    }

    function llenarHorario(obj,id){
      var selectHorario=obj.options[obj.selectedIndex];

      var spanHorario=document.getElementById('shorario'+id);
     
      spanHorario.innerHTML=selectHorario.textContent;
    }
    
    function llenarDia(obj,id){
      var selectDia=obj.options[obj.selectedIndex];

      var spanDia=document.getElementById('sdia'+id);
     
      spanDia.innerHTML=selectDia.textContent;
    }

    function llenarGrupo(obj,id){
      var selectGrupo=obj.options[obj.selectedIndex];
    //  var objeto=JSON.parse(selectGrupo.value);
    //  console.log(objeto);
      var spanGrupo=document.getElementById('sgrupos'+id);
     
      spanGrupo.innerHTML=selectGrupo.textContent;
    }

    function llenarDocente(obj){
      var selectDocente=obj.options[obj.selectedIndex];
      var objeto=JSON.parse(selectDocente.value);
    //  console.log(objeto);
      var spanDocente=document.getElementById('sdocenteM');
      spanDocente.innerHTML= objeto.Nombre+" "+objeto.Apellido;

    }

    function llenarMateria(obj,id){

      var selectMateria=obj.options[obj.selectedIndex];
      if(selectMateria.value!="none"){
        var objeto=JSON.parse(selectMateria.value);
      
      

      var codMateria=document.getElementById('codMateria'+id);
      codMateria.innerHTML=objeto.materia.Cod_materia;

      var spans=document.getElementsByClassName('materia'+id);

      Array.from(spans).forEach(element =>{
        element.innerHTML=objeto.materia.nombre_materia;
      })

      }

      var selectGrupo=document.getElementById('grupos'+id);
      selectGrupo.innerHTML="";
      selectGrupo.innerHTML+="<option value='none'></option>"

      if(objeto!=null){
        var grupos=objeto.grupos;

        if(grupos!=null){
          grupos.forEach(element => {
        selectGrupo.innerHTML+="<option value="+element.id+">"+element.nombre+"</option>"
        });

        }
      }
      
     
    }

    
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
   function descargar(){
        var element = document.getElementById("form");
      //  var encabezado =document.getElementById("encabezado");
        var today = new Date();
        var now = today.toLocaleString();
        
      var doc=  html2pdf().set({
        //margin: [40,0,20,0],
        filename: 'formulario.pdf',
        image: {
                    type: 'jpeg',
                    quality: 0.99
                },
        html2canvas: {

            scale: 3,
            letterRendering: true,
            //allowTaint: true,
            //foreignObjectRendering: true,
            //x:0,
            y:2,
           // scrollX:-10,
            scrollY:10
        },
        jsPDF: {
            unit: "mm",
            format: "letter",
            orientation: 'portrait', // landscape o portrait
        },
        pagebreak: {
            mode: 'avoid-all', 
            before: '#page2el'
        },
       
        }).from(element).toPdf().save().catch(err => console.log(err));
        
    
    
    }
</script>

</body>
</html>