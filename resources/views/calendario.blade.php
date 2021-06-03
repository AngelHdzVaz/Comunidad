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
    @csrf
    <div class="container">
      <div style="height:50px"></div>
      <div class="text-left">
        <button type="submit" class="btn btn-primary " onclick="location.href='{{ route('VerNoticias') }}'"> Regresar</button>
      </div>
      <h3>Calendario - evento</h3>

      <a class="btn btn-default"  href="{{ route('VerCrearEvento') }}">Crear un evento</a>
      <hr>
      <div class="row header-calendar"  >
        <<?php
        $mesAnt = $data['last'];
        $mesSig = $data['next'];
      //  dd($mesAnt);
         ?>
         <script>
           var $mesAnt = '{{$data["last"]}}';
           var $mesSig = '{{$data["next"]}}';
         </script>

        <div class="col" style="display: flex; justify-content: space-between; padding: 10px;">
          <a  href="{{ route('MesAnterior',['month'=>$mesAnt]) }}" style="margin:10px;">
            <i class="fas fa-chevron-circle-left" style="font-size:30px;color:white;"></i>
          </a>
          <h2 style="font-weight:bold;margin:10px;"><?= $mespanish; ?> <small><?= $data['year']; ?></small></h2>
          <a  href="{{ route('MesSiguiente',['month'=>$mesSig]) }}/" style="margin:10px;">
            <i class="fas fa-chevron-circle-right" style="font-size:30px;color:white;"></i>
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col header-col">Lunes</div>
        <div class="col header-col">Martes</div>
        <div class="col header-col">Miercoles</div>
        <div class="col header-col">Jueves</div>
        <div class="col header-col">Viernes</div>
        <div class="col header-col">Sabado</div>
        <div class="col header-col">Domingo</div>
      </div>
      <!-- inicio de semana -->
      @foreach ($data['calendar'] as $weekdata)
        <div class="row">
        
          <!-- ciclo de dia por semana -->
          @foreach  ($weekdata['datos'] as $dayweek)

          @if  ($dayweek['mes']==$mes)
            <div class="col box-day">
              {{ $dayweek['dia']  }}
              <!-- evento -->
              @foreach  ($dayweek['evento'] as $event)
                  <a class="badge badge-primary" href="{{ asset('Evento/detalles/{id}') }}/{{ $event->id }}">
                    {{ $event->titulo }}
                  </a>
              @endforeach
            </div>
          @else
          <div class="col box-dayoff">
          </div>
          @endif
          @endforeach
        </div>
      @endforeach
    </div> <!-- /container -->
  </body>
</html>
@endsection
