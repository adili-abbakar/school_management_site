@extends('layouts.base')

@section('content')

    <body class="bg-slate-50 flex h-screen overflow-hidden">
        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    showSuccess("{{ session('success') }}");
                });
            </script>
        @endif

        <x-dashboard-sidebar />
        @yield('page-content')
        <script src="{{ asset('/js/dashboardSidebar.js') }}"></script>
        <script src="{{ asset('/js/scrollRestorer.js') }}"></script>
        <script src="{{ asset('/js/successAlert.js') }}"></script>


    </body>
@endsection
