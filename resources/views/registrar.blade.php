@extends('plantilla')

@section('Contenido formulario')

<div class="row" >

  <div class="d-flex" id="formularioEditar">
    <form id="formulario" method="post" @yield('action')>

      <h3 text-center>@yield('TituloForm')</h3>
      @csrf
      <label for="input1" class="form-label">@yield('NombreCampo')</label>
      <input type="text" id="input1" class="form-control" @yield('Name') 
      @yield('value') autofocus>
      @yield('error1')
      <label for="input2" class="form-label">@yield('NombreCampo2')</label>
      <input type="text" id="input2" class="form-control" @yield('Name2') 
      @yield('value2') autofocus>
      @yield('error2')
      @yield('campos')
      <div>
      
        <button style = "width:150px" class="btn btn-dark btn-block btn-lg" id="botonRegistrar" type="submit">Registrar</button>
        
      </div>

    </form>

  </div>
  
@endsection

@section('js')
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
@if (session('actualizar')=='ok')

<script>
    
  Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'Cambios guardados exitosamente',
  showConfirmButton: false,
  timer: 1500
  })
</script>


@endif
@if (session('eliminar')=='ok')
<script>
  Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'Carrera eliminado',
  showConfirmButton: false,
  timer: 1500
  })
</script>

@endif


@endsection