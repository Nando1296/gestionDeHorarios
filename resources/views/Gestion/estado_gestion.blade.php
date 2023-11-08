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
    <nav class="navbar navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><span id="Nlogo">Aulapp</span><img src="{{asset('Imagenes/logo.jpeg')}}" width="50" id="logo"></a>
        <h3>Estado de gestion</h3>
        
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
            <form method="GET" action="" id="formulario">
              
              @csrf
              <h3 text-center>Gestion actual</h3>
              <div id="gestion">

              </div>
              <input type="submit" value="Cambiar" class="btn btn-dark" id="cambiar">
              <input type="submit" value="Nuevo año" class="btn btn-dark" id="nuevo">
              <a class="btn btn-danger" id="btn_cancelar" href="/menu">Cancelar</a>
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
  <script>
    //Poniendo las gestiones
    var gestion =document.getElementById("gestion");
    //------------Buscar la gestion actual--------------
   var encontrado=""
   var id2=0;
    @foreach ($gestiones as $gestion )
    
      @if ($gestion->estado == 1)
      @php

        $id=$gestion->id;
        $año=intval(explode("/",$gestion->nombreG)[1])+1;
      @endphp
      encontrado="{{$gestion->nombreG}}".split("/")[1]
      id2='{{$gestion->id}}'
      @endif
    @endforeach
    //------------------Poner gestiones---------------------------------
    @foreach ($gestiones as $gestion )
       if("{{$gestion->nombreG}}".split("/")[1] == encontrado){
        if("{{$gestion->estado}}"== 1){
          gestion.innerHTML+="<spam class='btn btn-dark' id='{{$gestion->id}}'>{{$gestion->nombreG}}</spam><br><br>"
        }else{
          gestion.innerHTML+="<spam class='btn btn-outline-dark' id='{{$gestion->id}}'>{{$gestion->nombreG}}</spam><br><br>"
        }
       }
      @endforeach
    //---------------------------Evento de cambio de gestion------
    var botones=document.getElementsByTagName("spam")
    gestion.onclick=function(a){
      var f =a.target;
      for(var i=0; i<botones.length; i++){
        if(f==botones[i]){
          botones[i].className="btn btn-dark"
          id2=botones[i].id
          console.log(id2);
        }else{botones[i].className="btn btn-outline-dark"}
      }
    }
    //--------------------------------boton cambiar gestion-------------------
    var cambiar=document.getElementById("cambiar")
    var formulario=document.getElementById("formulario")
    cambiar.onclick=function(e){
      e.preventDefault();

      window.location.href="/gestion/{{$id}}/"+id2+"/0";

    }
    //---------------------------------boton cambiar de año---------------
    var nuevo=document.getElementById("nuevo")
    nuevo.onclick=function(e){
      e.preventDefault();
      window.location.href="/gestion/{{$año}}/{{$id}}/1"
      
    }
  </script>
  <script>
    //-Se necesita un temporizador para recuperar la cantidad de notinicaciones para la bandeja

  var inicio = document.getElementById("inicio")
  inicio.style.display="block"
  </script>
</html>