<?php

use App\Http\Controllers\AsignacionDocenteController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarrerasController;
use App\Http\Controllers\gestionController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\MateriaCarreraController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\reservaController;
use App\Http\Controllers\respuestasController;
use App\Http\Controllers\SeccionController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

/*Route::get('/pass-generate', function () {
return bcrypt('papaya');
});
Route::get('/menu_adm', function () {
return view('menu_administrador');
});

Route::get('/menu_docente', function () {
return view('menu_docente');
});
/* Route::get('/bandeja_administrador', function () {
return view('bandeja_administrador');
});*/

Route::middleware(['guest'])->group(function () {
 Route::get('/', function () {
  return view('Login.login');
 })->name('login');

 Route::post('login', [AuthController::class, 'authenticate']);
});

Route::middleware(['auth'])->group(function () {
Route::get('/menu', [MenuController::class, 'loadMenu']);
   


       //--------------------------------Rutas de eliminacion --------------------------------------------------------
       Route::get('/eliminar-seccion', [SeccionController::class, 'busqueda'])->name('eliminar-seccion');
       Route::get('/eliminar-aula', [AulaController::class, 'busqueda'])->name('eliminar-aula');
       Route::get('/eliminar-carrera', [CarrerasController::class, 'busqueda'])->name('eliminar-carrera');
       Route::get('/eliminar-materia', [MateriaController::class, 'busqueda'])->name('eliminar-materia');
       Route::get('/eliminar-materia-carrera', [MateriaCarreraController::class, 'busqueda'])->name('eliminar-materia-carrera');
       Route::get('/eliminar-grupo', [GrupoController::class, 'busqueda'])->name('eliminar-grupo');
       Route::get('/eliminar-asignacion-docente', [AsignacionDocenteController::class, 'busqueda'])->name('eliminar-asignacion-docente');
       Route::get('/eliminar-docente', [UsuarioController::class, 'busqueda'])->name('eliminar-docente');
       Route::delete('/eliminar-docente{usuario}', [UsuarioController::class, 'estado'])->name('docente-destroy');
       Route::delete('/grupo/{id}', [GrupoController::class, 'estado'])->name('grupos-destroy');
       Route::delete('/asignacionDocente/{asignacionDocente}', [AsignacionDocenteController::class, 'estado'])->name('asignacionDocente-destroy');
       Route::delete('/carrera/{carrera}', [CarrerasController::class, 'estado'])->name('carreras-destroy');
       Route::delete('/seccion/{section}', [SeccionController::class, 'estado'])->name('secciones-destroy');
       Route::delete('/aula/{id}', [AulaController::class, 'estado'])->name('aulas-destroy');
       Route::delete('/materia-carreras/{materiaCarrera}', [MateriaCarreraController::class, 'estado'])->name('materiasCarreras-destroy');
       Route::delete('/materia/{materia}', [MateriaController::class, 'estado'])->name('materias-destroy');
       
       //--------------------------------------------------------------------------------------------
       
       //--------------------Rutas de registro------------------------------------------
       Route::get('/carreras', [CarrerasController::class, 'vistaRegistro'])->name('carreras'); 
       Route::post('/carreras', [CarrerasController::class, 'registro'])->name('carreras');
       Route::get('/seccion', [SeccionController::class, 'vistaRegistro'])->name('secciones');
       Route::post('/seccion', [SeccionController::class, 'registro'])->name('secciones');
       Route::get('/aula', [AulaController::class, 'vistaRegistro'])->name('aulas');
       Route::post('/aula', [AulaController::class, 'registro'])->name('aulas');
       Route::get('/materias', [MateriaController::class, 'vistaRegistro'])->name('materias');
       Route::post('/materias', [MateriaController::class, 'registro'])->name('materias');
       Route::get('/grupos', [GrupoController::class, 'vistaRegistro'])->name('grupos');
       Route::post('/grupos', [GrupoController::class, 'registro'])->name('grupos');
       Route::get('/docente', [UsuarioController::class, 'vistaRegistro'])->name('docentes');
       Route::post('/docente', [UsuarioController::class, 'registro'])->name('docentes');
       Route::get('/materia_carrera', [MateriaCarreraController::class, 'vistaRegistro'])->name('materia_carrera');
       Route::post('/materia_carrera', [MateriaCarreraController::class, 'registro'])->name('materia_carrera');
       Route::get('/materia_docente', [AsignacionDocenteController::class, 'vistaRegistro'])->name('materia_docente');
       Route::post('/materia_docente', [AsignacionDocenteController::class, 'registro'])->name('materia_docente');
       Route::get('/reserva', [reservaController::class, 'vistaRegistro'])->name('registro_reserva');
       Route::post('/reserva', [reservaController::class, 'registro'])->name('reserva');
       //-----------------------------------------------------------------------------------
       
       //--------------------Rutas de reportes---------------------------------------------------
       
       Route::get('/reporte_carrera', 'App\Http\Controllers\CarrerasController@reporte');
       Route::get('/reporte_section', 'App\Http\Controllers\SeccionController@reporte');
       Route::get('/reporte_materia', 'App\Http\Controllers\MateriaController@reporte');
       Route::get('/reporte_aula', 'App\Http\Controllers\AulaController@reporte');
       Route::get('/reporte_grupo', 'App\Http\Controllers\GrupoController@reporte');
       Route::get('/reporte_user_rol', 'App\Http\Controllers\UserRolController@reporte');
       Route::get('/reporte_carrera_materia', 'App\Http\Controllers\MateriaCarreraController@reporte');
       Route::get('/reporte_asignacion_docente', 'App\Http\Controllers\AsignacionDocenteController@reporte');
       //--------------------------------------------------------------------------------------------------------

       //----------------------Rutas de edicion--------------------------------------------------
       Route::get('/carreraEdit', [CarrerasController::class, 'vistaEditar'])->name('carrera_edit');
       Route::get('/carrera/{id}', [CarrerasController::class, 'editar'])->name('carreras-update');
       Route::get('/materiaEdit', [MateriaController::class, 'vistaEditar'])->name('materia_edit');
       Route::get('/materia/{id}', [MateriaController::class, 'editar'])->name('materias-update');
       Route::get('/seccionEdit', [SeccionController::class, 'vistaEditar'])->name('seccion_edit');
       Route::get('/seccion/{id}', [SeccionController::class, 'editar'])->name('seccion-update');
       Route::get('/aulaEdit', [AulaController::class, 'vistaEditar'])->name('aulas_edit');
       Route::get('/aula/{id}', [AulaController::class, 'editar'])->name('aula-update');
       Route::get('/docenteEdit', [UsuarioController::class, 'vistaEditar'])->name('docentes_edit');
       Route::get('/docente/{id}', [UsuarioController::class, 'editar'])->name('docente-update');
       Route::get('/grupoEdit', [GrupoController::class, 'vistaEditar'])->name('grupo_edit');
       Route::get('/grupo/{id}', [GrupoController::class, 'editar'])->name('grupo-update');
       Route::post('/bandeja_administrador/{id}/{estado}', [reservaController::class, 'respuesta'])->name('responder');
       //------------------------------------------------------------------------------
       
       
       //-----------------------------------Bandeja del docente--------------------------------------------
      
          Route::get('/bandeja_docente', [respuestasController::class, 'verBandeja'])->name('bandeja_docente');

        //---------------------------------Detalle de mensaje-----------------------------------------
          Route::get('/respuestas/{tipo}/{id}', [respuestasController::class, 'respuestas'])->name('respuestas');
         //------------------------------------Bandeja de administrador----------------------------------------------

          Route::get('/respuestaAdmin', [reservaController::class, 'reportePeticiones'])->name('respuestaAdmin');
          Route::get('/respuesta/{id}', [reservaController::class, 'show'])->name('respuesta');
          
        //------------------------------Gestion-------------------------------------------------------------
          
          Route::get('/gestion', [gestionController::class, 'verEstado'])->name('estadogestion');
          Route::get('/gestion/{id}/{id2}/{tipo}', [gestionController::class, 'editar'])->name('gestion-update');
        
         //------------------------------Perfil y cambio de contraseña--------------------------------------------------------------------------
         Route::get('/perfil', [MenuController::class, 'loadPerfil']);
         Route::get('/CambiarContraseña',[AuthController::class, 'showEditPassword'])->name('CambiarContraseña');
         Route::post('/CambiarContraseña', [AuthController::class, 'updatePassword'])->name('CambiarContraseña');

Route::post('logout', [AuthController::class, 'logout']);
});

