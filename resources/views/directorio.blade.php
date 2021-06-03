@extends('layouts.app')
@section('content')

<div class="container">
    <h3>Directorio </h3>
    <div class=" row justify-content-end">
    </div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Correos</th>
          <th scope="col">Telefonos</th>
        </tr>
      </thead>
      <tbody>
        @foreach($empleados as $empleado)

        <tr>
        <td>{{ $empleado->persona_EEmp->primer_nombre." ".$empleado->persona_EEmp->segundo_nombre." ".$empleado->persona_EEmp->apellido_paterno." ".$empleado->persona_EEmp->apellido_materno  }}</td>
        <td>{{$empleado->correo_EEmp->email_empresa}}.<br> 
        </td>
        <td>
          @foreach($empleado->telefonos_EEmp as $telefono)

              {{ $telefono-> numero." Ext: ".$telefono-> extension }}
              {{$telefono->catalogoTelefonos_UTel->tipo}}<br>
          @endforeach</td>

        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="p-3">
      {{$empleados->links()}}
    </div>
  </div>
@endsection
