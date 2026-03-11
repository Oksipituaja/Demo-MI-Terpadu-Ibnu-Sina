<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('storage/MI-Terpadu-Ibnu-Sina-Kembang-Jepara-Logo.png') }}" type="image/x-icon" alt="Logo">

    <title>@yield('title', 'MI Terpadu Ibnu Sina')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>
