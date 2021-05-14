<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB; //base de datos
use Auth; //autentificacion
use Log; //archivo log
use Mail; //servicios de correo
use Ctt;
use App\Models\Empresas_empleado as EEmp;
use App\Models\Persona as Per ;
use App\Models\Usuario as Usua ;
use App\Models\Personas_correo as PCor ;
use App\Models\Publicacione as Pub;
use Carbon\Carbon;

class NoticiasController extends Controller
{
  public function verNoticias(Request $request){
    $hoy = Carbon::today()->toDateString();
    $month = Carbon::today()->format('M');

    $lista_noticias = Pub::orderBy('fecha_publicacion','desc')
      ->with('autor_pub:uuid,primer_nombre,apellido_paterno')
      ->where('activa',true)
      ->where('fecha_publicacion','<=',$hoy)
      ->get();
    return view('noticias',compact('lista_noticias'));
  }

  public function verRegistroNoticia(Request $request){
    return view('registro_noticia');
  }

  public function registrarNoticia(Request $request){
    try {
      $titulo = $request->titulo;
      $fecha = $request->fecha;
      $resumen = $request->resumen;
      $descripcion = $request->descripcion;
      $activo = $request->activo;
      $evento = $request->evento;
      $autor = Auth::user()->pluck('uuid')->first();
      //validacion
      DB::beginTransaction();
        Pub::create([
           //colocar uuid? para conectar todas tablas y vistas??
           'titulo' => $titulo,
           'fecha_publicacion' => date_format(date_create($fecha),'Y-m-d'),
           'resumen' => $resumen,
           'cuerpo' => $descripcion,
           'autor' => $autor,
           'activa' => $activo,
           'evento' => $evento
         ]);
       DB::commit();

       return redirect()->back()->with([
         'titulo' => 'Actualización exitosa',
         'mensaje' => 'Publicacion Realizada',
         'tipo' => 'success'
       ]);
     } catch (\Exception $e) {
       DB::rollback();
       return $e->getMessage();
     }
  }

  public function cumpleanios(){
    setlocale(LC_TIME, 'es_ES');
    $cumpleanios = DB::table('empresas_empleados')
      ->whereraw('month(fecha_nacimiento)=month(NOW())')
      ->get();
      //dd($cumpleanios);
    return view('cumpleanios',compact('cumpleanios'));
  }
  public function calendario(){

    return view('calendario');
  }
  public function eventos(){
    $hoy = Carbon::today()->toDateString();
    $lista_eventos = Pub::orderBy('fecha_publicacion','desc')
      ->with('autor_pub:uuid,primer_nombre,apellido_paterno')
      ->where('evento',true)
      ->where('fecha_publicacion','<=',$hoy)
      ->get();
    return view('eventos',compact('lista_eventos'));
  }
  public function getList() {
  return "Lista de todos los post por GET";
  }
  public function getPost($id) {
    return "Ver post, se pasa como parámetro la ID para buscarlo";
  }
  public function postSavepost() {
    return "Guardar post por POST";
  }
  public function getEditpost($id = null) {
    return "Editar Post, ID para saber cual es.";
  }
  public function getDeletepost($id) {
    return "Borrar Post, ID para saber cual es.";
  }

  public function postCreatecomment() {
    return "Crearmos el comentario";
  }
  public function getDeletecomment($id) {
      return "Borramos el comentario";
  }

}
