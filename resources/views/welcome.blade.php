<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <link href="{{ asset('css/morris.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

</head>
<body>
<div class="body-inner">
    <header id="header" data-fullwidth="true">
        <div class="header-inner">
            <div class="container">
                <!--Logo-->
                <div id="logo">
                    <a href="{{ asset('/') }}">
                        <span class="logo-default">Аукциончик</span>
                        <span class="logo-dark">Аукциончик</span>
                    </a>
                </div>
                <div id="mainMenu">
                    <div class="container">
                        <nav>
                            <ul>
                                @if (Auth::check())
                                    <li><a href="{{ asset('add') }}">Добавить</a></li>
                                @endif
                                <li><a href="{{ asset('catalog') }}">Каталог</a></li>
                                <li><a href="{{ asset('contacts') }}">Контакты</a></li>
                                <li><a href="{{ asset('services') }}">Сервисы</a></li>
                                <li><a href="{{ asset('blog') }}">Блог</a></li>
                                @if (Auth::check())
                                    @if (auth()->user()->role_id === 1)
                                        <li><a href="{{ asset('home') }}">Статистика</a></li>
                                    @endif
                                    <li class="dropdown"><a href="#">{{Auth::user()->name}}</a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                                    {{ __('Выход') }}
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                @else
                                    <li><a href="{{ asset('login') }}">Вход</a></li>
                                    <li><a href="{{ asset('register') }}">Регистрация</a></li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    @yield('content')

</div>
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/plugins.js')}}"></script>
<script src="{{asset('js/functions.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>
<script>
    let url = window.location.pathname;
    let substringArray = url.split("/");

    if (substringArray[1] === "catalog" && substringArray[2] === undefined){
        $('#js-category-all').addClass('active');
        $('#js-country-all').addClass('active');
        $('#js-price-all').addClass('active');
    }

    if (substringArray[2] === "category" && substringArray[3] !== undefined){
        $('#js-category-'+substringArray[3]).addClass('active');
        $('#js-country-all').addClass('active');
        $('#js-price-all').addClass('active');
    }

    if (substringArray[2] === "country" && substringArray[3] !== undefined){
        $('#js-country-'+substringArray[3]).addClass('active');
        $('#js-category-all').addClass('active');
        $('#js-price-all').addClass('active');
    }

    if (substringArray[2] === "price" && substringArray[3] !== undefined){
        $('#js-price-'+substringArray[3]).addClass('active');
        $('#js-country-all').addClass('active');
        $('#js-category-all').addClass('active');
    }
</script>
</body>
</html>
