@extends('layouts.app')
@section('content')

<div class="container">
    <h3>Colaboradores</h3>
    <div class="p-3 row">
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
              <td>{{$empleado->correo_EEmp->email_empresa}}.<br>
                  @if($empleado->correo_EEmp->email_personal!=null)
                    {{$empleado->correo_EEmp->email_personal}}. <br>
                  @endif
              </td>
              <td>
              @foreach($empleado->telefonos_EEmp as $telefono)
                @if($telefono->numero && $telefono->extension)
                  {{ $telefono-> numero." Ext: ".$telefono-> extension }}
                @elseif($telefono->numero && $telefono->extension==null)
                    {{ $telefono-> numero }}
                @else
                @endif
              @endforeach</td>
            <td><button class="btn" title="Editar" type="button" onclick= "location.href='{{ route('VerEditorEmpleado',['uuid'=>$empleado->where('uuid',$empleado->uuid)->pluck('uuid')->first() ]) }}'"><i class="fas fa-edit "></i> </button>
                <button class="btn" title="Eliminar" type="button" onclick= "location.href='{{ route('EliminarEmpleado',['uuid'=>$empleado->where('uuid',$empleado->uuid)->pluck('uuid')->first() ]) }}'"><i class="fas fa-dumpster-fire"></i></button>
            </td>
          </tr>
          @endif
        @endforeach
      </tbody>
    </table>
    <div class="p-3">
    </div>
  </div>
@endsection
