<!DOCTYPE html>
<html>
<head>
    <title>App shop</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="/js/app.js"></script>
    <link href="{{asset('css/app.css')}}" rel="stylesheet">

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    @yield('styles')
    @stack('styles')
</head>

<body>
    @yield('body')
    @yield('scripts')
    @stack('scripts')
</body>

</html>
