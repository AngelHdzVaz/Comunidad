<?php

namespace App\Http\Dtos;

use DB;
use Auth;
use Alert;
use Ctt;
use App\Persona;
use Illuminate\Support\Facades\Storage;

class UsuarioDto {
  private $codigo_usuario;
  private $codigo_establecimiento;
  private $email;
  private $acceso;
  private $zona_horaria;
  private $pais;
  private $tiempo_registro;
  private $area_empresarial;
  private $perfil;
  private $codigo_empresa;
  private $codigo_cliente;
  private $rfc;
  private $persona_fiscal;
  private $primer_nombre;
  private $segundo_nombre;
  private $apellido_paterno;
  private $apellido_materno;
  private $imagen;
  private $rango_valor;
  private $rango;
  private $roles_valores;
  private $roles;
  private $reporta_a;
  private $carpeta_privada;
  private $proceso_activo;
  private $cartera;
  private $telefono;
  private $genero;
  private static $usuario_dto;

  private function __construct() {
    $this->codigo_usuario = Auth::user()->codigo_usuario;
    $this->codigo_establecimiento = Auth::user()->codigo_establecimiento;
    $this->email = Auth::user()->email;
    $this->acceso = Auth::user()->acceso;
    $this->zona_horaria = Auth::user()->zona_horaria;
    $pais = DB::table(Ctt::T008)->select('nombre')->where('id', Auth::user()->id_pais)->first();
    $this->pais = $pais->nombre;
    $this->tiempo_registro = Auth::user()->tiempo_registro;
    $area_emp = DB::table(Ctt::T002)->select('area')->where('id', Auth::user()->id_area)->first();
    $this->area_empresarial = $area_emp->area;
    $perfil = DB::table(Ctt::T010)->select('perfil')->where('id', Auth::user()->id_perfil)->first();
    $this->perfil = (isset($perfil))? $perfil->perfil : $perfil;
    $this->codigo_empresa = Auth::user()->codigo_empresa;
    $persona_fiscal = DB::table(Ctt::T011)->select('tipo', 'rfc')->where('codigo_empresa', Auth::user()->codigo_empresa)->first();
    $this->rfc = $persona_fiscal->rfc;
    $this->persona_fiscal = ($persona_fiscal->tipo == 'M')? 'MORAL' : 'FISICA';
    $rango = DB::table(Ctt::T029)->select('rango')->where('id', Auth::user()->id_rango)->first();
    $this->rango = $rango->rango;
    $this->rango_valor = Auth::user()->id_rango;
    $this->imagen = Auth::user()->foto;
    $this->carpeta_privada = Auth::user()->codigo_empresa . '/';
    $roles_val = DB::table(Ctt::T039)->select('id_rol')->where('codigo_usuario', Auth::user()->codigo_usuario)->get();
    $this->roles_valores = $roles_val;
    $roles = DB::table(Ctt::T039 . ' as urol')
      ->join(Ctt::T014 . ' as crol', 'urol.id_rol', '=', 'crol.id')
      ->select('crol.rol')
      ->where('urol.codigo_usuario', Auth::user()->codigo_usuario)
      ->get();
    $this->roles = $roles;
    $this->reporta_a = Auth::user()->reporta_a;
    if(Auth::user()->id_persona != null) {
      $persona = Persona::where('id', Auth::user()->id_persona)->first();
      $this->primer_nombre = $persona->primer_nombre;
      $this->segundo_nombre = $persona->segundo_nombre;
      $this->apellido_paterno = $persona->apellido_paterno;
      $this->apellido_materno = $persona->apellido_materno;
      $this->genero = $persona->genero;
    }

    if($this->perfil == 'ONLINE') {
      $cartera = DB::table(Ctt::T057)->select('cartera')
        ->where('codigo_empresa', $this->codigo_empresa)
        ->where('codigo_usuario', $this->codigo_usuario)
        ->first();

      $this->cartera = (isset($cartera))? $cartera->cartera : $cartera;;
    }

    $telefono = DB::table(Ctt::T080 . ' as utel')
      ->join(Ctt::T015 . ' as ctti', 'utel.id_tipo', '=', 'ctti.id')
      ->select('utel.codigo', 'utel.lada', 'utel.numero', 'utel.extension', 'ctti.tipo')
      ->where('utel.codigo_usuario', Auth::user()->codigo_usuario)
      ->first();

    $telefono_aux = '[' . $telefono->codigo . '] (' . $telefono->lada . ') ' . $telefono->numero;
    if($telefono->extension != null) {
      $telefono_aux .= ' Ext. ' . $telefono->extension . ' ' . $telefono->tipo;
    } else {
      $telefono_aux .= ' ' . $telefono->tipo;
    }

    $this->telefono = $telefono_aux;
  }

