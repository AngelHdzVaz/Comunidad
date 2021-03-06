<?php

namespace App\Helpers;

use DateTime;
use DateTimeZone;use Alert;

class HoraZona
{
  private $fecha;
  private $hora;
  private $completo;
  private $mes;
  private $año;

  public function __construct($zonahoraria = NULL) {
    $tiempo = time();
    if(!is_null($zonahoraria)) {
      $zonahoraria = new DateTimeZone($zonahoraria);
      $ahora = new DateTime('now', $zonahoraria);
      $desfase = $zonahoraria->getOffset($ahora);
      $tiempo = time() + $desfase;
    }
    $this->fecha = date('Y-m-d', $tiempo);
    $this->año = date('Y', $tiempo);
    $this->mes = date('m', $tiempo);
    $this->hora = date('H:i:s', $tiempo);
    $this->completo = $this->fecha .' '. $this->hora;
  }

  public function fecha() {
    return $this->fecha;
  }

  public function año() {
    return $this->año;
  }

  public function mes() {
    return $this->mes;
  }

  public function hora() {
    return $this->hora;
  }

  public function fechaYHora() {
    return $this->completo;
  }
}
