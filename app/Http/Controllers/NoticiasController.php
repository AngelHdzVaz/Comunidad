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
use Jenssegers\Date\Date;
use Illuminate\Pagination\LengthAwarePaginator;

class NoticiasController extends Controller
{

  public function paginacion($array, $request, $perPage) {
    $page = $request->input('page', 1);
    $offset = ($page * $perPage) - $perPage;

    return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
        ['path' => $request->url(), 'query' => $request->query()]);
  }

  public function verNoticias(Request $request){
    $hoy = Carbon::today()->toDateString();

    $lista_noticias = Pub::with('autor_pub:uuid,primer_nombre,apellido_paterno')
      ->where('activa',true)
      ->where('fecha_publicacion','<=',$hoy)
      ->orderBy('fecha_publicacion','desc')
      ->get();
    $lista_noticias = $this->paginacion($lista_noticias->all(), $request,6);
    setlocale(LC_ALL, 'es');
    return view('noticias',compact('lista_noticias'));
  }

  public function verNoticiasMes(Request $request){
    $mes = $request->mes;
    $lista_noticias = Pub::with('autor_pub:uuid,primer_nombre,apellido_paterno')
      ->where('activa',true)
      ->whereMonth('fecha_publicacion','=',$mes)
      ->orderBy('fecha_publicacion','desc')
      ->get();
    $lista_noticias = $this->paginacion($lista_noticias->all(), $request,6);
    $actual = null;
    $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    for($i = 1; $i <= count($meses); ++$i){
      if($mes==$i){
        $actual = $meses[$i-1];
      }
    }
    setlocale(LC_ALL, 'es');
    return view('lista_noticias_mes',compact('lista_noticias','actual'));
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
    $cumpleanios = DB::table('empresas_empleados')
      ->where('fecha_nacimiento','!=',null)
      ->whereraw('month(fecha_nacimiento)=month(NOW())')
      ->get();
      setlocale(LC_ALL, 'es');
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

}
