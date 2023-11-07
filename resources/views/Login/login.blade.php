@extends("header")
@section("Contenido")
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />

<!-- font awesome  -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />

<div class="container-fluid">
  <div class="row d-flex justify-content-center align-items-center m-0" style="height: 100vh;">
    <div  class="d-flex" id="formularioEditar">

      <form method="POST" action="/login" id="formulario">
      @csrf
      <h3 text-center>Iniciar sesión</h3>
        <div class="form-row">    
          <div class="col-12">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
              </div>
              <input name="usuario" type="text" class="form-control" id="username" placeholder="Usuario"  
              autofocus value="{{old('usuario')}}"/>
            </div>
            @if ($errors->has('usuario'))
               <span class="error text-danger" for="input-usuario">{{ $errors->first('usuario') }}</span>
            @endif  
            <br>        
          </div>
          
          <div class="col-12">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
              </div>
                <input name="contrasenia" type="password" class="form-control" id="password" placeholder="Contraseña"  
                value="{{old('contrasenia')}}" />
                <div class="input-group-append">
                  <span class="input-group-text" onclick="password_show_hide();">
                    <i class="fas fa-eye d-none" id="show_eye"></i>
                    <i class="fas fa-eye-slash " id="hide_eye"></i>
                  </span>
                </div>
            </div>
            @if ($errors->has('contrasenia'))
                <span class="error text-danger" for="password">{{ $errors->first('contrasenia') }}</span>
            @endif
          </div>


          <div class="col-12">
            <button class="btn btn-dark btn-block btn-lg ed" id="acceder" type="submit">
                Acceder
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
      var inicio=document.getElementById("inicio");
      inicio.href="/"
      var perfil=document.getElementById("perfil");
      perfil.style.display="none"

     var campana=document.getElementById("campana");
     campana.style.display="none"
    /* var not=document.getElementById("cant_not");
     not.style.display="none";*/
</script>
<script>
/*.login_oueter {
    width: 360px;
    max-width: 100%;
}
.logo_outer{
    text-align: center;
}
.logo_outer img{
    width:120px;
    margin-bottom: 40px;
}*/
</script>
<script>
function password_show_hide() {
  var x = document.getElementById("password");
  var hide_eye = document.getElementById("hide_eye");
  var show_eye = document.getElementById("show_eye");
  
  show_eye.classList.remove("d-none");
  if (x.type === "password") {
    x.type = "text";
    show_eye.style.display = "block";
    hide_eye.style.display = "none";

    
  } else {
    x.type = "password";
    show_eye.style.display = "none";
    hide_eye.style.display = "block";
  }
}
</script>
@endsection
