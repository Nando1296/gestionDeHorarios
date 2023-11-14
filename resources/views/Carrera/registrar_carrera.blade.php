@extends('registrar')
@section('title', 'Carrera')
@section("editar","carreraEdit")
@section("registrar","carreras")
@section("reporte","reporte_carrera")
@section("eliminar","eliminar-carrera")
@section('Titulo')
<h3 text-center > Administración de carreras</h3>
@endsection
@section('action')
action="{{route('carreras')}}"
@endsection
@section('TituloForm','Registrar carrera')
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
@section('NombreCampo2','Codigo')
@section('Name2')
name="codigo"
@endsection
@section('value2')
value="{{old('codigo')}}"
@endsection
@section('error2')
@if ($errors->has('codigo'))
      <span class="error text-danger" for="input1"> {{ $errors->first('codigo') }}</span>
      @endif
      <br>
@endsection