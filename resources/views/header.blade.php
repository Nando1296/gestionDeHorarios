<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="{{asset('css/formulario.css')}}" />
    <link rel="stylesheet" href="{{asset('css/plantilla.css')}}" />
    <link rel="stylesheet" href="{{asset('css/login.css')}}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gruppo&family=Poppins:wght@300&display=swap" rel="stylesheet">
    <title>Aulapp</title>
</head>
<body>
    <header>
        <header>
            <nav class="navbar navbar-light bg-light">
              <div class="container-fluid">
                <a class="navbar-brand" href="#"><span id="Nlogo">Aulapp</span><img src="{{asset('Imagenes/logo.jpeg')}}" width="50" id="logo"></a>
                @yield('Titulo')
                <div class="d-flex">
                  @yield("cant_not")
                  <a class="nav-link active" aria-current="page"href="/perfil" id="perfil">Perfil</a>
                  <a class="nav-link active" aria-current="page" href="/menu" id="inicio">Inicio</a>
                  
                    @if(\Illuminate\Support\Facades\Auth::check())
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit" class="nav-link" id="salir">Salir</button>
                        </form>
                    @endif
                </div>
              </div>
            </nav>
          </header>
    </header>
<div>
    @yield('Contenido')
</div>
</body>
</html>
