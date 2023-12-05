<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/backoffice.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/backoffice.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
    <div id="app">
        <main class="main">
            <div class="row">

                <!-- Authentication Links -->
            @guest
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto">
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </nav>
            </div>
        @else
            <div class="container menu-small">
                <div class="collapse" id="navbarToggleExternalContent" data-bs-theme="light">
                    <div class="bg-light p-4">
                        <ol class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <a class="fw-bold text-decoration-none" href="{{route('admin.home')}}">Home</a>
                            </li> 
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <a class="fw-bold text-decoration-none" href="{{route('admin.orderitems.index')}}">Checkout</a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <a class="fw-bold text-decoration-none" href="{{route('admin.orders.index')}}">Orders</a>
                            </li>                          
                        </ol>
                    </div>
                </div>
                <nav class="navbar navbar-light bg-light">
                    <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    </div>
                </nav>
            </div>

            <div class="col-3 d-sm-none d-md-block">
                <div class="menu">
                    <h4 class="title-small">Menu</h4>

                    <a class="menu-button-dashboard gray-strong" href="{{route('admin.home')}}"><i class="bi bi-grid-fill fs-4"></i></a>
                    <a class="menu-button-big mt-3" href="{{route('admin.orderitems.index')}}"><i class="bi bi-box-seam-fill"></i> CHECKOUT</a>
                    <a class="menu-button-big mt-1" href="{{route('admin.orders.index')}}"><i class="bi bi-cart-check-fill"></i> ORDERS</a>

                    {{-- PART --}}
                    <div class="d-flex align-items-center mt-4">
                        <div class="circle lime me-2"></div>
                        <p class="mb-0 fw-bold">PART</p>
                    </div>
                    <div class="d-flex align-items-center w-100 mt-1">
                        <a class="menu-button" href="{{route('admin.parts.index')}}"><i class="bi bi-list"></i> View</a>
                        <a class="menu-button" href="{{route('admin.parts.create')}}"><i class="bi bi-plus-circle-fill"></i> Add New</a>
                    </div>

                    {{-- CATEGORY --}}
                    <div class="d-flex align-items-center mt-4">
                        <div class="circle orange me-2"></div>
                        <p class="mb-0 fw-bold">CATEGORY</p>
                    </div>
                    <div class="d-flex align-items-center w-100 mt-1">
                        <a class="menu-button" href="{{route('admin.categories.index')}}"><i class="bi bi-list"></i> View</a>
                        <a class="menu-button" href="{{route('admin.categories.create')}}"><i class="bi bi-plus-circle-fill"></i> Add New</a>
                    </div>

                    {{-- SUPPLIERS --}}
                    <div class="d-flex align-items-center mt-4">
                        <div class="circle azzurro me-2"></div>
                        <p class="mb-0 fw-bold">SUPPLIERS</p>
                    </div>
                    <div class="d-flex align-items-center w-100 mt-1">
                        <a class="menu-button" href="{{route('admin.manufacturers.index')}}"><i class="bi bi-list"></i> View</a>
                        <a class="menu-button" href="{{route('admin.manufacturers.create')}}"><i class="bi bi-plus-circle-fill"></i> Add New</a>
                    </div>

                    {{-- Logout --}}
                    <div class="d-flex align-items-center mt-4">
                        <div class="circle gray me-2"></div>
                        <p class="mb-0 fw-bold">SETTING</p>
                    </div>
                    <div class="d-flex align-items-center w-100 mt-1">
                        <a class="menu-button mt-1" href=""><i class="bi bi-person-circle"></i> {{ Auth::user()->name }}</a>
                        <a class="menu-button" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="bi bi-box-arrow-left"></i> Logout</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    </div>
                </div>
            </div>
        @endguest
        @guest
            <div class="col-12 mt-4">
        @else
            <div class="col-lg-9 pe-3 col-sm-12">
        @endguest
                    @yield('content')
                </div>
            </div>
            
        </main>
    </div>
</body>
</html>
