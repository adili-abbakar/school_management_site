@extends('layouts.base')

@section('content')

    <body class="bg-slate-50 flex h-screen overflow-hidden">
        <x-dashboard-sidebar />
        @yield('page-content')
        <script src="{{ asset('/js/dashboardSidebar.js') }}"></script>
    </body>
@endsection
