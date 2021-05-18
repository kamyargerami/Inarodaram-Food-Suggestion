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

    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-5C53TQH');</script>
</head>
<body>

@include('partials.nav')

@yield('content')

<script src="{{asset('js/app.js')}}"></script>
@yield('script')
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5C53TQH"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
</body>
</html>
