@extends('layouts.base')

@section('content')

    <body class="bg-slate-50 flex h-screen overflow-hidden overflow-y-scroll scrollbar-hide">
        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    showSuccess("{{ session('success') }}");
                });
            </script>
            @php
                session()->forget('success');
            @endphp
        @endif

        <x-dashboard-sidebar />
        @yield('page-content')
        <script src="{{ asset('/js/dashboardSidebar.js') }}"></script>
        <script src="{{ asset('/js/scrollRestorer.js') }}"></script>
        <script src="{{ asset('/js/successAlert.js') }}"></script>


    </body>
@endsection
