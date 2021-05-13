<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB; //base de datos
use Auth; //autentificacion
use Log; //archivo log
use Mail; //servicios de correo
use Ctt;
use App\Mail\PreregistroContactanos;
use App\Models\Preregistro as PreR ;
use App\Models\Empresas_empleado as EEmp;
use App\Models\Persona as Per ;
use App\Models\Usuario as Usua ;
use App\Models\Personas_correo as PCor ;
use Carbon\Carbon;


class UsuariosController extends Controller
{
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
        $remember = 'on';

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

  public function verPreregistro(){
      return view('preregistro');
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

  public function verRegistroEmpleado(){
      return view('registro_empleado');
  }

  public function registrarEmpleado(Request $request){
    try {
      $primer_nombre = $request->primer_nombre;
      $segundo_nombre = $request->segundo_nombre;
      $apellido_paterno = $request->apellido_paterno;
      $apellido_materno = $request->apellido_materno;
      $fecha_nacimiento = $request->fecha_nacimiento;
      $rfc = $request->rfc;
      $curp = $request->curp;
      $numero_seguro_social = $request->numero_seguro_social;
      $codigo_postal = $request->codigo_postal;
      $correo_empresa = $request->correo_empresa;
      $correo_personal =$request->correo_personal;
      $contrasenia =$request->contrasenia;

        //validacion
        if($primer_nombre){
          if (!ctype_alpha($primer_nombre)) {
            return redirect()->back()->with([
              'titulo' => 'Verifica el campo Nombre',
              'mensaje' => 'El valor recibido no contiene unicamente letras',
              'tipo' => 'error'
            ]);
          }
          }else{
          return redirect()->back()->with([
            'titulo' => 'Verifica el campo Primer Nombre',
            'mensaje' => 'El campo esta vacío',
            'tipo' => 'error'
          ]);
        }

        if($segundo_nombre){
          if (!ctype_alpha($segundo_nombre)) {
            return redirect()->back()->with([
              'titulo' => 'Verifica el campo Nombre',
              'mensaje' => 'El valor recibido no contiene unicamente letras',
              'tipo' => 'error'
            ]);
          }
        }

        if($apellido_paterno){
          if (!ctype_alpha($apellido_paterno)) {
            return redirect()->back()->with([
              'titulo' => 'Verifica el campo Apellido Paterno',
              'mensaje' => 'El valor recibido no contiene unicamente letras',
              'tipo' => 'error'
            ]);
          }
          }else{
          return redirect()->back()->with([
            'titulo' => 'Verifica el campo Apellido',
            'mensaje' => 'El campo esta vacío',
            'tipo' => 'error'
          ]);
        }

        if($apellido_materno){
          if (!ctype_alpha($apellido_materno)) {
            return redirect()->back()->with([
              'titulo' => 'Verifica el campo Apellido Materno',
              'mensaje' => 'El valor recibido no contiene unicamente letras',
              'tipo' => 'error'
            ]);
          }
        }

        if(!$fecha_nacimiento){
          return redirect()->back()->with([
            'titulo' => 'Verifica fecha de nacimiento',
            'mensaje' => 'El campo esta vacío',
            'tipo' => 'error'
          ]);
        }

        if($rfc){
          if (strlen ($rfc)>13){
            return redirect()->back()->with([
              'titulo' => 'Verifica el campo RFC',
              'mensaje' => 'El valor que ingresaste no es válido',
              'tipo' => 'error'
            ]);
          }
          }else {
          return redirect()->back()->with([
            'titulo' => 'Verifica el campo RFC',
            'mensaje' => 'El valorno puede estar vacío',
            'tipo' => 'error'
          ]);
          }

        if($curp){
          if (strlen ($curp)!=18 ){
            return redirect()->back()->with([
              'titulo' => 'Verifica el campo curp',
              'mensaje' => 'El valor que ingresaste no es válido',
              'tipo' => 'error'
            ]);
          }
          }else {
          return redirect()->back()->with([
            'titulo' => 'Verifica el campo curp',
            'mensaje' => 'El valor no puede estar vacío',
            'tipo' => 'error'
          ]);
          }

        if($numero_seguro_social){
          if (strlen ($numero_seguro_social)>11){
            return redirect()->back()->with([
              'titulo' => 'Verifica el campo NSS',
              'mensaje' => 'El valor que ingresaste no es válido',
              'tipo' => 'error'
            ]);
          }
          if(!is_numeric($numero_seguro_social) ){
            return redirect()->back()->with([
              'titulo' => 'Verifica el campo NSS',
              'mensaje' => 'El valor que ingresaste no es válido',
              'tipo' => 'error'
            ]);
          }
          }else{
            return redirect()->back()->with([
              'titulo' => 'Verifica el campo NSS',
              'mensaje' => 'El valor no puede estar vacío',
              'tipo' => 'error'
            ]);
          }

        if($correo_empresa){
          if (!filter_var($correo_empresa, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->with([
              'titulo' => 'Verifica el campo Correo Empresa',
              'mensaje' => 'El valor que ingresaste no es válido',
              'tipo' => 'error'
            ]);
          }
          }else{
            return redirect()->back()->with([
              'titulo' => 'Verifica el campo Correo Empresa',
              'mensaje' => 'El valor esta vacío',
              'tipo' => 'error'
            ]);
          }

        if($correo_personal){
          if (!filter_var($correo_personal, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->with([
              'titulo' => 'Verifica el campo Correo Personal',
              'mensaje' => 'El valor que ingresaste no es válido',
              'tipo' => 'error'
              ]);
            }
          }else{
            return redirect()->back()->with([
              'titulo' => 'Verifica el campo Correo Personal',
              'mensaje' => 'El valor esta vacío',
              'tipo' => 'error'
            ]);
        }

        $correo_empresa_existe = PCor::select('id')->where('email_empresa',$correo_empresa)->first();
        if($correo_empresa_existe!=null){
          return redirect()->back()->with([
            'titulo' => 'Correo no aceptado',
            'mensaje' => 'El correo empresarial ya ha sido registrado',
            'tipo' => 'error'
          ]);
          }

        $correo_personal_existe = PCor::select('id')->where('email_personal',$correo_personal)->first();
        if($correo_personal_existe!=null){
          return redirect()->back()->with([
            'titulo' => 'Correo no aceptado',
            'mensaje' => 'El correo personal ya ha sido registrado',
            'tipo' => 'error'
          ]);
          }

        $rfc_existe = EEmp::select('id')->where('rfc',$rfc)->first();
        if($rfc_existe!=null){
          return redirect()->back()->with([
            'titulo' => 'RFC no aceptado',
            'mensaje' => 'RFC ya registrado',
            'tipo' => 'error'
          ]);
          }

        $numero_seguro_social_existe = EEmp::select('id')->where('n_seguro_social',$numero_seguro_social)->first();
        if($numero_seguro_social_existe!=null){
          return redirect()->back()->with([
            'titulo' => 'Numero de Seguro Social',
            'mensaje' => 'Ya se encuentra registrado',
            'tipo' => 'error'
          ]);
          }

        DB::beginTransaction();


       EEmp::create([
          //colocar uuid? para conectar todas tablas y vistas??
          'uuid' => (string) Str::uuid(),
          'primer_nombre' => $primer_nombre,
          'segundo_nombre' => $segundo_nombre,
          'apellido_paterno' => $apellido_paterno,
          'apellido_materno' => $apellido_materno,
          'fecha_nacimiento' => $fecha_nacimiento,
          'rfc' => $rfc,
          'curp' => $curp,
          'n_seguro_social' => $numero_seguro_social
        ]);
        $uuid_nuevo = EEmp::select('uuid')->where('rfc',$rfc)->pluck('uuid')->first();
        Usua::create([
          'uuid' => $uuid_nuevo,
          'email' => $correo_empresa,
          'password' => Hash::make($contrasenia)
        ]);

        $uuid_nuevo = Usua::select('uuid')->where('email',$correo_empresa)->pluck('uuid')->first();
        Per::create([
          'uuid' => $uuid_nuevo,
          'primer_nombre' => $primer_nombre,
          'segundo_nombre' => $segundo_nombre,
          'apellido_paterno' => $apellido_paterno,
          'apellido_materno' => $apellido_materno,
          'fecha_nacimiento' => $fecha_nacimiento
        ]);

        $uuid_nuevo = Usua::select('uuid')->where('email',$correo_empresa)->pluck('uuid')->first();
        $id_persona = Per::select('id')->where('uuid',$uuid_nuevo)->pluck('id')->first();

        PCor::create([
            'uuid' => $uuid_nuevo,
            'id_persona' => $id_persona,
            'email_empresa' => $correo_empresa,
            'email_personal' => $correo_personal
        ]);

        DB::commit();

        return redirect()->back()->with([
          'titulo' => 'Registro exitoso',
          'mensaje' => '',
          'tipo' => 'success'
        ]);

    } catch (\Exception $e) {
      DB::rollback();
      return $e->getMessage();
    }
  }

  public function listarEmpleado(Request $request){

    $empleados = EEmp::with('correo_EEmp')->with('usuario_EEmp')->with('persona_EEmp')->get();
    return view('listar_empleado',compact('empleados'));
  }

  public function verEditorEmpleado(Request $request){
    try {
      $uuid = $request->uuid;
      Log::debug('1');
      if(!$uuid) {
        Log::debug('UsuariosController@editorColaborador no se recibio empleo');
        return redirect()->back()->with([
          'titulo' => 'Ha ocurrido un error',
          'mensaje' => 'Intenta nuevamente mas tarde',
          'tipo' => 'error'
        ]);}
        Log::debug('2');
          $existe = EEmp::select('uuid')->where('uuid', $uuid)->pluck('uuid')->first();
          Log::debug('3');
          if(!$existe){
            Log::debug('UsuariosController@editorColaborador el correo no se encuentra en la Base de Datos');
            return redirect()->back()->with([
              'titulo' => 'Ha ocurrido un error',
              'mensaje' => 'Intenta nuevamente mas tarde',
              'tipo' => 'error'
            ]);
            }
            Log::debug('4');
            $empleado_datos = EEmp::with('persona_EEmp')->with('correo_EEmp')->with('usuario_EEmp')->where('uuid',$uuid)->first();
            Log::debug('5');
            return view('editor_empleado', compact('empleado_datos'));
    } catch (\Exception $e) {
      Log::debug('UsuariosController@editorColaborador'.$e->getMessage());
      return null;
    }
  }

  public function editorEmpleado(Request $request){
    try {
      $uuid = $request->uuid;
      $primer_nombre = $request->primer_nombre;
      $segundo_nombre = $request->segundo_nombre;
      $apellido_paterno = $request->apellido_paterno;
      $apellido_materno = $request->apellido_materno;
      $estado_civil = $request->estado_civil;
      $hijos = $request->hijos;
      $genero = $request->genero;
      $lugar_nacimiento = $request->lugar_nacimiento;
      $fecha_nacimiento = $request->fecha_nacimiento;
      $edad = $request->edad;
      $curp = $request->curp;
      $rfc = $request->rfc;
      $numero_seguro_social = $request->numero_seguro_social;
      $pais = $request ->pais;
      $estado =$request->estado;
      $calle = $request->calle;
      $num_exterior = $request->num_exterior;
      $num_interior = $request->num_interior;
      $colonia = $request->colonia;
      $manzana = $request->manzana;
      $lote = $request->lote;
      $municipio = $request->municipio;
      $codigo_postal = $request->codigo_postal;
      $correo_empresa = $request ->correo_empresa;
      $correo_personal =$request ->correo_personal;

      //validacion
      if($primer_nombre){
        if (!ctype_alpha($primer_nombre)) {
          return redirect()->back()->with([
            'titulo' => 'Verifica el campo Nombre',
            'mensaje' => 'El valor recibido no contiene unicamente letras',
            'tipo' => 'error'
          ]);
        }
        }else{
        return redirect()->back()->with([
          'titulo' => 'Verifica el campo Primer Nombre',
          'mensaje' => 'El campo esta vacío',
          'tipo' => 'error'
        ]);
      }

      if($segundo_nombre){
        if (!ctype_alpha($segundo_nombre)) {
          return redirect()->back()->with([
            'titulo' => 'Verifica el campo Nombre',
            'mensaje' => 'El valor recibido no contiene unicamente letras',
            'tipo' => 'error'
          ]);
        }
      }

      if($apellido_paterno){
        if (!ctype_alpha($apellido_paterno)) {
          return redirect()->back()->with([
            'titulo' => 'Verifica el campo Apellido Paterno',
            'mensaje' => 'El valor recibido no contiene unicamente letras',
            'tipo' => 'error'
          ]);
        }
        }else{
        return redirect()->back()->with([
          'titulo' => 'Verifica el campo Apellido',
          'mensaje' => 'El campo esta vacío',
          'tipo' => 'error'
        ]);
      }

      if($apellido_materno){
        if (!ctype_alpha($apellido_materno)) {
          return redirect()->back()->with([
            'titulo' => 'Verifica el campo Apellido Materno',
            'mensaje' => 'El valor recibido no contiene unicamente letras',
            'tipo' => 'error'
          ]);
        }
      }


      if($rfc){
        if (strlen ($rfc)>13){
          return redirect()->back()->with([
            'titulo' => 'Verifica el campo RFC',
            'mensaje' => 'El valor que ingresaste no es válido',
            'tipo' => 'error'
          ]);
        }
        }else {
        return redirect()->back()->with([
          'titulo' => 'Verifica el campo RFC',
          'mensaje' => 'El valorno puede estar vacío',
          'tipo' => 'error'
        ]);
        }

      if($curp){
        if (strlen ($curp)!=18 ){
          return redirect()->back()->with([
            'titulo' => 'Verifica el campo curp',
            'mensaje' => 'El valor que ingresaste no es válido',
            'tipo' => 'error'
          ]);
        }
        }else {
        return redirect()->back()->with([
          'titulo' => 'Verifica el campo curp',
          'mensaje' => 'El valor no puede estar vacío',
          'tipo' => 'error'
        ]);
        }

      if($numero_seguro_social){
        if (strlen ($numero_seguro_social)>11){
          return redirect()->back()->with([
            'titulo' => 'Verifica el campo NSS',
            'mensaje' => 'El valor que ingresaste no es válido',
            'tipo' => 'error'
          ]);
        }
        if(!is_numeric($numero_seguro_social) ){
          return redirect()->back()->with([
            'titulo' => 'Verifica el campo NSS',
            'mensaje' => 'El valor que ingresaste no es válido',
            'tipo' => 'error'
          ]);
        }
        }else{
          return redirect()->back()->with([
            'titulo' => 'Verifica el campo NSS',
            'mensaje' => 'El valor no puede estar vacío',
            'tipo' => 'error'
          ]);
        }

      if($correo_empresa){
        if (!filter_var($correo_empresa, FILTER_VALIDATE_EMAIL)) {
          return redirect()->back()->with([
            'titulo' => 'Verifica el campo Correo Empresa',
            'mensaje' => 'El valor que ingresaste no es válido',
            'tipo' => 'error'
          ]);
        }
        }else{
          return redirect()->back()->with([
            'titulo' => 'Verifica el campo Correo Empresa',
            'mensaje' => 'El valor esta vacío',
            'tipo' => 'error'
          ]);
        }

      if($correo_personal){
        if (!filter_var($correo_personal, FILTER_VALIDATE_EMAIL)) {
          return redirect()->back()->with([
            'titulo' => 'Verifica el campo Correo Personal',
            'mensaje' => 'El valor que ingresaste no es válido',
            'tipo' => 'error'
            ]);
          }
        }else{
          return redirect()->back()->with([
            'titulo' => 'Verifica el campo Correo Personal',
            'mensaje' => 'El valor esta vacío',
            'tipo' => 'error'
          ]);
      }
      $correo_empresa_uuid = PCor::select('email_empresa')->where('uuid',$uuid)->pluck('email_empresa')->first();
      $correo_empresa_lista =PCor::select('id')->where('email_empresa',$correo_empresa)->first();

      if($correo_empresa_uuid==$correo_empresa){

      }else{
        if($correo_empresa_lista!=null){
          return redirect()->back()->with([
            'titulo' => 'Correo no aceptado',
            'mensaje' => 'El correo empresarial ya ha sido registrado',
            'tipo' => 'error'
          ]);
          }
      }


      $correo_personal_uuid = PCor::select('email_personal')->where('uuid',$uuid)->pluck('email_personal')->first();
      $correo_personal_lista =PCor::select('id')->where('email_personal',$correo_personal)->first();
      if($correo_personal_uuid==$correo_personal){

      }else{
        if($correo_personal_lista!=null){
          return redirect()->back()->with([
            'titulo' => 'Correo no aceptado',
            'mensaje' => 'El correo personal ya ha sido registrado',
            'tipo' => 'error'
          ]);
          }
      }



      $rfc_uuid = EEmp::select('rfc')->where('uuid',$uuid)->pluck('rfc')->first();
      $rfc_lista = EEmp::select('id')->where('rfc',$rfc)->first();
      if($rfc_uuid==$rfc){

      }else{
        if($rfc_lista!=null){
          return redirect()->back()->with([
            'titulo' => 'RFC no aceptado',
            'mensaje' => 'RFC ya registrado',
            'tipo' => 'error'
          ]);
          }
      }


      $numero_seguro_social_uuid = EEmp::select('n_seguro_social')->where('uuid',$uuid)->pluck('n_seguro_social')->first();
      $numero_seguro_social_lista = EEmp::select('id')->where('n_seguro_social',$numero_seguro_social)->first();
      if($numero_seguro_social_uuid==$numero_seguro_social){

      }else{
        if($numero_seguro_social_lista!=null){
          return redirect()->back()->with([
            'titulo' => 'Numero de Seguro Social',
            'mensaje' => 'Ya se encuentra registrado',
            'tipo' => 'error'
          ]);
          }
      }

      DB::beginTransaction();

     EEmp::where('uuid',$uuid)->update([
        'primer_nombre' => $primer_nombre,
        'segundo_nombre' => $segundo_nombre,
        'apellido_paterno' => $apellido_paterno,
        'apellido_materno' => $apellido_materno,
        'estado_civil' => $estado_civil,
        'hijos' => $hijos,
        'genero' =>$genero,
        'lugar_nacimiento' =>$lugar_nacimiento,
        'fecha_nacimiento' => date_format(date_create($fecha_nacimiento),'Y-m-d'),
        'edad' =>$edad,
        'rfc' => $rfc,
        'curp' => $curp,
        'n_seguro_social' => $numero_seguro_social,
        'pais' => $pais,
        'estado' =>$estado,
        'codigo_postal' =>$codigo_postal,
        'municipio' =>$municipio,
        'colonia' =>$colonia,
        'manzana' =>$manzana,
        'lote' =>$lote,
        'calle' =>$calle,
        'numero_exterior' =>$num_exterior,
        'numero_interior' =>$num_interior
      ]);

      Usua::where('uuid',$uuid)->update([
        'email' => $correo_empresa,
      ]);


      Per::where('uuid',$uuid)->update([
        'primer_nombre' => $primer_nombre,
        'segundo_nombre' => $segundo_nombre,
        'apellido_paterno' => $apellido_paterno,
        'apellido_materno' => $apellido_materno,
        'fecha_nacimiento' => $fecha_nacimiento,
        'genero' => $genero,
        'pais' =>$pais
      ]);



      PCor::where('uuid',$uuid)->update([
          'email_empresa' => $correo_empresa,
          'email_personal' => $correo_personal
      ]);

      DB::commit();

      return redirect()->back()->with([
        'titulo' => 'Actualización exitosa',
        'mensaje' => '',
        'tipo' => 'success'
      ]);
    } catch (\Exception $e) {

      DB::rollback();

      return $e->getMessage();
    }
  }



}
