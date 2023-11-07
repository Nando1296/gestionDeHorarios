@extends('registrar')
@section('title', 'Docente')
@section('Titulo')
@section("editar","docenteEdit")
@section("registrar","docente")
@section("reporte","reporte_user_rol")
@section("eliminar","eliminar-docente")
<h3 > Administración de docentes</h3>
@endsection
@section('action')
action="{{route('docentes')}}"
@endsection
@section('TituloForm','Registrar docente')
@section('NombreCampo','Nombre')
@section('Name')
name="nombre"
@endsection
@section('value')
value="{{old('nombre')}}"
@endsection
@section('error1')
@if ($errors->has('nombre'))
      <span class="error text-danger" for="input1">{{ $errors->first('nombre') }}</span>
      @endif
      <br>
@endsection
@section('NombreCampo2','Apellido')
@section('Name2')
name="apellido"
@endsection

@section('value2')
value="{{old('apellido')}}"
@endsection
@section('error2')
@if ($errors->has('apellido'))
      <span class="error text-danger" for="input2"> {{ $errors->first('apellido') }}</span>
      @endif
      <br>
@endsection
@section('campos')
    <label for="input3" class="form-label">CI</label>
    <input type="text" id="input3" class="form-control" name='ci' value="{{old('ci')}}"   autofocus>
    @if ($errors->has('ci'))
          <span class="error text-danger" for="input3"> {{ $errors->first('ci') }}</span>
          @endif
          <br>
    
    <label for="input4" class="form-label">Email</label>
    <input type="text" id="input4" class="form-control" name='email' value="{{old('email')}}"  autofocus>
    @if ($errors->has('email'))
          <span class="error text-danger" for="input4"> {{ $errors->first('email') }}</span>
    @endif

@endsection
