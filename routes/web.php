<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\NoticiasController;
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



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/verPreregistro',[UsuariosController::class, 'verPreregistro'])->name('VerPreregistro');
Route::post('/rPreregistro',[UsuariosController::class, 'realizarPreRegistro'])->name('RealizarPreRegistro');
Auth::routes();
Route::get('/verRegistroEmpleado',[UsuariosController::class, 'verRegistroEmpleado'])->name('VerRegistroEmpleado');
Route::post('/RegistroEmpleado', [UsuariosController::class, 'registrarEmpleado'])->name('RegistrarEmpleado');
Route::get('/listarEmpleado',[UsuariosController::class, 'listarEmpleado'])->name('ListarEmpleado');
Route::get('/editarEmpleado',[UsuariosController::class, 'verEditorEmpleado'])->name('VerEditorEmpleado');
Route::post('/editarEmpleado', [UsuariosController::class, 'editorEmpleado'])->name('EditorEmpleado');

Route::get('/noticias',[NoticiasController::class, 'verNoticias'])->name('VerNoticias');
Route::get('/verRegistroNoticia',[NoticiasController::class, 'verRegistroNoticia'])->name('VerRegistroNoticia');
Route::post('/registroNoticia',[NoticiasController::class,'registrarNoticia'])->name('RegistrarNoticia');

Route::get('/cumpleanios',[NoticiasController::class,'cumpleanios'])->name('Cumpleanios');
Route::get('/calendario',[NoticiasController::class,'calendario'])->name('Calendario');
Route::get('/eventos',[NoticiasController::class,'eventos'])->name('Eventos');
