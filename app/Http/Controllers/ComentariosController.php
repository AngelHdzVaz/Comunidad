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
use App\Mail\PreregistroContactanos;
use App\Models\Preregistro as PreR ;
use App\Models\Empresas_empleado as EEmp;
use App\Models\Comentario as Com ;
use App\Models\Personas_correo as PCor ;
use App\Models\Publicacione as Pubc;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class ComentariosController extends Controller
{
  public function comentarNoticia(Request $request){
    try {

      $noticia = $request->noticia;
      $comentario  = $request->comentario;
      $autor = Auth::user()->pluck('uuid')->first();
      //validacion
      $fecha = Carbon::now()->toDateString();
    // dd($noticia,$comentario,$autor);
      DB::beginTransaction();
        Com::create([
           'id_noticia' => $noticia,
           'comentario_uuid'=> (string) Str::uuid(),
           'autor_comentario_uuid' => $autor,
           'fecha' => date_format(date_create($fecha),'Y-m-d'),
           'comentario' => $comentario,
         ]);
       DB::commit();

       return redirect()->back()->with([
         'titulo' => 'Actualización exitosa',
         'mensaje' => 'Comentario Realizado',
         'tipo' => 'success'
       ]);
     } catch (\Exception $e) {
       DB::rollback();
       return $e->getMessage();
     }
  }

  public function eliminarComentario(Request $request){

    try {
      $uuid_comentario = $request->uuid_comentario;
      $comentario = $request->comentario;
      $autor = $request->autor;
      $respuesta = $request->respuesta;
      //dd($uuid_comentario,$comentario,$autor,$respuesta);
      DB::beginTransaction();


      if($respuesta!=null){
        Com::where('comentario_padre_uuid',$respuesta)
          ->where('comentario_uuid',$uuid_comentario)
          ->where('autor_comentario_uuid',$autor)
          ->where('comentario',$comentario)
          ->delete();
      }else{
        Com::where('comentario_uuid',$uuid_comentario)
            ->where('comentario',$comentario)
            ->where('autor_comentario_uuid',$autor)
            ->delete();
      }

      DB::commit();
      return redirect()->back()->with([
        'titulo' => 'Comentario borrado exitosamente',
        'mensaje' => '',
        'tipo' => 'success'
        ]);
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }

}
