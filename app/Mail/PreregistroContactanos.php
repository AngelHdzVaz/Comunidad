<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Ctt;

class PreregistroContactanos extends Mailable
{
    use Queueable, SerializesModels;

    private $visita_nombre;
    private $visita_correo;
    private $visita_mensaje;
    private $visita_telefono;
    private $visita_extension;

    //

    public function __construct($visita_nombre, $visita_correo, $visita_mensaje,
    $visita_telefono,$visita_extension)
    {
      $this->visita_nombre = $visita_nombre;
      $this->visita_correo = $visita_correo;
      $this->visita_mensaje = $visita_mensaje;
      $this->visita_telefono = $visita_telefono;
      $this->visita_extension = $visita_extension;

    }


    public function build()
    {
      return $this
        ->from(Ctt::Correonoresponder, 'Notificaciones Comunidad')
        ->subject('Atencion! Alguien se acaba de preregistrar')
        ->view('layouts.correos.email_preregistro')
        ->with([
          'visita_nombre' => $this->visita_nombre,
          'visita_correo' => $this->visita_correo,
          'visita_mensaje' => $this->visita_mensaje,
          'visita_telefono' => $this->visita_telefono,
          'visita_extension' => $this->visita_extension

        ]);

    }
}
