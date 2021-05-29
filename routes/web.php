<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\NoticiasController;
use App\Http\Controllers\ComentariosController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\ControllerEvent;

use Illuminate\Support\Str;

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

Route::get('/pruebas',function(){

  //whereHas condicion anonima default
  //$colaborador_telefonos = App\Models\Empresas_colaboradore::with('telefonos_Ecol')->where('id',$colaborador_id)->get();
  //$colaborador_correos = App\Models\Empresas_colaboradore::with('correos_ECol')->where('id',$colaborador_id)->get();
  //dd(\Hash::make('Master'));
  return (string) Str::uuid();
  //dd($colaborador_correos, $colaborador_telefonos);
});

Route::get('/', function () {
    return view('welcome');
})->name('welcome');



Route::get('/verPreregistro',[UsuariosController::class, 'verPreregistro'])->name('VerPreregistro');
Route::post('/rPreregistro',[UsuariosController::class, 'realizarPreRegistro'])->name('RealizarPreRegistro');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/ver_registro_empleado',[UsuariosController::class, 'verRegistroEmpleado'])->name('VerRegistroEmpleado');
Route::post('/registro_empleado', [UsuariosController::class, 'registrarEmpleado'])->name('RegistrarEmpleado');
Route::get('/listar_empleado',[UsuariosController::class, 'listarEmpleado'])->name('ListarEmpleado');
Route::get('/editar_empleado',[UsuariosController::class, 'verEditorEmpleado'])->name('VerEditorEmpleado');
Route::post('/editar_empleado', [UsuariosController::class, 'editorEmpleado'])->name('EditorEmpleado');
Route::get('/eliminarEmpleado',[UsuariosController::class,'eliminarEmpleado'])->name('EliminarEmpleado');


Route::get('/noticias',[NoticiasController::class, 'verNoticias'])->name('VerNoticias');
Route::get('/noticias/{mes}',[NoticiasController::class, 'verNoticiasMes'])->name('VerNoticiasMes');
Route::get('/verRegistroNoticia',[NoticiasController::class, 'verRegistroNoticia'])->name('VerRegistroNoticia');
Route::post('/registroNoticia',[NoticiasController::class,'registrarNoticia'])->name('RegistrarNoticia');
Route::post('/noticias/comentar_noticia',[ComentariosController::class,'comentarNoticia'])->name('ComentarNoticia');
Route::post('/noticias/eliminar_comentario',[ComentariosController::class,'eliminarComentario'])->name('EliminarComentario');
Route::post('/noticias/responder_comentario',[ComentariosController::class,'responderComentario'])->name('ResponderComentario');
Route::get('/noticias/traducir_comentario',[ComentariosController::class,'traducirComentario'])->name('TraducirComentario');


Route::get('/cumpleanios',[NoticiasController::class,'cumpleanios'])->name('Cumpleanios');
Route::get('/eventos',[NoticiasController::class,'eventos'])->name('Eventos');
//Route::get('/calendario',[CalendarioController::class,'calendario'])->name('Calendario');
Route::get('/calendario/registrar',[CalendarioController::class,'calendarioVerRegistro'])->name('CalendarioVerRegistro');

Route::get('Evento/form',[ControllerEvent::class,'form']);
Route::post('Evento/create',[ControllerEvent::class,'create']);
Route::post('Evento/actualizar',[ControllerEvent::class,'actualizarEvento'])->name('ActualizarEvento');
Route::get('Evento/details/{id}',[ControllerEvent::class,'details']);
Route::get('Evento/index',[ControllerEvent::class,'index'])->name('Calendario');
Route::get('Evento/index/{month}',[ControllerEvent::class,'index_month'])->name('CalendarioMes');
Route::post('Evento/calendario',[ControllerEvent::class,'calendario']);
