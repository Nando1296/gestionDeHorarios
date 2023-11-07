<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Pagina donde los docentes reservan aulas para sus examenes" />
  <meta name="keywords" content="Reserva,aulas,fcyt" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
  <link rel="stylesheet" href="{{asset('css/plantilla.css')}}" />
  <link rel="stylesheet" href="{{asset('css/editar.css')}}" />
  <title>Reserva</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gruppo&family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</head>

<body>


  <header>
    <nav class="navbar navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><span id="Nlogo">Aulapp</span><img src="{{asset('Imagenes/logo.jpeg')}}" width="50" id="logo" alt="logo"></a>
        <h3>Realizar reserva</h3>
        <a href="#" class="material-symbols-outlined" id="menu">menu</a>
        <form class="d-flex" >
          <a href="bandeja_docente"><img src="{{asset('Imagenes/campana.png')}}" id="campana" width="30" alt="notificaciones">
          </a>
          <a  class=" position-relative" id="cant_not">
           <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark">
         {{$not}}
          </span>
          </a>
          <a class="nav-link active" aria-current="page" href="menu" id="inicio">Inicio</a>
          
        </form>
      </div>
    </nav>
  </header>
  <div id="Container" class="container-fluid">
    <div class="row">
      {{--Formulario de reserva--}}
        <div >
          <div class="d-flex" id="formularioEditar">
            <form method="POST"  id="formulario" {{route('reserva')}}>
              
              @csrf
              <h3 text-center>Realizar reserva</h3>
              <input type="text" name="id" id="id" class="form-control oculto">
              <label>Materia:</label>
              <select name="materia" id="materia" class="form-select"> 
              </select>
                <label id="nombre">Nombre:</label>
              <br>
              <input type="text" name="docentes" id="lista_docentes" class="form-control oculto" value="">
              <div id="docentes"></div>
              <button type="button" class="btn btn-dark btn-block btn-lg" data-toggle="button" aria-pressed="false" autocomplete="off" id="añadirD">
                Añadir docente +
               </button><br>
              <label>Grupos:</label>
              <input type="text" name="grupos" id="lista_grupos" class="form-control oculto">
              <div id="grupos"></div>
              <span id="errorg" class="error"></span><br>
              <button type="button" class="btn btn-dark btn-block btn-lg" data-toggle="button" aria-pressed="false" autocomplete="off" id="añadirG">
                Añadir grupo +
               </button>
              <div class="row">
                  <div class="col-5"><label for="cantidad">Cantidad de estudiantes:</label></div>
                  <div class="col-5"><input type="text" id="cantidad" name="cantidad" class="form-control"></div>
                  <span id="errorc" class="error"></span>
              </div> 

              <label for="motivo">Motivo:</label><br>
              <textarea name="motivo" id="motivo" cols="45" rows="3" class="form-control"></textarea>
              <span id="errorm" class="error"></span><br>
                <div class="row">
                  <div class="col-5"><label for="fecha">Fecha: </label></div> 
                    <div class="col-5"><input type="date" name="fecha" id="fecha" class="date"><br></div>
                </div>
                
                <span id="errorf" class="error"></span><br>
                <div class="row">
                    <div class="col-5"><label>Horario:</label></div>
                    <div class="col-5"><select name="horario" id="horario" class="form-select">
                        <option value="6:45">6:45</option>
                        <option value="8:15">8:15</option>
                        <option value="9:45">9:45</option>
                        <option value="11:15">11:15</option>
                        <option value="12:45">12:45</option>
                        <option value="14:15">14:15</option>
                        <option value="15:45">15:45</option>
                        <option value="17:15">17:15</option>
                        <option value="18:45">18:45</option>
                        <option value="20:15">20:15</option>
                    </select></div>
                </div><br>
                <div class="row">
                        <div class="col-5"><label>Duración:</label></div>
                        <div class="col-5"><select name="duracion" id="duracion" class="form-select">
                            <option value="1:30">1:30</option>
                            <option value="3:00">3:00</option>    
                        </select></div>
                        <div class="col"><label>Hrs.</label></div>
                        <input type="text" name="fechaf" value="8:15" id="fechaf" class="oculto">
                </div>
              <div class="d-grid gap-2">
                <button class="btn btn-dark btn-block btn-lg " id="botonRegistrar" type="submit">Guardar</button>
                <a href="/menu" class="btn btn-danger btn-block btn-lg " id="botonRegistrar"
                  type="button">Cancelar</a>
              </div>
            </form>
          </div>
        
        </div>
  </div>
  <footer>
  </footer>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  @yield('js')
