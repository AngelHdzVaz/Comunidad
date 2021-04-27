<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; //base de datos
use Auth; //autentificacion
use Log; //archivo log
use Mail; //servicios de correo
use Ctt;
use App\Mail\PreregistroContactanos;
use App\Models\Preregistro as PreR ;

class UsuariosController extends Controller
{

  public function verPreregistro(){
      return view('preregistro');
  }

  public function loginUsuario(Request $request){
    try {

      $email = $request->email;
      $password = $request->password;
      Log::debug('1');
      if(!$email){
        return redirect()->back()->with([
          'titulo' => 'Verifica el campo correo',
          'mensaje' => 'El valor recibido no se encuentra en los registros',
          'tipo' => 'error'
        ]);
        }
          Log::debug('2');
      if(!$password){
        return redirect()->back()->with([
          'titulo' => 'Verifica el campo contraseña',
          'mensaje' => 'El campo no debe estar vacio',
          'tipo' => 'error'
        ]);
        }

          Log::debug('3');
        $credencial = ['email' => $email, 'password' => $password];
        $remember = 'off';

        if(Auth::attempt($credencial)) {
            Log::debug('3.1');
          return redirect()->route('Home');
        } else {
            Log::debug('3.2');
          return redirect()->back()->with([
            'titulo' => 'Verifica los datos de inicio de sesión',
            'mensaje' => ' ',
            'tipo' => 'error'
          ]);

        }
          Log::debug('4');

    } catch (\Exception $e) {
      Log::debug('UsuariosController@loginUsuario'.$e->getMessage());
      return null;
      //return view('errorInterno'); hacer vista
    }
  }


  public function realizarPreRegistro(Request $request){
    try {
      $nombre = $request->nombre;
      $correo = $request->correo;
      $telefono = $request->telefono;
      $extension = $request->extension;
      $mensaje = $request->mensaje;
      Log::debug('1');

      $existecorreo = PreR::select('id')->where('correo',$correo)->first();
        Log::debug('2');
      if($existecorreo!=null){
        return redirect()->back()->with([
          'titulo' => 'Correo no aceptado',
          'mensaje' => 'El correo ya ha sido registrado',
          'tipo' => 'error'
        ]);
        }

        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
          return redirect()->back()->with([
            'titulo' => 'Verifica el campo Correo',
            'mensaje' => 'El valor que ingresaste no es válido',
            'tipo' => 'error'
          ]);
        }

        if (!is_numeric($telefono) ){
          return redirect()->back()->with([
            'titulo' => 'Verifica el campo Telefono',
            'mensaje' => 'El valor que ingresaste no es válido',
            'tipo' => 'error'
          ]);
        }
          Log::debug('3');
      DB::beginTransaction();
      PreR::create([
        'nombre' => $nombre,
        'correo' => $correo,
        'telefono' =>$telefono,
        'extension' =>$extension,
        'mensaje' =>$mensaje
      ]);
      DB::commit();
      Mail::to(Ctt::Correosoporte)->send(new PreregistroContactanos(
        $nombre, $correo, $mensaje, $telefono,$extension
      ));
        Log::debug('4');
      return redirect()->back()->with([
        'titulo' => 'Todo listo',
        'mensaje' => 'Nos pondremos en contacto lo más pronto posible',
        'tipo' => 'success'
      ]);
    } catch (\Exception $e) {
      DB::rollback();
      return $e->getMessage();
    }
  }

}
