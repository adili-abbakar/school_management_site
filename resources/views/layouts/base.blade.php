<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title') | {{ config('app.name') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('/icons/graduation-cap.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('/js/jquery-3.7.1.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}" />

    <style>
        /* Reduced all font sizes significantly for dashboard */
        body {
            font-family: 'Inter', sans-serif;
            font-size: 11px;
        }

        h1 {
            font-size: 1.5rem;
        }

        h2 {
            font-size: 1.25rem;
        }

        h3 {
            font-size: 1rem;
        }

        h4 {
            font-size: 0.875rem;
        }

        p {
            font-size: 11px;
        }

        .text-xs {
            font-size: 11px;
        }

        .text-sm {
            font-size: 12px;
        }

        .text-base {
            font-size: 13px;
        }

        .text-lg {
            font-size: 14px;
        }

        .text-xl {
            font-size: 15px;
        }

        .text-2xl {
            font-size: 1.25rem;
        }

        .text-3xl {
            font-size: 1.5rem;
        }

        /* Added mobile sidebar animation */
        .sidebar-link.active {
            background-color: #1e293b;
            color: #3b82f6;
            border-right: 4px solid #3b82f6;
        }

        .mobile-sidebar {
            transition: transform 0.3s ease-in-out;
        }

        /* Hidden on mobile */
        @media (max-width: 767px) {
            .mobile-sidebar {
                transform: translateX(-100%);
            }

            .mobile-sidebar.active {
                transform: translateX(0);
            }
        }

        /* Chrome, Safari, Opera */
        html::-webkit-scrollbar,
        body::-webkit-scrollbar {
            display: none;
        }

        /* IE, Edge */
        html,
        body {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        .fade-in {
            animation: fadeIn .2s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(4px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 50;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background: white;
            border-radius: 12px;
            padding: 32px;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-approved {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-rejected {
            background-color: #fee2e2;
            color: #7f1d1d;
        }

        .status-withdrawn {
            background-color: #f1f5f9;
            color: #475569;
        }

        .document-preview {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 16px;
            text-align: center;
            background: #f8fafc;
            transition: all 0.3s ease;
        }

        .document-preview:hover {
            border-color: #3b82f6;
            background: #f0f4f8;
        }

        .document-icon {
            font-size: 2.5rem;
            margin-bottom: 8px;
            color: #3b82f6;
        }

        /* Hide scrollbar but allow scrolling */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            /* IE & Edge */
            scrollbar-width: none;
            /* Firefox */
        }
    </style>
</head>

@yield('content')

</html>