<script>
  var id=document.getElementById("id");
  id.value={{$id}}
  var menu=document.getElementsByClassName("nav-link");
  var btn_menu=document.getElementById("menu")
  btn_menu.onclick=function(){
    if(btn_menu.innerHTML=="menu"){
      for(var i=0 ; i<menu.length;i++){
      menu[i].style.display="block"
      }
       btn_menu.innerHTML="close";
    }else{
      for(var i=0 ; i<menu.length;i++){
      menu[i].style.display="none"
    }
    btn_menu.innerHTML="menu";
    }
  }
</script>
</body>
<script>
  var materia=document.getElementById("materia");
  var listaD=document.getElementById("lista_docentes");
  var listaG=document.getElementById("lista_grupos");
  var nombre="";
  // Se añaden las materiasque se le fueron asignadas al docente
  @foreach ($materias as $materia) 
        materia.innerHTML+="<option >{{$materia->nombre_materia}}</option>"
  @endforeach
  listaD.value="{{$usuario->Nombre}} {{$usuario->Apellido}}";
  //--------------------------------------Añadir docente-----------------------------------
  var añadirD=document.getElementById("añadirD");
  var añadirG=document.getElementById("añadirG");
  var asignacionD=document.getElementById("docentes")
  var asignacionG=document.getElementById("grupos")
  var docentes= document.createElement("select");
  docentes.className="form-select"
  añadirD.onclick=function(){
    var docentes= document.createElement("select");
  docentes.className="form-select"
 @foreach ($ads as $ad)
    if(materia.options[materia.selectedIndex].text == "{{$ad->grupos->materia_carrera->materia->nombre_materia}}" && !encontrardocente('{{$ad->user_rol->usuario->Nombre}} {{$ad->user_rol->usuario->Apellido}}')){
      //Se añade un temporizador para que cargue correctamente la lista de docentes
      setTimeout(() => {
        if(!encontrarD("{{$ad->user_rol->usuario->Nombre}} {{$ad->user_rol->usuario->Apellido}}")){
          //Coloctar los docentes que coinciden en la materia en el selector de docentes
          docentes.innerHTML+='<option class="docs">{{$ad->user_rol->usuario->Nombre}} {{$ad->user_rol->usuario->Apellido}}</option>'
        }
       
      }, 0);
      
       
      
      
    }
  @endforeach
  //Mostrar ventana emergente con los docentes que dictan la misma materia que el docente que realiza la reserva
    Swal.fire({
  title: 'Elija un docente',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Agregar',
  html: docentes,
  cancelButtonText: 'Cancelar'
}).then((result) => {
  if (result.isConfirmed) {
    listaD.value+=","+ docentes.options[docentes.selectedIndex].text
    asignacionD.innerHTML+="<button type='button' class='A_cont btn doc_asig' data-toggle='button' aria-pressed='false' autocomplete='off'><span class='material-symbols-outlined A_icon'>close</span><spam class='A_let d'>"+docentes.options[docentes.selectedIndex].text+"</spam></button>"
  }
})
  }
  //-----------------------------funcion de encontrar docente-----------------------
  function encontrardocente(d){
    var listado=listaD.value.split(",")
    var encontrado=false;
    for(var i=0;i<listado.length;i++){
      if(d== listado[i]){
        encontrado=true;
      }
    }
    return encontrado;
  }
  //--------------------------------funcion encontrar grupo------------------------
  function encontrargrupo(d){
    var listado=listaG.value.split(",")
    var encontrado=false;
    for(var i=0;i<listado.length;i++){
      if(d== listado[i]){
        encontrado=true;
      }
    }
    return encontrado;
  }
  //--------------------------------funcion quitar docente---------------------------------
  var letras=document.getElementsByClassName("A_let")
  var iconos=document.getElementsByClassName("A_icon")
  //Para quitar el docente del formulario
  asignacionD.onclick=function(a){
    var f=a.target;
    for(var i=0; i<letras.length;i++){
      if(f==letras[i] || f==iconos[i]){
            quitarDocente(letras[i].innerHTML)
            asignacionD.removeChild(letras[i].parentNode)
    }
  }
  }
  //Para quitar al docente de la lista de docentes que se enviara al registrar la solicitud
  function quitarDocente(d){
    var listado=listaD.value.split(",")
    listaD.value=""
    for(var i=0;i<listado.length;i++){
      if(d!= listado[i]){
        if(listaD.value==""){
          listaD.value+= listado[i]
        }else{listaD.value+= ','+listado[i]}
      }
    }
  }
  //----------------------------funcion quitar grupo--------------------------
  asignacionG.onclick=function(a){
    // Quitar el grupo del formulario
    var f=a.target;
    for(var i=0; i<letras.length;i++){
      if(f==letras[i] || f==iconos[i]){
            quitarGrupo(letras[i].innerHTML)
            asignacionG.removeChild(letras[i].parentNode)
    }
  }
  }
  //Quitar el grupo de la lista de grupos que se envia en la solicitud
  function quitarGrupo(d){
    var listado=listaG.value.split(",")
    listaG.value=""
    for(var i=0;i<listado.length;i++){
      if(d!= listado[i]){
        if(listaG.value==""){
          listaG.value+= listado[i]
        }else{listaG.value+= ','+listado[i]}
      }
    }
    //Habilitar l etiqueta de docente para eliminar en caso de que no se tenga ningun grupo de ese docente
    var d=$(".d")
    var g=$(".g")
    for(var i=0; i<d.length;i++){
      var alerta=false;
      for(var j=0; j<g.length;j++){
        if(d[i].innerHTML==g[j].id){
        alerta=true
        }
        if(alerta==false){
          d[i].parentNode.disabled=false;
        }
      }
    }
    if(listaG.value==""){for(var i=0;i<d.length;i++){d[i].parentNode.disabled=false;}}
  }
  //----------------Añadir grupo-------------------------------
  añadirG.onclick=function(){
    var grupos= document.createElement("select");
    grupos.className="form-select"
    var listado=listaD.value.split(",")

    @foreach ($ads as $ad)
     for(var i=0; i<listado.length;i++){
       if("{{$ad->user_rol->usuario->Nombre}} {{$ad->user_rol->usuario->Apellido}}"==listado[i] && materia.options[materia.selectedIndex].text == "{{$ad->grupos->materia_carrera->materia->nombre_materia}}" && !encontrargrupo('{{$ad->grupos->nombre}}')){
       //Se coloca un temporizador para el carcado correcto de los datos
        setTimeout(() => {
          if(!encontrarG("{{$ad->grupos->nombre}}"))  {
            //Asignar todos los grupos de la materia que pertenezcan a la lista de docentes 
          grupos.innerHTML+="<option class='groups' id='{{$ad->user_rol->usuario->Nombre}} {{$ad->user_rol->usuario->Apellido}}'>{{$ad->grupos->nombre}}</option>"
        }
    
      }, 0);
        
        }
     }
    @endforeach
    //Ventana emergente donde se mostrara la lista de los grupos permitidos
    Swal.fire({
  title: 'Elija un grupo',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Agregar',
  html: grupos,
  cancelButtonText: 'Cancelar'
}).then((result) => {
  if (result.isConfirmed) {
    if(listaG.value==""){
      listaG.value+=grupos.options[grupos.selectedIndex].text
    }else{listaG.value+=","+ grupos.options[grupos.selectedIndex].text}
    asignacionG.innerHTML+="<div class='A_cont'><span class='material-symbols-outlined A_icon'>close</span><spam class='A_let g' id='"+grupos.options[grupos.selectedIndex].id+"'>"+grupos.options[grupos.selectedIndex].text+"</spam></div>"
    var d=$(".d")
    var g=$(".g")
    //Cuando se selecciona un grupo de un docente entones este es deshabilitado para que no pueda quitar
    for(var i=0; i<d.length;i++){
      for(var j=0; j<g.length;j++){
        if(d[i].innerHTML==g[j].id){
        d[i].parentNode.disabled=true;
        }
      }
    }
  }
})
  }
  //-------------------------------------validaciones----------------------------------
