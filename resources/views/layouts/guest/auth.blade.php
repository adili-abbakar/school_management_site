@extends('layouts.guest.base')

@section('content')

    <body class=" min-h-screen flex items-center justify-center p-4 overflow-y-scroll scrollbar-hide"
        style="background-image: url('{{ asset('images/bg.png') }}');">
        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    showSuccess("{{ session('success') }}");
                });
            </script>
        @endif
        @yield('page-content')
        <script src="{{ asset('/js/successAlert.js') }}"></script>

    </body>
@endsection
