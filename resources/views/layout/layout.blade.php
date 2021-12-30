<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>word.dance</title>

        <!-- Fonts -->
        <link href="{{asset('css/app.css')}}" rel="stylesheet">

        @include('feed::links')

    </head>
    <body>
<div class="container is-flex-desktop">

<!-- Header -->

    @include('layout.header')
    <!--
    @include('layout.advertisement')
    //-->
    @yield('content')

    @include('layout.footer')
    <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>
