@extends('layouts.app')
@section('content')
<div class="container">
  <section class="row">
  	<article class="col-md-8">
  		<div class="page-header">
      
  			<h1>Editar o crear post</h1>
  		</div>
  		<form action="">
  			<label for="titulo">Título</label>
  				<input type="text" name="titulo" id="ipt_titulo" class="form-control" placeholder="Título...">
  			<label for="fecha">Fecha de publicacion</label>
  				<input type="date" name="fecha" id="ipt_fecha" class="form-control" placeholder="">
  			<label for="resumen">Resumen</label>
  				<textarea type="text" name="resumen" id="ipt_resumen" class="form-control" placeholder="Resumen..." rows="3"></textarea>
  			<label for="descripcion">Descripción</label>
  				<textarea type="text" name="descripcion" id="ipt_descripcion" class="form-control" placeholder="Resumen..." rows="7"></textarea>
  			<label for="titulo">Publicado?</label>
  				<select name="activo" id="ipt_activo" class="form-control">
  					<option value="0">NO</option>
  					<option value="1">SI</option>
  				</select>
        <br>
  			<input type="submit" class="p-3 btn btn-success" value="Guardar">
  		</form>
  	</article>
  </section>
</div>
@endsection
