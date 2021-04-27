<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Grupo RICSO</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('vendor/fontawesome-5.15.0/js/all.min.js') }}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-5.15.0/css/all.min.css') }}" rel="stylesheet">
    @if(Route::currentRouteName() == 'welcome')
      <script src="{{ asset('js/jquery.js') }}"></script>
      <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
      <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
      <script src="{{ asset('js/smoothscroll.js') }}"></script>
      <script src="{{ asset('js/custom.js') }}"></script>
    @endif

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app-expansion.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.css') }}">

      <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    @if(Route::currentRouteName() == 'welcome')
      <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
      <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
      <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
      <link rel="stylesheet" href="css/tooplate-style.css">
        <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    @endif
</head>
<body>
  @if(session('titulo'))
    <script>
      Swal.fire({
        title: '{{ session("titulo") }}',
        html: '{{ session("mensaje") }}',
        icon: '{{ session("tipo") }}'
      });
    </script>
  @endif

  @if(Route::currentRouteName() == 'welcome')
    <div id="app">
      <section class="preloader">
           <div class="spinner">

                <span class="spinner-rotate"></span>

           </div>
      </section>
      <!-- MENU -->
      <section class="navbar custom-navbar navbar-fixed-top" role="navigation">
           <div class="container">
                <!-- MENU LINKS -->
                <div class="collapse navbar-collapse">
                          @guest
                          <a href="location.href='{{ route('welcome') }}'" class="navbar-brand smoothScroll">
                            <img src="{{asset('images/comunity.jpg')}}" width="50" height="50" alt="">
                          </a>
                          @else
                          <a href="location.href='{{ route('home') }}'" class="navbar-brand smoothScroll">Home</a>
                          @endguest
                          <a href="#feature" class=" navbar-brand smoothScroll">Features</a>
                          <a href="#about" class="navbar-brand smoothScroll">About us</a>
                          <a href="#pricing" class="navbar-brand smoothScroll">Pricing</a>
                         <a href="#contact" class="navbar-brand smoothScroll">Contact</a>
                     <ul class="nav navbar-nav navbar-right">
                             <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                     <!-- Authentication Links -->
                                     @guest
                                         @if (Route::has('login'))
                                             <li class="nav-item">
                                                 <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                                             </li>
                                         @endif
                                         @if (Route::has('register'))
                                             <li class="nav-item">
                                                 <a class="nav-link" href="{{ route('VerPreregistro') }}">{{ __('Preregistro') }}</a>
                                             </li>
                                         @endif
                                     @else
                                         <li class="nav-item dropdown">
                                             <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                 {{ Auth::user()->name }}
                                             </a>
                                             <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                 <a class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                                  document.getElementById('logout-form').submit();">
                                                     {{ __('Logout') }}
                                                 </a>
                                                 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                     @csrf
                                                 </form>
                                             </div>
                                         </li>
                                     @endguest
                             </div>
                     </ul>
                </div>
           </div>
      </section>
    </div>
    @else
      <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
          <div class="container">
          <a class="nav-link" href="{{ url('/ ') }}">
              <img src="{{asset('images/comunity.jpg')}}" width="70" height="70" alt="">
          </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
              <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <!-- Left Side Of Navbar -->
              <ul class="nav navbar-nav navbar-right">
                  <!-- Authentication Links -->
                  @guest
                      @if (Route::has('login'))
                          <li class="nav-item">
                              <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                          </li>
                      @endif
                      @if (Route::has('register'))
                          <li class="nav-item">
                              <a class="nav-link" href="{{ route('VerPreregistro') }}">{{ __('Preregistro') }}</a>
                          </li>
                      @endif
                  @else
                      <li class="nav-item dropdown">
                          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                              {{ Auth::user()->name }}
                          </a>
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{ route('logout') }}"
                                 onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                  {{ __('Logout') }}
                              </a>
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                  @csrf
                              </form>
                            </div>
                          </li>
                        @endguest
                    </ul>
              </div>
              </div>
            </nav>
          </div>
          @endif
      @yield('content')
</body>
</html>
