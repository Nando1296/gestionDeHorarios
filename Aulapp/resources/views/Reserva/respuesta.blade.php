<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
  <link rel="stylesheet" href="{{asset('css/plantilla.css')}}" />
  <link rel="stylesheet" href="{{asset('css/editar.css')}}" />
  <link rel="stylesheet" href="{{asset('css/bandeja.css')}}" />
  <title>@yield('title')</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Gruppo&family=Poppins:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet"
    href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>


  <header>
    <nav class="navbar navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><span id="Nlogo">Aulapp</span><img src="{{asset('Imagenes/logo.jpeg')}}"
            width="50" id="logo"></a>
        <h3>Responder a solicitud</h3>
        <form class="d-flex">
          <div class="navbar-brand " style="padding-left:5%" href="/">
            <a href="/respuestaAdmin">
              <span class="material-symbols-outlined">
                arrow_back
              </span>
            </a>
          </div>
        </form>
      </div>
    </nav>
  </header>
  <div id="Container" class="container-fluid">

    <div id="tipos">
      <span class="tipo_m"><b>Docentes:</b> {{$reserva->docentes }}</span>
      <span class="tipo_m"><b>Motivo:</b>{{$reserva->motivo }}</span>
      <span class="tipo_m"><b>Fecha:</b> {{$reserva->fecha_examen }}</span>
      <span class="tipo_m"> <b>Hora de inicio:</b> {{$reserva->hora_inicio }}</span>
      <span class="tipo_m"> <b>Hora de finalizacion:</b> {{$reserva->hora_fin }}</span>
      <button class="btn btn-dark" id="btn_aceptar">Aceptar</button>
      <button class="btn btn-dark" id="btn_rechazar">Rechazar</button>

    </div>
    <div id="aceptado">
      <h5 id="ocultar">Seleccione las aulas necesarias para la reserva de: <b>{{$reserva->cantE}}</b> estudiantes</h5>
      <h5 id="ocultar1">Capacidad asignada</h5>
      @php
      use App\Models\Seccion;
      $sections=Seccion::all();
      use App\Models\Aula;
      $aulas=Aula::all();
      use App\Models\AulaAsignada;
      $aulas_asignadas=AulaAsignada::all();


      @endphp

      <h2 id="mostrar">No hay aulas disponibles en este momento</h2>
      <div class="accordion accordion-flush" id="accordionFlushExample">
        @foreach ($sections as $section)
        @if($section->estado==1)
        <div id="seccion-{{$section->id}}" class="accordion-item">

          <h2 class="accordion-header" id="flush-headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#flush-{{$section->id}}" aria-expanded="false" aria-controls="flush-{{$section->id}}">
              {{$section->nombre}}
            </button>
          </h2>
          <div id="flush-{{$section->id}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              @foreach ($aulas as $aula )
              @if ($aula->section_id==$section->id && $aula->estado==1)
              <div id="{{$aula->id}}" class="check"><input class="form-check-input aula" type="checkbox" value=0>
                <span>{{$aula->nombre}}</span><span> </span><span>{{$aula->capacidad}}</span>
              </div>
              @endif
              @endforeach
              <form action="{{route('responder', ['id'=>$reserva->id, 'estado'=>1])}}" method="post" class="aceptados">
                @csrf
                <input type="text" name="aulas_capacidad" class="form-control aulas oculto" value=0>
                <input type="text" name="aulas_nombres" class="form-control aulas oculto" value="">
                <button class="btn enviar" disabled type="submit">Enviar</button>
              </form>
            </div>
          </div>
        </div>
        @endif
        @endforeach
      </div>

    </div>
    <div id="rechazado">
      <form action="{{route('responder', ['id'=>$reserva->id, 'estado'=>0])}}" method="post">
        @csrf
        <h3>Motivo de rechazo</h3>
        <textarea name="motivo_rechazo" id="motivo_rechazo" cols="60" rows="8"></textarea><br>
        @if ($errors->has("motivo_rechazo"))
        <span class="error text-danger" for="motivo_rechazo" id="error_mr">{{ $errors->first("motivo_rechazo") }}</span>
        @endif
        <button class="btn btn-dark enviar" id="btn_rechazo">Enviar</button>
      </form>

    </div>
    <footer>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      var cantidad = {{$reserva->cantE}};  
      var secciones_disponibles=0;
              @foreach ($sections as $section)
              @if($section->estado==1)
             var seccion = document.getElementById('seccion-{{$section->id}}');
              var suma = 0;
              //console.log('{{$section->nombre}}');
              @foreach ($aulas as $aula)
              @if ($aula->estado==1)
                var aula = document.getElementById('{{$aula->id}}');
                if ('{{$aula->section_id}}'=='{{$section->id}}'){
                  @if($aulasAsignadas->isEmpty())
                  suma = suma + {{$aula->capacidad}};
                  @else
                @foreach ($aulasAsignadas as $aulaAsignada)
                
                  @if($aula->id==$aulaAsignada->aula_id && $aulaAsignada->reserva->fecha_examen== $reserva->fecha_examen && ($aulaAsignada->reserva->hora_inicio < $reserva->hora_fin) && ($aulaAsignada->reserva->hora_fin > $reserva->hora_inicio  ) )
                  
                    aula.style.display = 'none';
                    suma = suma - {{$aula->capacidad}};  
                                   
                  @endif
                  
                @endforeach
                suma = suma + {{$aula->capacidad}};                
                @endif
                }
              @endif            
              @endforeach
                console.log(suma);
                
                if(suma<cantidad){
                  seccion.style.display = 'none';
                }else{
                  secciones_disponibles++;
                }
                
              @endif             
              @endforeach
              
              if(secciones_disponibles>0){
                document.getElementById('ocultar').style.display = 'block';
                document.getElementById('ocultar1').style.display = 'block';
                document.getElementById('mostrar').style.display = 'none';
              }else{
                ocultar.style.display = 'none';
                document.getElementById('mostrar').style.display = 'block';
                document.getElementById('ocultar1').style.display = 'none';
                document.getElementById('ocultar').style.display = 'none';

              }
    </script>



    <script>
      var btn_aceptar=document.getElementById("btn_aceptar")
      var btn_rechazar=document.getElementById("btn_rechazar")
      var btn_cancelar=document.getElementById("btn_cancelar")
      var aceptado=document.getElementById("aceptado")
      var rechazado=document.getElementById("rechazado")
      rechazado.style.display="none"
      //Mostrar las secciones que contienen las aulas para hacer reserva
      btn_aceptar.onclick=function(){
      rechazado.style.display="none"
      aceptado.style.display="block"
      }
      //Mostrar el campo de texto para el motivo de rechazo
      btn_rechazar.onclick=function(){

      rechazado.style.display="block"
      aceptado.style.display="none"
      }
      //-----------mostrar mensaje de error de motivo rechazo vacio
      var error_mr=document.getElementById("error_mr")
      if(error_mr != null){
        rechazado.style.display="block"
        aceptado.style.display="none"
      }
    </script>
    <script>
      //-------------elegir aulas---------------------------
      $(".aula").change(function(){
        var nombre_aula=$(this).parent().find("span")[0].innerHTML;
        var capacidad_aula=parseInt($(this).parent().find("span")[2].innerHTML);
        var inputs= $(this).parent().parent().find(".aulas")
        var aulas=inputs[1].value.split(",");
        var alerta=false;
        inputs[1].value=""
        //Colocar las aulas que fueron elegidas
        for(var i=0; i<aulas.length; i++){
          if(nombre_aula == aulas[i]){
            alerta=true;
            inputs[0].value=parseInt(inputs[0].value)-capacidad_aula;
            //En caso que el aula seleccionada ya fue elegida entonces 
            $(this).val("0")
          }else{
            //llenado de lista de aulas
            if(inputs[1].value == ""){
              inputs[1].value = aulas[i];
            }else{inputs[1].value +=","+aulas[i];}
          }
        }
        //En caso de que el aula 
        if(alerta==false){
          $(this).val("1")
          inputs[0].value=parseInt(inputs[0].value)+capacidad_aula
          if(inputs[1].value == ""){
              inputs[1].value = nombre_aula;
            }else{inputs[1].value +=","+nombre_aula}
        }
        var btn_enviar=$(this).parent().parent().find("button");
        //cuando la reserva es satisfecha se habilita el boton enviar
        if(parseInt(inputs[0].value)>= {{$reserva->cantE}}){
          btn_enviar[0].disabled=false;
          //deshabilita los checks ya cumple con la cantidad
          var checks=$(this).parent().parent().find(".check").find("input")
          for(var i=0 ;i<checks.length;i++){
            checks[i].disabled=true;
          }
        }else{
          //Si no cumple entonces el boton enviar se deshabilita
          btn_enviar[0].disabled=true
          //los check son habilitados
          var checks=$(this).parent().parent().find(".check").find("input")
          for(var i=0 ;i<checks.length;i++){
            checks[i].disabled=false;
          }
        }
        //El ultimo check que es usado para completar la cantidad siempre estara habilitado
        $(this).parent().find("input")[0].disabled=false;
      })
      
    </script>
    <script>
      //Se detiene el evento de enviar respuesta y se verifica si hay aulas innecesarias seleccionadas
      $('.aceptados').submit(function(e){
            e.preventDefault();
            var alerta=0;
            var total=parseInt($(this).parent().find(".aulas")[0].value)
            aulas_s=$(this).parent().find(".check");
                for(var i=0; i<aulas_s.length;i++){
                  if($(aulas_s[i]).find("input").attr("value")==1){
                    if(total - parseInt($(aulas_s[i]).find("span")[2].innerHTML)>={{$reserva->cantE}}){
                      alerta=1;
                    }
                  }
                }
            if(alerta==1){
              Swal.fire({
            title: 'Hay aulas que estas ocupando innecesariamente, ¿Seguro que quiere continuar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí',
            cancelButtonText: 'No'
            }).then((result) => {
                  if (result.isConfirmed) {
                  this.submit();
            }
            })
            }else{this.submit();}
      });
    </script>
</body>

</html>