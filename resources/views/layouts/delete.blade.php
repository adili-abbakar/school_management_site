@extends('layouts.base')

@section('content')

    <body class=" min-h-screen flex items-center justify-center p-4 overflow-y-scroll scrollbar-hide"
        style="background-image: url('{{ asset('images/bg.png') }}');">
        @yield('page-content')
    </body>
@endsection