var registrar =document.getElementById("botonRegistrar")
var errorg=document.getElementById("errorg");
var errorc=document.getElementById("errorc");
var errorm=document.getElementById("errorm");
var errorf=document.getElementById("errorf");
var valg=document.getElementById("lista_grupos");
var valc=document.getElementById("cantidad");
var valm=document.getElementById("motivo");
var valf=document.getElementById("fecha");
var fechaf=document.getElementById("fechaf")
var duracion=document.getElementById("duracion")
var horario=document.getElementById("horario")
//--------------------Cambiar hora de finalizacion de reserva-------------------------------
function cambiarHora(){
  var modificador=fechaf.value.split(":")
  var entrada=horario.options[horario.selectedIndex].text.split(":")
  var fin=duracion.options[duracion.selectedIndex].text.split(":")
  var minutos=parseInt(entrada[1])+parseInt(fin[1])
  var hora=parseInt(entrada[0])+parseInt(fin[0])
  if(minutos>=60){
    minutos-=60
    hora+=1
  }
  fechaf.value=hora+":"+minutos
}
//Se cambia la hora de fin de reserva en caso de que la duracion cambie
duracion.addEventListener('change', (event) => {
  cambiarHora();
})
//Se cambia la hora de fin de reserva en caso de que la hoea de inicio cambie
horario.addEventListener('change', (event) => {
  if(horario.options[horario.selectedIndex].text == "20:15"){
    duracion.innerHTML="<option value='1:30'>1:30</option>"
  }else{duracion.innerHTML="<option value='1:30'>1:30</option><option value='3:00'>3:00</option>"}
  cambiarHora();
})
//------------------------
function vacio(texto){
  //Funcion que verifica si algun campo esta vacio
var alerta=true;
lineas=texto.split("\n")
for(var i=0; i<lineas.length;i++){
  if (/\w/.test(lineas[i])){
        alerta=false;
    }
}
return alerta
}
//----------------------------------------------------------------
registrar.onclick=function(event){
  //Se detiene el evento de enviar reserva para acer sus validaciones
  var formulario=document.getElementById("formulario")
  
  var alerta=0;
  errorg.innerHTML=""
  errorm.innerHTML=""
  errorc.innerHTML=""
  errorf.innerHTML=""
  //Verifica si se añadieron grupos
  if(valg.value==""){
    errorg.innerHTML="Debe añadir un grupo"
    alerta=1;
  }
  //Verifica si el motivo de reserva esta vacio
  if(vacio(valm.value)){
    errorm.innerHTML="Campo obligatorio"
    alerta=1
  }
  //Verifica si la cantidad de estudiantes solo tiene caracteres numericos
  if(valc.value.match('^[0-9]+$')==null){
    errorc.innerHTML="Solo se aceptan números"
    alerta=1;
  }
  //Verifica que la cantidad de estudiantes sea mayor a 0
  if(valc.value== "0"){
    errorc.innerHTML="La cantidad debe ser mayor a 0"
    alerta=1;
  }
  //Verifica que la cantidad de estudiantes no este vacia
  if(valc.value==""){
    errorc.innerHTML="Campo obligatorio"
    alerta=1
  }
  var fecha=new Date(valf.value);
  var hoy= new Date();
  // Verifica si la fecha de examen es mayor a la de hoy
  if(fecha.getTime()+86399999<hoy.getTime()){
    errorf.innerHTML="La fecha es  menor a la de hoy"
    alerta=1;
  }
  @foreach ($diasNoHabiles as $dia)
  //Verifica si el dia de reserva elegido sea uno valido para reservas
  if(fecha.getDay()=={{$dia->dias}}){
    errorf.innerHTML="El día elegido no es valido"
    alerta=1;
  }
  @endforeach
  //Verifica si es la fecha de reserva no esta vacia
  if(valf.value==""){
    errorf.innerHTML="Fecha no valida"
    alerta=1
  }
  //Verifica que todods los docentes añadidos tengan como minimo un grupo añadido
  var val_doc=listaD.value.split(",");
  var g=$(".g");
    for(var i=0; i<val_doc.length;i++){
      var esta=false;
      for(var j=0;j<g.length;j++){
        if(val_doc[i]==g[j].id){
          esta=true;
        }
      }
      if(esta==false){
        alerta=1 
        if(valg.value!=""){
          errorg.innerHTML="No puedes hacer una solicitud de docentes compartidos si no añades grupos de dichos docentes"
        }
        }
    }
  if(alerta==1){
    event.preventDefault();
  }
   
}
  //---------------------buscar docente----------------------
  function encontrarD(texto){
   
   var docs=document.getElementsByClassName("docs");
   var alerta=false;
   
   for(var i=0;i<docs.length;i++){
    
     
     if(texto== docs[i].innerHTML){
       alerta=true
     }
   }
   return alerta
 }
 // -------------------------buscar grupo
 function encontrarG(texto){
   
   var groups=document.getElementsByClassName("groups");
   var alerta=false;
   
   for(var i=0;i<groups.length;i++){
     
     
     if(texto== groups[i].innerHTML){
       alerta=true
     }
   }
   return alerta
 }
</script>
<script>
  //Para la cantidad de notificaciones nuevas se hace un retraso para que cargue correctamente
  setTimeout(() => {
  if("{{$not}}"!=0){
    var not= document.getElementById("cant_not")
    not.style.display="block";
  }
},50);
</script>
{{--Mensaje de actualizacion correctz--}}
@if (session('actualizar')=='ok')
  <script>localStorage.setItem('ruta',"")
  Swal.fire({
    position: 'center',
    icon: 'success',
    title: 'Reserva registrada exitosamente',
    showConfirmButton: false,
    timer: 1500
    })</script>
@endif
</html>