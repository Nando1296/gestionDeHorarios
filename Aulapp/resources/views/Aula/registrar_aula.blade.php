@extends('registrar')
@section('title', 'Aula')
@section("editar","aulaEdit")
@section("registrar","aula")
@section("reporte","reporte_aula")
@section("eliminar","eliminar-aula")

@section('Titulo')
<h3 text-center  id="Titulo"> Administración de aulas</h3>
@endsection
@section('action')
action="{{route('aulas')}}"
@endsection
@section('TituloForm','Registrar aula')
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
@section('NombreCampo2','Capacidad')
@section('Name2')
name="capacidad"
@endsection

@section('value2')
value="{{old('capacidad')}}"
@endsection
@section('error2')
@if ($errors->has('capacidad'))
      <span class="error text-danger" for="input1"> {{ $errors->first('capacidad') }}</span>
      @endif
      <br>
@endsection
@section('campos')
<label for="input3" class="form-label">Sección</label>
<select class="form-select" name='seccion' id="input3">
 @foreach ($seccions as $seccion)
 
    <option value={{$seccion->id}}>{{$seccion->nombre}}</option>

@endforeach
  </select>
  @if ($errors->has('seccion'))
      <span class="error text-danger" for="input1">{{ $errors->first('seccion') }}</span>
      @endif
      <br>


     

@endsection