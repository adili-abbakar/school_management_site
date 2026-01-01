<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title') | {{ config('app.name') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('/icons/graduation-cap.svg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1a2b4b',
                        secondary: '#f0f4f8',
                        accent: '#3b82f6',
                        muted: '#6b7280',
                        sidebar: '#0f172a',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

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
            font-size: 9px;
        }

        .text-sm {
            font-size: 10px;
        }

        .text-base {
            font-size: 11px;
        }

        .text-lg {
            font-size: 12px;
        }

        .text-xl {
            font-size: 13px;
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
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }

        .mobile-sidebar.active {
            transform: translateX(0);
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
    </style>
</head>


@yield('content')

</html>
