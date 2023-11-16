@extends('header')
@section('Contenido')
<form action=""id="">
    <div class="d-flex justify-content-center">
    <div class="container bootstrap snippets bootdey">
        <div class="col-md-8">
            <div class="panel panel-white profile-widget panel-shadow">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="details">
                            <div class="card mb-3" style="max-width: 540px;" id="presentacion1">
                                <div class="row g-0">
                                    @if ($usuario->id == 1)
                                        <div class="col-md-6">
                                        <img src="{{asset('Imagenes/admi.svg')}}" class="img-fluid rounded-start" alt="..." id="doc">
                                        </div>
                                    @else
                                        <div class="col-md-6">
                                        <img src="{{asset('Imagenes/docente.svg')}}" class="img-fluid rounded-start" alt="..." id="doc">
                                        </div>
                                    @endif
                                    <div class="col-md-6">
                                        <div class="card-body">
                                                <h4>{{$usuario->Nombre}} {{$usuario->Apellido}}<i class="fa fa-sheild"></i></h4>
                                                
                                                <p class="card-text">Código Sis: {{$usuario->CI}}</p>
                                                <div class="mg-top-10">
                                                <a  class="btn btn-dark"  href="{{ route('CambiarContraseña',['id'=>$usuario->id])}}">Cambiar contraseña</a>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    </div>    
</form>  
<script>
var cam=document.getElementById("campana");
cam.style.display="none" 
</script>                              
@endsection

