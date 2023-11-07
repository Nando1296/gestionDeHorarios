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
  <title>@yield('title')</title>
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
        @yield('Titulo')
        <a href="#" class="material-symbols-outlined" id="menu">menu</a>
        <form class="d-flex">
          <a class="nav-link active" aria-current="page" href="menu">Inicio</a>
          <a class="nav-link active" aria-current="page" href="@yield("registrar")">Registrar</a>
          <a class="nav-link active" aria-current="page" href="@yield("eliminar")">Eliminar</a>
          <a class="nav-link active" aria-current="page" href="@yield("reporte")">Ver reporte</a>
          
        </form>
      </div>
    </nav>
  </header>
  <div id="Container" class="container-fluid">

    @csrf
    <div class="row" >

        <div class="d-flex" id="formularioEditar">
          <form id="formulario" method="post" @yield('action')>
            @csrf
            
            @yield('Titulo form')
            @yield('Contenido formulario')
            <button style = "width:150px" class="btn btn-dark btn-block btn-lg" id="botonRegistrar" type="submit">Registrar</button>
          </form>
        </div>
    </div>

  </div>
  <footer>
  </footer>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  @yield('js')
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('registrar')=='ok')
<script>
  Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'Registro exitoso',
  showConfirmButton: false,
  timer: 1500
  })
</script>
@endif
<script>
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

</html>