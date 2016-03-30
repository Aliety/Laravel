<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}"/>

    <title>Laravel</title>

    <link href="/assets/css/glhqu.css" rel="stylesheet">

    @yield('styles')

    <style>
        body {
            font-family: 'Lato';
        }

        p {
            font-size: 20px;
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">

    @if (Auth::check())
        @include("layouts.partials.nav.user")
    @elseif (Auth::guard('teacher')->check())
        @include("layouts.partials.nav.teacher")
    @elseif (Auth::guard('admin')->check())
        @include('layouts.partials.nav.app')
    @else
        @include('layouts.partials.nav.master')
    @endif

    @yield('content')

    <script src="/assets/js/admin.js"></script>

    @yield('scripts')
</body>
</html>
