@extends('layouts.base')

@section('content')

    <body class="flex h-screen overflow-hidden overflow-y-scroll scrollbar-hide"
        style="background-image: url('{{ asset('images/bg.png') }}');">

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
        @if (session('failure'))
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    showFailure("{{ session('failure') }}");
                });
            </script>
            @php
                session()->forget('failure');
            @endphp
        @endif
        @if (session('info'))
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    showInfo("{{ session('info') }}");
                });
            </script>
            @php
                session()->forget('info');
            @endphp
        @endif
        <x-dashboard-sidebar />
        @yield('page-content')
        <script src="{{ asset('/js/dashboardSidebar.js') }}"></script>
        <script src="{{ asset('/js/scrollRestorer.js') }}"></script>
        <script src="{{ asset('/js/successAlert.js') }}"></script>
        <script src="{{ asset('js/failureAlert.js') }}"></script>
        <script src="{{ asset('js/infoAlert.js') }}"></script>


    </body>
@endsection
