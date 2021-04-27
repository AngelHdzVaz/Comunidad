@extends('layouts.app')
@section('content')

  <section id="contact" data-stellar-background-ratio="0.5">
       <div class="container">
            <div class="p-2 row">
                 <div class="col-md-offset-1 col-md-10 col-sm-12">
                      <form  method="POST" action="{{ route('RealizarPreRegistro') }}" id="contact-form"  >
                          @csrf
                           <div class="section-title">
                                <h1> Preregistro </h1>
                           </div>
                           <div class="p-2 col-md-4 col-sm-4">
                                <input type="text" class="form-control" placeholder="Nombre Completo" name="nombre" required>
                           </div>
                           <div class="p-2 col-md-4 col-sm-4">
                                <input type="email" class="form-control" placeholder="Correo Electrónico" name="correo" required>
                           </div>

                           <div class="p-2 col-md-4 col-sm-4">
                                <input type="text" class="form-control" placeholder="Telefono" name="telefono" >
                           </div>
                           <div class="p-2 col-md-2 col-sm-2">
                                <input type="text" class="form-control" placeholder="Extension" name="extension" >
                           </div>
                           <div class="p-2 col-md-12 col-sm-12">
                                <textarea class="form-control" rows="8" placeholder="Su mensaje aquí" name="mensaje" required></textarea>
                           </div>
                           <div class="p-2 col-md-4 col-sm-4">
                                <button type="submit" class="form-control" name="enviar_datos" value="Enviar Mensaje">
                                    <i class="fas fa-email"></i>Enviar Datos</button>
                           </div>
                      </form>
                 </div>
            </div>
       </div>
  </section>
  @endsection
