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
        <x-menu.funcionalidad
                :nombre="'Cambio de Horario'"
                :icono="'menu_book'"
                :ruta="'/cambioHorario'"
            />
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
            <p class="card-text">Con Aulapp ahora podrás administrar las solicitudes y asignaciones de reservas de aulas de la Facultad de Ciencias y Tecnologia de la Universidad Mayor de San Simón</p>
            <p class="card-text"><small class="text-muted">Aqui tienes las diferentes funciones que te ofrece Aulapp</small></p>
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
            <p class="card-text">Con Aulapp ahora podrás administrar las solicitudes y asignaciones de reservas de aulas de la Facultad de Ciencias y Tecnologia de la Universidad Mayor de San Simón</p>
            <p class="card-text"><small class="text-muted">Aqui tienes las diferentes funciones que te ofrece Aulapp</small></p>
          </div>
        </div>
      </div>
    </div>
    @endif
@endsection
<script>
  setTimeout(() => {
  if("{{$not}}"!=0){
    var not= document.getElementById("cant_not")
    not.style.display="block";
  }
},100);
</script>
</body>
</html>
