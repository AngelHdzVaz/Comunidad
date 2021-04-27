<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;

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
  dd(\Hash::make('Master'));
  //dd($colaborador_correos, $colaborador_telefonos);
});

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/verPreregistro',[UsuariosController::class, 'verPreregistro'])->name('VerPreregistro');
Route::post('/rPreregistro',[UsuariosController::class, 'realizarPreRegistro'])->name('RealizarPreRegistro');
