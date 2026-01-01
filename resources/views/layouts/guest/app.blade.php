@extends('layouts.guest.base')

@section('content')

    <body class="min-h-screen flex flex-col bg-white"></body>
    <x-guest-nav />

    @yield('page-content')

    <x-guest-footer />

    <script src="{{ asset('/js/main.js') }}"></script>
    <script src="{{ asset('/js/mobileMenu.js') }}"></script>

    </body>
@endsection
