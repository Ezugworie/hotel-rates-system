<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Hotel Rates System') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="min-h-screen">
        <nav class="shadow-md z-50 bg-gray-500 flex w-full p-5">
            <div class="flex w-full flex-row justify-between">
                <a class="text-gray-50 self-center ml-5 font-semibold text-lg uppercase" href="{{ url('/') }}">
                    {{ __('Hotel Rates System') }}
                </a>

                <div class="flex mr-5" id="navbarSupportedContent">

                    <!-- Right Side Of Navbar -->
                    <ul class="flex space-x-4">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li>
                                    <a class="flex hover:text-gray-500 hover:bg-gray-50 shadow-md text-white capitalize border border-white rounded px-4 py-1" 
                                    href="{{ route('login') }}">
                                        {{ __('Login') }}
                                    
                                    <span class="ml-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                        </svg>
                                    </span>
                                    </a>
                                </li>
                            @endif

                        @else
                            <li class="flex space-x-5">
                            
                            <div class="items-center flex" aria-labelledby="navbarDropdown">
                                    <a class="flex hover:text-gray-500 hover:bg-gray-50 shadow-md text-white capitalize border border-white rounded px-4 py-1" 
                                        href="{{ route('home') }}"
                                       >
                                        {{ __('Hotels') }}
                                        <span class="ml-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                        </span>
                                    </a>
                            </div>
                            <div class="items-center flex" aria-labelledby="navbarDropdown">
                                    <a class="flex hover:text-gray-500 hover:bg-gray-50 shadow-md text-white capitalize border border-white rounded px-4 py-1" 
                                        href="{{ url('home/hotel-rate') }}"
                                       >
                                        {{ __('rates') }}
                                        <span class="ml-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </span>
                                    </a>
                            </div>
                                <div class="items-center flex" aria-labelledby="navbarDropdown">
                                    <a class="flex hover:text-gray-500 hover:bg-gray-50 shadow-md text-white capitalize border border-white rounded px-4 py-1" 
                                        href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                        <span class="ml-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                        </span>
                                    </a>
                                    <span class="flex text-white Capitalize px-4 py-1">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </span>
                                            {{ Auth::user()->name }}
                                    </span>

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

        <main class="">
            @yield('content')
        </main>
    </div>
</body>
</html>
