<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="author" content="Kamyar Gerami">
    <link rel="icon" href="{{asset('images/favicon.png')}}" type="image/png">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @yield('style')
</head>
<body>

@include('partials.nav')

@yield('content')

<script src="{{asset('js/app.js')}}"></script>
@yield('script')
</body>
</html>
