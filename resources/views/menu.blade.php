@extends('header')
@section("cant_not")

<a  class=" position-relative" id="cant_not">
  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark">
    {{$not}}
  </span>
</a>

@endsection

@section('Titulo')
    <h3>Menú de {{ $rol->nombre }}</h3>
@endsection
@section('Contenido')
    </div>
    <div id="funcionalidades">
        @foreach($privilegios as $privilegio)
            <x-menu.funcionalidad
                :nombre="$privilegio->funcionalidad->nombre"
                :icono="$privilegio->funcionalidad->icono"
                :ruta="$privilegio->funcionalidad->ruta"
            />
        @endforeach
        @if (auth()->user()->user_rol[0]->rol->nombre=="administrador")
          <x-menu.funcionalidad
          :nombre="'Cambio de Horario'"
          :icono="'Description'"
          :ruta="'/cambioHorario'"
          />

          <x-menu.funcionalidad
              :nombre="'Gestiones'"
              :icono="'Calendar_Today'"
              :ruta="'/gestion'"
          />

          <x-menu.funcionalidad
              :nombre="'Horarios'"
              :icono="'Calendar_Today'"
              :ruta="'/horarios'"
          />
        @endif

        @if(auth()->user()->user_rol[0]->rol->nombre=="docente")
          <x-menu.funcionalidad
          :nombre="'Materias'"
          :icono="'menu_book'"
          :ruta="'/materiasDocente'"
          /> 

          <x-menu.funcionalidad
          :nombre="'Cambio de Horario'"
          :icono="'Description'"
          :ruta="'/cambioHorarioDocente'"
          />

        @endif
       
    </div>
    @if ($rol->id == 1)
    <div class="card mb-3" style="max-width: 540px;" id="presentacion">
      <div class="row g-0">
        <div class="col-md-6">
          <img src="{{asset('Imagenes/admi.svg')}}" class="img-fluid rounded-start" alt="..." id="admi">
        </div>
        <div class="col-md-6">
          <div class="card-body">
            <h5 class="card-title">{{ $rol->nombre }}</h5>
            <p class="card-text">Ahora podrás administrar las solicitudes de cambios de horario de la Facultad de Ciencias y Tecnologia de la Universidad Mayor de San Simón</p>
            <p class="card-text"><small class="text-muted">Aqui tienes las diferentes funciones que te ofrece el sistema</small></p>
          </div>
        </div>
      </div>
    </div>
    @else
    <div class="card mb-3" style="max-width: 540px;" id="presentacion">
      <div class="row g-0">
        <div class="col-md-6">
          <img src="{{asset('Imagenes/docente.svg')}}" class="img-fluid rounded-start" alt="..." id="doc">
        </div>
        <div class="col-md-6">
          <div class="card-body">
            <h5 class="card-title">{{ $rol->nombre }}</h5>
            <p class="card-text">Ahora podrás realizar tus formularios de modificacion de horarios de la Facultad de Ciencias y Tecnologia de la Universidad Mayor de San Simón</p>
            <p class="card-text"><small class="text-muted">Aqui tienes las diferentes funciones que te ofrece el sistema</small></p>
          </div>
        </div>
      </div>
    </div>
    @endif
@endsection
<script>

</script>
</body>
</html>
