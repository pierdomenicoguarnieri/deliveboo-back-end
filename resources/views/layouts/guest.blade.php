<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" href="/img/Ghost_Orange.svg" type="svg">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/guest.scss', 'resources/js/guest.js'])
  </head>

  <body>
    <div id="app">
      <main class="px-2 px-md-4 px-lg-5 py-4">
        <div class="content-wrapper w-100 h-100 d-flex rounded-5 overflow-hidden">
          <div class="main-content-wrapper w-100 px-2 py-4 d-flex align-items-center justify-content-center">
            @yield('content')
          </div>
        </div>
      </main>
    </div>
  </body>
</html>
