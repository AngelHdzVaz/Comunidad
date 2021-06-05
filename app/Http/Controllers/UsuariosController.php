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
use Session;
use App\Helpers\HoraZona;
use App\Http\Dtos\UsuarioDatos;
use App\Mail\PreregistroContactanos;
use App\Models\Preregistro as PreR ;
use App\Models\Empresas_empleado as EEmp;
use App\Models\Persona as Per ;
use App\Models\Usuario as Usua ;
use App\Models\Usuarios_telefono as UTel ;
use App\Models\Usuarios_role as URol ;
use App\Models\Personas_correo as PCor ;
use App\Models\Publicacione as Pubc;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;


class UsuariosController extends Controller
{

  public function paginacion($array, $request, $perPage) {
    $page = $request->input('page', 1);
    $offset = ($page * $perPage) - $perPage;

    return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
        ['path' => $request->url(), 'query' => $request->query()]);
  }

  public function verLogin(){
    return view('auth.login');
  }
  public function loginUsuario(Request $request){
    try {
      $email = $request->email;
      $password = $request->password;

      if(!$email){
        return redirect()->back()->with([
          'titulo' => 'Verifica el campo correo',
          'mensaje' => 'El valor recibido no se encuentra en los registros',
          'tipo' => 'error'
        ]);
        }

      if(!$password){
        return redirect()->back()->with([
          'titulo' => 'Verifica el campo contraseña',
          'mensaje' => 'El campo no debe estar vacio',
          'tipo' => 'error'
        ]);
        }

        $credencial = ['email' => $email, 'password' => $password];
        $remember = 'on';

        if(Auth::attempt($credencial)) {
          $usuario_dto = UsuarioDatos::instancia();
          Session::put('usuario_dto', $usuario_dto);

          return redirect('/noticias');
        } else {

          return redirect()->back()->with([
            'titulo' => 'Verifica los datos de inicio de sesión',
            'mensaje' => ' ',
            'tipo' => 'error'
          ]);
        }
          Log::error('4');

    } catch (\Exception $e) {
      Log::error('UsuariosController@loginUsuario'.$e->getMessage());
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
      Log::error('1');

      $existecorreo = PreR::select('id')->where('correo',$correo)->first();
        Log::error('2');
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
          Log::error('3');
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
        Log::error('4');
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
      $usuario_dto = Session::get('usuario_dto');
      $tiempo_obj = new HoraZona($usuario_dto->zonaHoraria());
      //dd($tiempo_obj);
      $tiempo_local = $tiempo_obj->fechaYHora();
      $primer_nombre = $request->primer_nombre;
      $segundo_nombre = $request->segundo_nombre;
      $apellido_paterno = $request->apellido_paterno;
      $apellido_materno = $request->apellido_materno;
      $rfc = $request->rfc;
      $curp = $request->curp;
      $numero_seguro_social = $request->numero_seguro_social;
      $correo_empresa = $request->correo_empresa;
      $telefono = $request->telefono;
      $extension = $request->extension;
      $contrasenia =$request->contrasenia;
      $zona_horaria = $request->zona_horaria;
      //dd($telefono,$extension);
        //validacion
      if($primer_nombre){
        if (!ctype_alpha($primer_nombre)) {
          return redirect()->back()->withInput()->with([
            'titulo' => 'Verifica el campo Nombre',
            'mensaje' => 'El valor recibido no contiene unicamente letras',
            'tipo' => 'error'
          ]);
        }
        }else{
        return redirect()->back()->withInput()->with([
          'titulo' => 'Verifica el campo Primer Nombre',
          'mensaje' => 'El campo esta vacío',
          'tipo' => 'error'
        ]);
      }

      if($segundo_nombre){
        if (!ctype_alpha($segundo_nombre)) {
          return redirect()->back()->withInput()->with([
            'titulo' => 'Verifica el campo Nombre',
            'mensaje' => 'El valor recibido no contiene unicamente letras',
            'tipo' => 'error'
          ]);
        }
      }

      if($apellido_paterno){
        if (!ctype_alpha($apellido_paterno)) {
          return redirect()->back()->withInput()->with([
            'titulo' => 'Verifica el campo Apellido Paterno',
            'mensaje' => 'El valor recibido no contiene unicamente letras',
            'tipo' => 'error'
          ]);
        }
        }else{
        return redirect()->back()->withInput()->with([
          'titulo' => 'Verifica el campo Apellido',
          'mensaje' => 'El campo esta vacío',
          'tipo' => 'error'
        ]);
      }

      if($apellido_materno){
        if (!ctype_alpha($apellido_materno)) {
          return redirect()->back()->withInput()->with([
            'titulo' => 'Verifica el campo Apellido Materno',
            'mensaje' => 'El valor recibido no contiene unicamente letras',
            'tipo' => 'error'
          ]);
        }
      }

      if($rfc){
        if (strlen ($rfc)>13){
          return redirect()->back()->withInput()->with([
            'titulo' => 'Verifica el campo RFC',
            'mensaje' => 'El valor que ingresaste no es válido',
            'tipo' => 'error'
          ]);
        }
        }else {
        return redirect()->back()->withInput()->with([
          'titulo' => 'Verifica el campo RFC',
          'mensaje' => 'El valorno puede estar vacío',
          'tipo' => 'error'
        ]);
        }

      if($curp){
        if (strlen ($curp)!=18 ){
          return redirect()->back()->withInput()->with([
            'titulo' => 'Verifica el campo curp',
            'mensaje' => 'El valor que ingresaste no es válido',
            'tipo' => 'error'
          ]);
        }
        }else {
        return redirect()->back()->withInput()->with([
          'titulo' => 'Verifica el campo curp',
          'mensaje' => 'El valor no puede estar vacío',
          'tipo' => 'error'
        ]);
        }

      if($numero_seguro_social){
        if (strlen ($numero_seguro_social)>11){
          return redirect()->back()->withInput()->with([
            'titulo' => 'Verifica el campo NSS',
            'mensaje' => 'El valor que ingresaste no es válido',
            'tipo' => 'error'
          ]);
        }
        if(!is_numeric($numero_seguro_social) ){
          return redirect()->back()->withInput()->with([
            'titulo' => 'Verifica el campo NSS',
            'mensaje' => 'El valor que ingresaste no es válido',
            'tipo' => 'error'
          ]);
        }
        }else{
          return redirect()->back()->withInput()->with([
            'titulo' => 'Verifica el campo NSS',
            'mensaje' => 'El valor no puede estar vacío',
            'tipo' => 'error'
          ]);
        }

      if($correo_empresa){
        if (!filter_var($correo_empresa, FILTER_VALIDATE_EMAIL)) {
          return redirect()->back()->withInput()->with([
            'titulo' => 'Verifica el campo Correo Empresa',
            'mensaje' => 'El valor que ingresaste no es válido',
            'tipo' => 'error'
          ]);
        }
        }else{
          return redirect()->back()->withInput()->with([
            'titulo' => 'Verifica el campo Correo Empresa',
            'mensaje' => 'El valor esta vacío',
            'tipo' => 'error'
          ]);
        }

      $correo_empresa_existe = PCor::select('id')->where('email_empresa',$correo_empresa)->first();
      if($correo_empresa_existe!=null){
        return redirect()->back()->withInput()->with([
          'titulo' => 'Correo no aceptado',
          'mensaje' => 'El correo empresarial ya ha sido registrado',
          'tipo' => 'error'
        ]);
        }

      $rfc_existe = EEmp::select('id')->where('rfc',$rfc)->first();
      if($rfc_existe!=null){
        return redirect()->back()->withInput()->with([
          'titulo' => 'RFC no aceptado',
          'mensaje' => 'RFC ya registrado',
          'tipo' => 'error'
        ]);
        }

      $numero_seguro_social_existe = EEmp::select('id')->where('n_seguro_social',$numero_seguro_social)->first();
      if($numero_seguro_social_existe!=null){
        return redirect()->back()->withInput()->with([
          'titulo' => 'Numero de Seguro Social',
          'mensaje' => 'Ya se encuentra registrado',
          'tipo' => 'error'
        ]);
        }

      if(!is_numeric($telefono)&&strlen($telefono=10)){
        return redirect()->back()->withInput()->with([
          'titulo' => 'Telefono Invalido',
          'mensaje' => 'El telefono ingresado no es correcto',
          'tipo' => 'error'
        ]);
      }

      if(!$extension && is_numeric($extension)){
        return redirect()->back()->withInput()->with([
          'titulo' => 'Extensión',
          'mensaje' => 'Extensión no valida',
          'tipo' => 'error'
        ]);
        }

      if($zona_horaria==null){
      Log::error('UsuariosController@registroColaborador => Variable zona_horaria con valor nulo');
        return redirect()->back()->with([
          'titulo' => 'Ha ocurrido un error',
          'mensaje' => 'Intenta nuevamente mas tarde',
          'tipo' => 'error'
        ]);
      }

      DB::beginTransaction();
     $var1 = EEmp::create([
        //colocar uuid? para conectar todas tablas y vistas??
        'uuid' => (string) Str::uuid(),
        'rfc' => $rfc,
        'curp' => $curp,
        'n_seguro_social' => $numero_seguro_social,
        'tiempo_registro' => $tiempo_local
      ]);

      Usua::create([
        'uuid' => $var1->uuid,
        'email' => $correo_empresa,
        'password' => Hash::make($contrasenia),
        'zona_horaria' => $zona_horaria,
        'tiempo_registro' => $tiempo_local
      ]);

      URol::create([
        'uuid_usuario_rol' => $var1->uuid,
        'id_rol' => 10
      ]);

      UTel::create([
        'uuid_usuario_telefono' => $var1->uuid,
        'numero' => $telefono,
        'extension' => $extension,
        'id_tipo' => 3
      ]);


      $var2 = Per::create([
        'uuid' => $var1->uuid,
        'primer_nombre' => $primer_nombre,
        'segundo_nombre' => $segundo_nombre,
        'apellido_paterno' => $apellido_paterno,
        'apellido_materno' => $apellido_materno
      ]);


      PCor::create([
          'uuid' => $var1->uuid,
          'id_persona' => $var2->id_persona,
          'email_empresa' => $correo_empresa
      ]);

/*    $var1->id_estatus = 8;
      $var1->save();
*/
      DB::commit();
      return redirect()->back()->with([
        'titulo' => 'Registro exitoso',
        'mensaje' => '',
        'tipo' => 'success'
      ]);
      }catch (\Exception $e) {
        DB::rollback();
        return $e->getMessage();
      }
  }

  public function listarEmpleado(Request $request){
    if(Auth::check()){
      $empleados = EEmp::with('correo_EEmp')
      ->with('usuario_EEmp')
      ->with('persona_EEmp')
      ->with(['telefonos_EEmp' =>function($q1){
          $q1->with('catalogoTelefonos_UTel');
      }])
      ->orderBy('edad','asc')
      ->get();
          //dd($empleados);
      $empleados = $this->paginacion($empleados->all(), $request,8);
      setlocale(LC_ALL, 'es');

      return view('listar_empleado',compact('empleados'));
    }else{
      Log::error('UsuariosController@listarEmpleado no se esta logueado');
      return redirect()->back()->with([
        'titulo' => 'Ha ocurrido un error',
        'mensaje' => 'Intenta nuevamente mas tarde',
        'tipo' => 'error'
      ]);
    }
  }


  public function directorio(Request $request){
    if(Auth::check()){
      $empleados = EEmp::with('correo_EEmp')
      ->with('usuario_EEmp')
      ->with('persona_EEmp')
      ->with(['telefonos_EEmp' =>function($q1){
          $q1->with('catalogoTelefonos_UTel');
      }])
      ->orderBy('edad','asc')
      ->get();
          //dd($empleados);
      $empleados = $this->paginacion($empleados->all(), $request,12);
      setlocale(LC_ALL, 'es');

      return view('directorio',compact('empleados'));
    }else{
      Log::error('UsuariosController@listarEmpleado no se esta logueado');
      return redirect()->back()->with([
        'titulo' => 'Ha ocurrido un error',
        'mensaje' => 'Intenta nuevamente mas tarde',
        'tipo' => 'error'
      ]);
    }
  }

  public function verEditorEmpleado(Request $request){
    try {
      $uuid = $request->uuid;
      if(!$uuid) {
        return redirect()->back()->with([
          'titulo' => 'Ha ocurrido un error',
          'mensaje' => 'Intenta nuevamente mas tarde',
          'tipo' => 'error'
        ]);}
          $existe = EEmp::select('uuid')
            ->where('uuid', $uuid)
            ->pluck('uuid')
            ->first();
          if(!$existe){
            Log::error('UsuariosController@editorColaborador el Colaborador no se encuentra en la Base de Datos');
            return redirect()->back()->with([
              'titulo' => 'Ha ocurrido un error',
              'mensaje' => 'Intenta nuevamente mas tarde',
              'tipo' => 'error'
            ]);
            }
            $empleado_datos = EEmp::with('persona_EEmp')
            ->with('correo_EEmp')
            ->with('usuario_EEmp')
            ->with(['telefonos_EEmp' =>function($q1){
                $q1->with('catalogoTelefonos_UTel');
            }])
            ->where('uuid',$uuid)
            ->first();
            return view('editor_empleado', compact('empleado_datos'));
    } catch (\Exception $e) {
      Log::error('UsuariosController@editorColaborador'.$e->getMessage());
      return redirect()->back()->with([
        'titulo' => 'Ha ocurrido un error',
        'mensaje' => 'Intenta nuevamente mas tarde',
        'tipo' => 'error'
      ]);
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
      $telefono_empresa = $request->telefono_empresa;
      $extension_empresa = $request->extension_empresa;
      $telefono_personal = $request->telefono_personal;
      $extension_personal = $request->extension_personal;
      $telefonos_base = UTel::where('uuid_usuario_telefono',$uuid)->get();
      $telefono_empresa_base =   $telefonos_base->pluck('numero')->get(0);
      $telefono_personal_base = $telefonos_base->pluck('numero')->get(1);
      //dd($telefono_empresa_base,$telefono_empresa,$telefono_personal_base,$telefono_personal);
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
        }
        if(!is_numeric($telefono_empresa)&&strlen($telefono_empresa==10)){
          return redirect()->back()->withInput()->with([
            'titulo' => 'Telefono Invalido',
            'mensaje' => 'El telefono ingresado no es correcto',
            'tipo' => 'error'
          ]);
        }

        if(!$extension_empresa && is_numeric($extension_empresa)){
          return redirect()->back()->withInput()->with([
            'titulo' => 'Extensión',
            'mensaje' => 'Extensión no valida',
            'tipo' => 'error'
          ]);
          }
          if(!is_numeric($telefono_personal)&&strlen($telefono_personal==10)){
            return redirect()->back()->withInput()->with([
              'titulo' => 'Telefono Invalido',
              'mensaje' => 'El telefono ingresado no es correcto',
              'tipo' => 'error'
            ]);
          }

          if(!$extension_personal && is_numeric($extension_personal)){
            return redirect()->back()->withInput()->with([
              'titulo' => 'Extensión',
              'mensaje' => 'Extensión no valida',
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
          'estado_civil' => $estado_civil,
          'hijos' => $hijos,
          'genero' =>$genero,
          'lugar_nacimiento' =>$lugar_nacimiento,
          'edad' =>$edad,
          'rfc' => $rfc,
          'curp' => $curp,
          'n_seguro_social' => $numero_seguro_social,
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

        UTel::where('uuid_usuario_telefono', $uuid)
          ->where('numero', $telefono_empresa_base)
          ->update([
            'numero' => $telefono_empresa,
            'extension' => $extension_empresa ,
            'id_tipo' => 3
          ]);
        if($telefono_personal_base){
          UTel::where([['uuid_usuario_telefono',$uuid],['numero',$telefono_personal_base]])
          ->update([
            'uuid_usuario_telefono'=> $uuid,
            'numero' => $telefono_personal,
            'extension' => $extension_personal ,
            'id_tipo' => 2
          ]);

        }else{
          UTel::create([
            'uuid_usuario_telefono'=> $uuid,
            'numero' => $telefono_personal,
            'extension' => $extension_personal ,
            'id_tipo' => 2
          ]);
        }

      Per::where('uuid',$uuid)->update([
        'primer_nombre' => $primer_nombre,
        'segundo_nombre' => $segundo_nombre,
        'apellido_paterno' => $apellido_paterno,
        'apellido_materno' => $apellido_materno,
        'fecha_nacimiento' => date_format(date_create($fecha_nacimiento),'Y-m-d'),
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

  public function eliminarEmpleado(Request $request){
    try {
      $uuid = $request->uuid;
      DB::beginTransaction();

      EEmp::where('uuid',$uuid)->delete();
      Per::where('uuid',$uuid)->delete();
      PCor::where('uuid',$uuid)->delete();
      Usua::where('uuid',$uuid)->delete();
      Pubc::where('autor',$uuid)->delete();
      DB::commit();
      return redirect()->back()->with([
        'titulo' => 'Colaborador borrado exitosamente',
        'mensaje' => '',
        'tipo' => 'success'
        ]);
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }

}
