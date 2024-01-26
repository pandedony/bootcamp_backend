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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div id="app">

        <nav class="bg-gray-800 p-4">
            <div class="container mx-auto flex justify-between items-center">
                <!-- Brand/logo -->
                <a href="#" class="text-white text-lg font-semibold">Your Brand</a>

                <!-- Navbar links -->
                <div class="hidden md:flex space-x-4">
                    <a href="#" class="text-white">Home</a>
                    <a href="#" class="text-white">About</a>
                    <a href="#" class="text-white">Services</a>
                    <a href="#" class="text-white">Contact</a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button x-data="{ open: false }" @click="open = !open" class="text-white focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>

                    <!-- Mobile menu -->
                    <div x-show="open" @click.away="open = false" class="absolute top-16 right-0 bg-gray-800 p-4">
                        <a href="#" class="block text-white mb-2">Home</a>
                        <a href="#" class="block text-white mb-2">About</a>
                        <a href="#" class="block text-white mb-2">Services</a>
                        <a href="#" class="block text-white">Contact</a>
                    </div>
                </div>
            </div>
        </nav>

        <nav class="bg-white shadow-sm">
            <div class="container mx-auto">
                <div class="flex justify-between items-center py-4">
                    <a class="text-lg font-semibold text-gray-800" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="lg:hidden" id="nav-toggle">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                    <div class="hidden lg:flex space-x-4">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @guest
                            @if (Route::has('login'))
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            @endif

                            @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                            @else
                            <div class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                            @endguest
                        </ul>

                    </div>
                </div>
            </div>
        </nav>


        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>