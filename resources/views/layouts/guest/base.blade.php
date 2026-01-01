<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> @yield('title') | {{ config('app.name') }} </title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('/icons/graduation-cap.svg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: "Inter", sans-serif;
            font-size: 13px;
        }

        .form-label {
            font-size: 11px;
            font-weight: 600;
            color: #4b5563;
            margin-bottom: 4px;
            display: block;
            letter-spacing: 0.025em;
        }

        .form-input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 13px;
            outline: none;
            background: #f9fafb;
            transition: all 0.2s;
        }

        .form-input:focus {
            border-color: #1e3a8a;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
        }

        .section-title {
            font-size: 14px;
            font-weight: 700;
            color: #1e3a8a;
            border-left: 4px solid #1e3a8a;
            padding-left: 12px;
            margin-bottom: 20px;
        }

        body {
            font-size: 13px;
            line-height: 1.5;
        }

        h1 {
            font-size: 2.5rem;
        }

        h2 {
            font-size: 2rem;
        }

        h3 {
            font-size: 1.25rem;
        }

        p {
            font-size: 13px;
        }

        .text-xl {
            font-size: 1.1rem;
        }

        .text-sm {
            font-size: 12px;
        }

        .text-xs {
            font-size: 10px;
        }

        .form-label {
            font-size: 11px;
            font-weight: 600;
            color: #19214d;
            margin-bottom: 4px;
            display: block;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .form-input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 13px;
            outline: none;
            background: #f9fafb;
            transition: all 0.2s;
        }

        .form-input:focus {
            border-color: #6b8dd6;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(107, 141, 214, 0.1);
        }

        .section-title {
            font-size: 14px;
            font-weight: 700;
            color: #19214d;
            border-left: 4px solid #6b8dd6;
            padding-left: 12px;
            margin-bottom: 20px;
        }

        .mobile-menu {
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
        }

        .mobile-menu.active {
            transform: translateX(0);
        }

        :root {
            --navy-50: #f2f3f7;
            --navy-100: #d9dbe6;
            --navy-200: #bfc2d5;
            --navy-300: #a5a9c4;
            --navy-400: #8b90b3;
            --navy-500: #7076a1;
            --navy-600: #565d80;
            --navy-700: #3c4360;
            --navy-800: #222940;
            --navy-900: #19214d;
        }

        /* Utility classes similar to Tailwind */
        .bg-navy-50 {
            background-color: var(--navy-50);
        }

        .bg-navy-100 {
            background-color: var(--navy-100);
        }

        .bg-navy-200 {
            background-color: var(--navy-200);
        }

        .bg-navy-300 {
            background-color: var(--navy-300);
        }

        .bg-navy-400 {
            background-color: var(--navy-400);
        }

        .bg-navy-500 {
            background-color: var(--navy-500);
        }

        .bg-navy-600 {
            background-color: var(--navy-600);
        }

        .bg-navy-700 {
            background-color: var(--navy-700);
        }

        .bg-navy-800 {
            background-color: var(--navy-800);
        }

        .bg-navy-900 {
            background-color: var(--navy-900);
        }

        .text-navy-50 {
            color: var(--navy-50);
        }

        .text-navy-100 {
            color: var(--navy-100);
        }

        .text-navy-200 {
            color: var(--navy-200);
        }

        .text-navy-300 {
            color: var(--navy-300);
        }

        .text-navy-400 {
            color: var(--navy-400);
        }

        .text-navy-500 {
            color: var(--navy-500);
        }

        .text-navy-600 {
            color: var(--navy-600);
        }

        .text-navy-700 {
            color: var(--navy-700);
        }

        .text-navy-800 {
            color: var(--navy-800);
        }

        .text-navy-900 {
            color: var(--navy-900);
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
