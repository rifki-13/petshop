<!DOCTYPE html>
<html>
<head>
    <title>App shop</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script src="/js/app.js"></script>
    @yield('styles')
    @stack('styles')
</head>

<body>
    @yield('body')
    @yield('scripts')
    @stack('scripts')
</body>

</html>
