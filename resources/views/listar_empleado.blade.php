@extends('layouts.app')
@section('content')

<div class="container">
    <h3>Colaboradores</h3>
    <div class=" row justify-content-end">
          <form action="{{ route('VerRegistroEmpleado') }}" method="get">
            @csrf
            <button type="submit" class="btn btn-primary" >Registrar Empleado</button>
          </form>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Curp</th>
          <th scope="col">RFC</th>
          <th scope="col">NSS</th>
          <th scope="col">Correos</th>
          <th scope="col">Telefonos</th>
            <th scope="col">Operaciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($empleados as $empleado)
          @if($empleado->correo_EEmp->email_empresa != "admin@oshuntrading.com")
            <tr>
              <td>{{ $empleado->persona_EEmp->primer_nombre." ".$empleado->persona_EEmp->segundo_nombre." ".$empleado->persona_EEmp->apellido_paterno." ".$empleado->persona_EEmp->apellido_materno  }}</td>
              <td>{{$empleado->curp}}</td>
              <td>{{$empleado->rfc}}</td>
              <td>{{$empleado->n_seguro_social}}</td>
              <td>{{$empleado->correo_EEmp->email_empresa}}.<br> Correo empresa <br>
                  @if($empleado->correo_EEmp->email_personal!=null)
                    {{$empleado->correo_EEmp->email_personal}}. <br>Correo Personal
                  @endif
              </td>
              <td>
              @foreach($empleado->telefonos_EEmp as $telefono)

                  {{ $telefono-> numero." Ext: ".$telefono-> extension }}
                  {{$telefono->catalogoTelefonos_UTel->tipo}}
              @endforeach</td>
            <td><button class="btn" type="button" onclick= "location.href='{{ route('VerEditorEmpleado',['uuid'=>$empleado->where('uuid',$empleado->uuid)->pluck('uuid')->first() ]) }}'"><i class="fas fa-edit "></i> Editar</button>
                <button class="btn" type="button" onclick= "location.href='{{ route('EliminarEmpleado',['uuid'=>$empleado->where('uuid',$empleado->uuid)->pluck('uuid')->first() ]) }}'"><i class="fas fa-dumpster-fire"></i>Eliminar</button>
            </td>
          </tr>
          @endif
        @endforeach
      </tbody>
    </table>
    <div class="p-3">
      {{$empleados->links()}}
    </div>
  </div>
@endsection
