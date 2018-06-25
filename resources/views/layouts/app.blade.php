<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    {{--<script src="{{asset('js/app.js')}}" defer></script>--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    {{--<script src="{{ URL::asset('js/jquery.js') }}"></script>--}}
    {{--<script src="{{ URL::asset('js/popper.js') }}" defer></script>--}}
    <script src="{{ URL::asset('js/bootstrap.js') }}" defer></script>
    <script src="{{ URL::asset('js/bootstrap-multiselect.js') }}" defer></script>
    <script src="{{ URL::asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    {{--<link rel="dns-prefetch" href="https://fonts.gstatic.com">--}}
    {{--<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">--}}

    <!-- Styles -->
    {{--<link rel="stylesheet" href="{{asset('css/app.css')}}">--}}
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link href="{{ URL::asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/bootstrap-multiselect.css') }}" rel="stylesheet">
    {{--<link href="{{ URL::asset('css/choice.css') }}" rel="stylesheet">--}}
    {{--<link href="{{ URL::asset('css/fontawesome-all.css') }}" rel="stylesheet">--}}
    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    @if(Session::has('message'))
{{--        <p class="alert alert-info">{{ Session::get('message') }}</p>--}}
        <div class="alert alert-success" id="message-bar">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Message! </strong>
            {{ Session::get('message') }}
        </div>
    @endif
    <div id="app">

        <nav class="navbar menucls">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        @guest
                        @else
                            @role('user')
                                <li><a href="{{ url('/book') }}">Book</a></li>
                                <li><a href="{{ url('/author') }}">Author</a></li>
                                <li><a href="{{ url('/genre') }}">Genre</a></li>
                            @endrole
                            @role(['admin', 'content'])
                                {{--<li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>--}}
                                <li class="dropdown">
                                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Book <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ url('/book/index') }}">List</a></li>
                                        <li><a href="{{ url('/book/create') }}">Create</a></li>
                                        <li><a href="{{ url('/book/download') }}">Download</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Author <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ url('/author/index') }}">List</a></li>
                                        <li><a href="{{ url('/author/create') }}">Create</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Genre <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ url('/genre/index') }}">List</a></li>
                                        <li><a href="{{ url('/genre/create') }}">Create</a></li>
                                    </ul>
                                </li>
                            @endrole
                            @role('admin')
                                <li class="dropdown">
                                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">User <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ url('/user/index') }}">List</a></li>
                                        <li><a href="{{ url('/user/create') }}">Create</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown"></li>

                            <li><a class="nav-link" href="{{ url('/role') }}">{{ __('Role') }}</a></li>
                            @endrole
                        @endguest
                    </ul>
                    {{--<form class="navbar-form navbar-left" role="search">--}}
                        {{--<div class="form-group">--}}
                            {{--<input type="text" class="form-control" placeholder="Find">--}}
                        {{--</div>--}}
                        {{--<button type="submit" class="btn btn-success">Go</button>--}}
                    {{--</form>--}}
                    <ul class="nav navbar-nav navbar-right">

                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="https://www.jquery-az.com/about-us/">Terms</a></li>
                                <li><a href="https://www.jquery-az.com/contact/">Contact</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>


        <main class="py-4">
            @yield('content')
        </main>
        <script></script>
    </div>
</body>
</html>
