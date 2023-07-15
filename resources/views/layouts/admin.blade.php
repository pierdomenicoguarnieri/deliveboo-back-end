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

  <link rel="shortcut icon" href="/img/Ghost_Orange.svg" type="svg">

  <!-- FontAwesome -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.css' integrity='sha512-Z0kTB03S7BU+JFU0nw9mjSBcRnZm2Bvm0tzOX9/OuOuz01XQfOpa0w/N9u6Jf2f1OAdegdIPWZ9nIZZ+keEvBw==' crossorigin='anonymous'/>

  <!-- Usando Vite -->
  @vite(['resources/js/admin.js', 'resources/scss/admin.scss'])
</head>

<body>
  <div id="app">
    <main class="px-2 px-md-4 px-lg-5 py-4">
      <div class="content-wrapper w-100 h-100 d-flex rounded-5 overflow-hidden">
        @include('layouts.partials.aside-admin')

        <div class="main-content-wrapper w-100 px-2 py-4 d-flex align-items-center justify-content-center overflow-x-scroll">
          @yield('content')
        </div>
      </div>
    </main>
  </div>
</body>

</html>
