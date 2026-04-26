@extends('layouts.guest.base')

@section('content')

    <body class="min-h-screen relative overflow-y-scroll scrollbar-hide bg-cover bg-center bg-fixed"
        style="background-image: url('{{ asset('images/bg.png') }}');">

        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    showSuccess("{{ session('success') }}");
                });
            </script>
        @endif

        <x-guest-nav />

        @yield('page-content')

        <x-guest-footer />

        <script src="{{ asset('/js/main.js') }}"></script>
        <script src="{{ asset('/js/mobileMenu.js') }}"></script>
        <script src="{{ asset('/js/successAlert.js') }}"></script>
        <script src="{{ asset('/js/scrollRestorer.js') }}"></script>

    </body>
@endsection
