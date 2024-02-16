<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.tailwindcss.min.css">


  <!-- Scripts -->
  @vite(['resources/css/app.css'])

</head>

<body>
  <div id="app">

    <section class="navbar">
      @include('layouts.admin.topbar')

    </section>

    <section class="sidebar">
      @include('layouts.admin.sidebar')
    </section>

    <section class="content">
      <div class="p-4 sm:ml-64">
        <div class="rounded-lg dark:border-gray-700 mt-14">
          <main>
            @yield('content')
          </main>
        </div>
      </div>
    </section>



  </div>
</body>


@vite(['resources/js/app.js'])
@yield('jsScript')

</html>