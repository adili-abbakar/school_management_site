<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Error')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}" />

</head>

<body>
    <main class="relative min-h-screen flex items-center justify-center overflow-hidden px-4 py-10">

        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('images/bg.png') }}');">
        </div>

        <div class="absolute inset-0 bg-white/60">
        </div>

        <div class="relative z-10 w-full max-w-xl">
            @yield('content')
        </div>

    </main>
</body>

</html>
