@extends('layouts.app')
@section('content')
<div class="container">
  <h1>Cumpleaños del mes</h1>
  <button type="submit" class="btn btn-primary " onclick="location.href='{{ route('VerNoticias') }}'"> Regresar</button>
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Fecha de cumpleaños</th>
      </tr>
    </thead>
    <tbody>
      @foreach($cumpleanios as $cumple)
      <tr>
        <td>{{$cumple->persona_EEmp->primer_nombre . " ". $cumple->persona_EEmp->segundo_nombre . " ". $cumple->persona_EEmp->apellido_paterno . " ". $cumple->persona_EEmp->apellido_materno}}</td>
        <td>{{ Carbon\Carbon::parse(strtotime($cumple->persona_EEmp->fecha_nacimiento))->formatLocalized('%d-%B ') }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
