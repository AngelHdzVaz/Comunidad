@extends('layouts.app')
@section('content')
<div class="container">
  <section class="row">
  	<article class="col-md-8">
  		<div class="page-header">

  			<h1>Editar o crear post</h1>
  		</div>
  		<form method="POST" action="{{ route('RegistrarNoticia') }}">
        @csrf
        <div class="form-group row ">
    			<label for="titulo">Título</label>
          <input id="ipt_titulo" type="text" class="form-control " name="titulo" value="{{ old('primer_nombre') }}" placeholder="Título..." >
    			<label for="fecha">Fecha de publicacion</label>
    				<input type="date" name="fecha" id="ipt_fecha" class="form-control" placeholder="">
    			<label for="resumen">Resumen</label>
    				<textarea type="text" name="resumen" id="ipt_resumen" class="form-control" placeholder="Resumen..." rows="3"></textarea>
    			<label for="descripcion">Descripción</label>
    				<textarea type="text" name="descripcion" id="ipt_descripcion" class="form-control" placeholder="Descripcion.." rows="7"></textarea>
    			<label for="titulo">Publicar?</label>
    				<select name="activo" id="ipt_activo" class="form-control">
    					<option value="0">NO</option>
    					<option value="1">SI</option>
    				</select>
          <label for="titulo">Evento?</label>
    				<select name="evento" id="ipt_evento" class="form-control">
    					<option value="0">NO</option>
    					<option value="1">SI</option>
    				</select>
          <br>
        </div>
          <button type="submit" class="btn btn-primary"> Guardar </button>
  		</form>
  	</article>
  </section>
</div>
@endsection
