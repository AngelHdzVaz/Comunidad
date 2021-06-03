@extends('layouts.app')
@section('content')
<html>
  <head>
    <title></title>
    <meta content="">
    <style>
      body{
        font-family: 'Exo', sans-serif;
      }
      .header-col{
        background: #E3E9E5;
        color:#536170;
        text-align: center;
        font-size: 20px;
        font-weight: bold;
      }
      .header-calendar{
        background: #EE192D;color:white;
      }
      .box-day{
        border:1px solid #E3E9E5;
        height:150px;
      }
      .box-dayoff{
        border:1px solid #E3E9E5;
        height:150px;
        background-color: #ccd1ce;
      }
    </style>
  </head>
  <body>
    <div class="container">

      <h3>Evento</h3>
      <p>Detalles de evento</p>
      <a class="btn btn-default"  href="{{ route('Calendario') }}">Atras</a>
      <hr>
      <div class="col-md-3">
        </div>
      <div class="col-md-6">
        <form action="{{ route('ActualizarEvento') }}" method="post">
          <div class="fomr-group row">
            <h4>Titulo</h4>
            <div class="p-3 col-md-12">
              <input type="hidden" name="id" value="{{ $event->id }}">
              <input id="ipt_titulo" type="text" class="form-control col-md-6" name="titulo" value="{{ $event->titulo }}" >
            </div>
            <br>
            <h4>Descripcion del Evento</h4>
            <div class="p-3 col-md-12">
              <input id="ipt_descripcion" type="text" class="form-control col-md-6" name="descripcion" value="{{ $event->descripcion }}" >
            </div>
            <br/>
            <h4>Fecha</h4>
            <div class="p-3 col-md-12">
              <input id="ipt_fecha" type="text" class="form-control col-md-6" name="fecha" value="{{ $event->fecha }}" >
            </div>
            <div class="p-3 col-md-12">
            </div>
          </div>
        </form>

      <button type="submit" class="col-md-6 btn btn-primary align-center" >Guardar </button>
      </div>
      <div class="col-md-3">
        </div>
      <!-- inicio de semana -->
    </div> <!-- /container -->
  </body>
</html>
@endsection
