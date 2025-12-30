@extends('layouts.base')

@section('content')

    <body class="min-h-screen flex flex-col bg-white"></body>
    @yield('page-content')

    <script src="{{ asset('/js/main.js') }}"></script>
    <script src="{{ asset('/js/mobileMenu.js') }}"></script>

    </body>
@endsection
