@extends('plantilla2')


<header>
  <nav class="navbar navbar-light bg-light">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><span id="Nlogo">Aulapp</span><img id="logo"
          src="{{asset('Imagenes/logo.jpeg')}}" width="50" id="logo"></a>

      <form class="d-flex m-0">
        <a href="#" class="material-symbols-outlined" id="menu">menu</a>
        <a class="nav-link active" aria-current="page" href="{{url('menu')}}">Inicio</a>
      </form>
    </div>
  </nav>
</header>
@section('Contenido formulario')

<div class="d-flex justify-content-center" id="formulario">
  <div class="d-flex" id="formularioEditar">
        <form action="{{ route('CambiarContraseña') }}" method="POST"id="formulario">
        <h3>Cambiar Contraseña</h3>
            @csrf
            <div >
                
                <div >  
                <label for="oldPasswordInput" class="form-label">Contraseña actual</label>              
                    <input class="form-control"name="old_password" type="password" 
                    id="oldPasswordInput" value="{{old('old_password')}}" >
                
                    @error('old_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                      
                </div>

                <label for="newPasswordInput" class="form-label">Nueva contraseña</label>
                <div class="input-group">   
                    <input class="form-control" name="new_password" type="password" 
                    id="newPasswordInput"value="{{old('new_password')}}">
                    <div class="input-group-append">
                      <button id="show_password2" class="btn btn-secondary" type="button" onclick="mostrarPassword2()"> <span class="fa fa-eye-slash icon" id="icon1"></span> </button>
                    </div> 
                    @error('new_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <label for="confirmNewPasswordInput" class="form-label">Repetir contraseña</label>
                <div class="input-group">
                   <input class="form-control" name="new_password_confirmation" type="password"
                    id="confirmNewPasswordInput"value="{{old('new_password_confirmation')}}"> 
                    <div class="input-group-append">
                      <button id="show_password" class="btn btn-secondary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon" id="icon2"></span> </button>
                    </div> 
                    @error('new_password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <br>

                    <div class="d-flex justify-content-center">
                    <button class="btn btn-dark" type="submit" >Guardar</button>
                        <a href="/perfil" class="btn btn-dark"
                        type="button"style="margin-left: 10px">Cancelar</a>
                    </div>


        </form>
    </div>
</div>
@endsection
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('actualizar')=='ok')
<script>
  Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'Contraseña modificada correctamente',
  showConfirmButton: false,
  timer: 1500
  })
</script>
@endif

<script type="text/javascript">
function mostrarPassword(){
		var cambio = document.getElementById("confirmNewPasswordInput");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('#icon2').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}else{
			cambio.type = "password";
			$('#icon2').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	} 

</script>

<script type="text/javascript">
  function mostrarPassword2(){
		var cambio2 = document.getElementById("newPasswordInput");
		if(cambio2.type == "password"){
			cambio2.type = "text";
			$('#icon1').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}else{
			cambio2.type = "password";
			$('#icon1').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	} 

</script>



@endsection
