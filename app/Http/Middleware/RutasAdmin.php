<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Http\Request;

class RutasAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
      $usuario_dto = Session::get('usuario_dto');
      if($usuario_dto->cuentaConRolDe('SYSADMIN') ) {
        return $next($request);
      } else {
        return redirect()->back()->with([
          'titulo' => 'Direccion  no permitida',
          'mensaje' => 'Etsito',
          'tipo' => 'error'
          ]);
      }
    }
}
