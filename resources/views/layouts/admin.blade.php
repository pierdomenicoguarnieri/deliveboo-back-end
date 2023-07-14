<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>


  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- FontAwesome -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.css' integrity='sha512-Z0kTB03S7BU+JFU0nw9mjSBcRnZm2Bvm0tzOX9/OuOuz01XQfOpa0w/N9u6Jf2f1OAdegdIPWZ9nIZZ+keEvBw==' crossorigin='anonymous'/>

  <!-- Usando Vite -->
  @vite(['resources/js/admin.js', 'resources/js/admin.scss'])
</head>

<body>
  <div id="app">

      <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
          <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            DELIVEBOO
          </a>

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
              <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">Vai al sito</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href=" {{ route('admin.home') }}">Dashboard</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href=" {{ route('admin.dishes.index') }}">Lista piatti</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href=" {{ route('admin.dishes.create') }}">Nuovo piatto</a>
              </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
              <!-- Authentication Links -->
              @guest
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                  </li>
                @endif
              @else
                <li class="nav-item">
                    <form
                        action="{{route('admin.dishes.index')}}"
                        class="d-flex me-5 search_dishes"
                        method="GET"
                    >
                        <input type="text" name="search" placeholder="Cerca piatto">
                        <button class="p-1"><i class="fa-solid fa-magnifying-glass ps-2"></i></button>
                    </form>
                </li>

                <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                      <i class="fa-solid fa-arrow-right-from-bracket pe-2"></i>
                      {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                    </form>
                    @if (Auth::user()->restaurant_id != null)
                      <a class="dropdown-item" href="{{ route('admin.restaurants.show', $restaurant) }}">
                        <i class="fa-regular fa-user pe-2"></i>
                        Profilo ristorante
                      </a>
                    @endif

                  </div>
                </li>
              @endguest
            </ul>
          </div>
        </div>
      </nav>


    <main class="">
      @yield('content')
    </main>
  </div>
</body>

</html>
