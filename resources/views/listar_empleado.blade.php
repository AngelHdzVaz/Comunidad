@extends('layouts.app')
@section('content')

<div class="container">
    <h3>Lista de Colaboradores </h3>
    <div class=" row justify-content-end">
      @auth
        @if(Auth::user()->email == 'admin@oshuntrading.com')
          <form action="{{ route('VerRegistroEmpleado') }}" method="get">
            @csrf
            <button type="submit" class="btn btn-primary" >Registrar Empleado</button>
          </form>
        @endif
      @endauth
    </div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Fecha de Nacimiento</th>
          <th scope="col">Curp</th>
          <th scope="col">RFC</th>
          <th scope="col">NSS</th>
          <th scope="col">Correos</th>

          @auth
          @if(Auth::user()->email == 'admin@oshuntrading.com')
            <th scope="col">Operaciones</th>
          @endif
          @endauth
        </tr>
      </thead>
      <tbody>
        @foreach($empleados as $empleado)

        <tr>
        <td>{{ $empleado->primer_nombre ." ".$empleado->segundo_nombre." ".$empleado->apellido_paterno ." ".$empleado->apellido_materno  }}</td>
        <td>{{ $empleado->fecha_nacimiento}}</td>
        <td>{{$empleado->curp}}</td>
        <td>{{$empleado->rfc}}</td>
        <td>{{$empleado->n_seguro_social}}</td>
        <td>{{$empleado->correo_EEmp->email_empresa}}.<br> Correo empresa <br>
            {{$empleado->correo_EEmp->email_personal}}. <br>Correo Personal
        </td>
          @auth
          @if(Auth::user()->email == 'admin@oshuntrading.com')

          <td><button class="btn" type="button" onclick= "location.href='{{ route('VerEditorEmpleado',['uuid'=>$empleado->where('uuid',$empleado->uuid)->pluck('uuid')->first() ]) }}'"><i class="fas fa-edit "></i> Editar</button>
              <button class="btn" type="button" onclick= "location.href='{{ route('VerEditorEmpleado',['uuid'=>$empleado->where('uuid',$empleado->uuid)->pluck('uuid')->first() ]) }}'"><i class="fas fa-dumpster-fire"></i>Eliminar</button>
          </td>
          @endif
          @endauth
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