  public static function instancia() {
    if(isset(self::$usuario_dto)) {
      return self::$usuario_dto;
    } else {
      self::$usuario_dto = new UsuarioDto();
    }
    if(!isset(self::$usuario_dto)) {
      $clase = __CLASS__;
      self::$usuario_dto = new $clase;
    }
    return self::$usuario_dto;
  }

  public function __clone() {
      trigger_error('No está permitida la clonación de objetos', E_USER_ERROR);
  }

  public function pais() {
    return $this->pais;
  }

  public function codigoUsuario() {
    return $this->codigo_usuario;
  }

  public function codigoEstablecimiento() {
    return $this->codigo_establecimiento;
  }

  public function email() {
    return $this->email;
  }

  public function acceso($acceso=null) {
    if(isset($acceso)) {
      $this->acceso = $acceso;
    } else {
      return $this->acceso;
    }
  }

  public function zonaHoraria() {
    return $this->zona_horaria;
  }

  public function tiempoRegistro() {
    return $this->tiempo_registro;
  }

  public function areaEmpresarial($area_empresarial=null) {
    if(isset($area_empresarial)) {
      $this->area_empresarial = $area_empresarial;
    } else {
      return $this->area_empresarial;
    }
  }

  public function perfil() {
    return $this->perfil;
  }

  public function codigoEmpresa() {
    return $this->codigo_empresa;
  }
/*
  public function codigoCliente() {
    return $this->codigo_cliente;
  }
*/
  public function codigoCliente($codigo_cliente=null) {
    if(isset($codigo_cliente)) {
      $this->codigo_cliente = $codigo_cliente;
    } else {
      return $this->codigo_cliente;
    }
  }

  public function rfc($rfc=null) {
    if(isset($rfc)) {
      $this->rfc = $rfc;
    } else {
      return $this->rfc;
    }
  }

  public function personaFiscal($persona_fiscal=null) {
    if(isset($persona_fiscal)) {
      $this->persona_fiscal = $persona_fiscal;
    } else {
      return $this->persona_fiscal;
    }
  }

  public function primerNombre($primer_nombre=null) {
    if(isset($primer_nombre)) {
      $this->primer_nombre = $primer_nombre;
    } else {
      return $this->primer_nombre;
    }
  }

  public function segundoNombre($segundo_nombre=null) {
    if(isset($segundo_nombre)) {
      $this->segundo_nombre = $segundo_nombre;
    } else {
      return $this->segundo_nombre;
    }
  }

  public function apellidoPaterno($apellido_paterno=null) {
    if(isset($apellido_paterno)) {
      $this->apellido_paterno = $apellido_paterno;
    } else {
      return $this->apellido_paterno;
    }
  }

  public function apellidoMaterno($apellido_materno=null) {
    if(isset($apellido_materno)) {
      $this->apellido_materno = $apellido_materno;
    } else {
      return $this->apellido_materno;
    }
  }

  public function nombrefechaYHora() {
    return $this->primer_nombre .' '.
           $this->segundo_nombre .' '.
           $this->apellido_paterno .' '.
           $this->apellido_materno;
  }

  public function primerNombrePrimerApellido() {
    return $this->primer_nombre .' '.
           $this->apellido_paterno;
  }

  public function imagenPerfil($imagen=null) {
    if(isset($imagen)) {
      $this->imagen = $imagen;
    } else {
      return $this->imagen;
    }
  }

  public function rangoValor() {
    return $this->rango_valor;
  }

  public function rango($rango=null) {
    return $this->rango;
  }

  public function rolesValores() {
    return $this->roles_valores;
  }

  public function roles() {
    return $this->roles;
  }

  public function cuentaConRolDe($rol_a_buscar) {
    foreach($this->roles as $rol) {
      if($rol->rol == $rol_a_buscar) {
        return true;
      }
    }
    return false;
  }

  public function carpetaPrivada() {
    return $this->carpeta_privada;
  }

  public function procesoActivo() {
    return $this->proceso_activo;
  }

  public function reportaA() {
    return $this->reporta_a;
  }

  public function cartera() {
    return $this->cartera;
  }

  public function telefonoPrimerContacto() {
    return $this->telefono;
  }

  public function genero() {
    return $this->genero;
  }
}
