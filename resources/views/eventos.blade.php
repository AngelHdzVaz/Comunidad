@extends('layouts.app')
@section('content')
<h1>Eventos</h1>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>

</head>
<body>
<div class="row g-5">
  <div class="col-md-8">
    @foreach($lista_eventos as $evento)
      <article class="blog-post">
        <h2 class="blog-post-title">{{ $evento->titulo  }}</h2>
        <p class="blog-post-meta">{{ $evento->fecha_publicacion  }} publicado: <a href="#">{{ $evento->autor_pub->primer_nombre." ".$evento->autor_pub->apellido_paterno  }}</a></p>
        <p>{{ $evento->resumen}}</p>
        <hr>
        <p>{{ $evento->cuerpo}}</p>
      </article>
    @endforeach
  </div>

  <div class="col-md-4">
    <div class="position-sticky" style="top: 2rem;">
      <div class="p-4 mb-3 bg-light rounded">
        <h4 class="fst-italic">Comunidad</h4>
        <p class="mb-0">Intranet desarrollada para dar comunicados, y facilitar la distribución
          de información general a todo el personal miembro de la empresa(s).
        </p>
      </div>

      <div class="p-4">
        <h4 class="fst-italic">Publicaciones</h4>
        <ol class="list-unstyled mb-0">
          <li><a href="#">Mayo 2021</a></li>
          <li><a href="#">Junio 2021</a></li>
          <li><a href="#">Julio 2021</a></li>
          <li><a href="#">Agosto 2021</a></li>
          <li><a href="#">Septiembre 2021</a></li>
          <li><a href="#">Octubre 2021</a></li>
          <li><a href="#">Noviembre 2021</a></li>
          <li><a href="#">Diciembre 2021</a></li>
          <li><a href="#">Enero 2021</a></li>
          <li><a href="#">Febrero 2021</a></li>
          <li><a href="#">Marzo 2021</a></li>
          <li><a href="#">Abril 2021</a></li>
        </ol>
      </div>

      <div class="p-4">
        <h4 class="fst-italic">Otras Secciones</h4>
        <ol class="list-unstyled">
          <li><button class="btn" type="button" onclick= "location.href='{{ route('Cumpleanios')}}'"><i class="fas fa-birthday-cake"></i> Cumpleaños</button></li>
          <li><button class="btn" type="button" onclick= "location.href='{{ route('Calendario')}}'"><i class="far fa-calendar-alt"></i> Calendario</button></li>
          <li><button class="btn" type="button" onclick= "location.href='{{ route('Eventos')}}'"><i class="far fa-star"></i> Eventos</button></li>
        </ol>
      </div>
    </div>
  </div>
</div>
</body>
</html>
</div>
@endsection
