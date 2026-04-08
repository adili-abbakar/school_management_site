@extends('layouts.guest.base')

@section('content')

    <body class="min-h-screen flex flex-col bg-white overflow-y-scroll scrollbar-hide"></body>
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
