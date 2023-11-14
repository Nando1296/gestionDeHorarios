@extends('plantilla')
@section("editar","grupoEdit")
@section("registrar","grupos")
@section("reporte","reporte_grupo")
@section("eliminar","eliminar-grupo")
@section('Contenido formulario')
@section("Titulo")
<H3>
  Administración de grupos
</H3>
@endsection
<div class="row" >

  <div class="d-flex" id="formularioEditar">
    <form id="formulario" method="post" action='{{route('grupos')}}' class="Grupo">
      
      <h3 text-center class="titulo-form">Registrar grupos</h3>
      @csrf
      <!-- Materia -->
      <label for="input2" class="form-label">Materia</label>
      <select name="materia" id="materia" class="form-select">
        <option selected>Seleccione una materia</option>
        @foreach ($materias as $materia)
        <option value="{{$materia->id}}">{{$materia->Cod_materia}} - {{$materia->nombre_materia}}</option>
        @endforeach
      </select>
      @if ($errors->has("materia"))
        <span class="error text-danger" for="input1">{{ $errors->first("materia") }}</span>
        @endif
      <br>

      <!-- Nombre -->
      <label for="input1" class="form-label">Nombre</label>
      <br>
      <div class="row">
        <div class="col-3">
          <label>G :</label>
        </div>
        <div class="col">
          <input type="text" id="input1" class="form-control" name="nombre" value="{{old('nombre')}}" autofocus>
        </div>
      </div>
      @if ($errors->has("nombre"))
      <span class="error text-danger" for="input1">{{ $errors->first("nombre") }}</span>
      @endif
      <br>

      <!-- Carrera -->
      <label for="input2" class="form-label">Carrera</label>
      <select name="carrera" id="carrera" class="form-select">
        <option selected>Seleccione una carrera</option>
        @foreach ($carreras as $carrera)
            <option value="{{$carrera->id}}">{{$carrera->Nombre}}</option>
        @endforeach
      </select>
      @if ($errors->has("carrera"))
        <span class="error text-danger" for="input1">{{ $errors->first("carrera") }}</span>
        @endif
      <br>
      
    
      <script>
        var materia=document.getElementById("materia");   
        var todosMC=[]
        
        @foreach ($materia_carrera as $m_c )
            todosMC.push(['{{$m_c->materia->nombre_materia}}','{{$m_c->carrera->Nombre}}','{{$m_c->carrera->id}}']);
        @endforeach
        
        materia.addEventListener('change', (event) => {
                    
                   
                    var carreras=document.getElementById("carrera");
                    if(carreras.options[carreras.selectedIndex].text=="Seleccione una carrera"){
                     
                   
                    carreras.innerHTML="";
                    carreras.innerHTML="<option >Seleccione una carrera</option>";
                    var nombre_materia=materia.options[materia.selectedIndex].text;
                     nombre_materia=nombre_materia.split(' - ');
                     nombre_materia=nombre_materia[1];
                   for(var contC=0;contC<todosCM.length;contC++){
                     console.log(todosMC[contC][0]);
                     console.log(nombre_materia);
                      if( nombre_materia==todosMC[contC][0]){
                        
                          carreras.innerHTML+="<option value="+todosMC[contC][2]+">"+todosMC[contC][1]+"</option>"
                      }
                   }
                   if(materia.options[materia.selectedIndex].text=="Seleccione una materia"){
                    
                     @foreach ($carreras as $carrera)
                     carreras.innerHTML+="<option value={{$carrera->id}}>{{$carrera->Nombre}} </option>"
                    @endforeach
                    }
                   }
                  });
      </script>

      <script>
        var carrera=document.getElementById("carrera");   
        var todosCM=[]
        
        @foreach ($materia_carrera as $m_c )
            todosCM.push(['{{$m_c->carrera->Nombre}}','{{$m_c->materia->nombre_materia}}','{{$m_c->materia->id}}']);
        @endforeach
        
        carrera.addEventListener('change', (event) => {
                    
                   
                    var materias=document.getElementById("materia");
                    if(materias.options[materias.selectedIndex].text=="Seleccione una materia"){

                   
                    materias.innerHTML="";
                    materias.innerHTML="<option >Seleccione una materia</option>";
                   for(var contM=0;contM<todosCM.length;contM++){
                     
                      if( carrera.options[carrera.selectedIndex].text==todosCM[contM][0]){
                        
                          materias.innerHTML+="<option value="+todosCM[contM][2]+">"+todosCM[contM][1]+"</option>"
                      }
                   }
                   if(carrera.options[carrera.selectedIndex].text=="Seleccione una carrera"){
                    
                     @foreach ($materias as $materia)
                     materias.innerHTML+="<option value={{$materia->id}}>{{$materia->Cod_materia}} - {{$materia->nombre_materia}} </option>"
                    @endforeach
                    }
                   }
                  });
    </script>
    <div>
      
        <button style = "width:150px" class="btn btn-dark btn-block btn-lg" id="botonRegistrar" type="submit">Registrar</button>
        
      </div>

    </form>

  </div>
  
@endsection

@section('js')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  var carrera=document.getElementById("carrera");
  var materia=document.getElementById("materia");
  if(carrera.options[carrera.selectedIndex].text=="Seleccione una carrera" && materia.options[materia.selectedIndex].text!="Seleccione una materia"){
    $('.Grupo').submit(function(e){
            e.preventDefault();
            Swal.fire({
            title: 'No seleccionó ninguna carrera, por lo tanto el grupo será creado para la materia en todas las carreras que esten utilizando dicha materia ',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Continuar',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
                  if (result.isConfirmed) {
                  this.submit();
            }
            })
      });
  }
</script>

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
<script>
  var editar=document.getElementById("editar")
  editar.style.display="none"
</script>
@endsection