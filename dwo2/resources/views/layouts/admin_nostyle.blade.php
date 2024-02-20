<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
	    <link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet">
	<link href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript" ></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" type="text/javascript"></script>
{{--
        @vite(['resources/css/app.css', 'resources/js/app.js'])
--}}

    </head>

    <body class="font-sans antialiased">
{{--  header --}}
@if ( config('dwo.APPLICATION_ENV') != 'PRODUCTION')
	<center>
	<div style="background-color:{{ config('dwo.APPLICATION_ENV_BARCOLOR') }};color:{{ config('dwo.APPLICATION_ENV_FONTCOLOR')  }};font-weight:bolder">
		{{ config('dwo.APPLICATION_ENV_TITLE') }} 今日の日付：{{ date('Y年m月d日') }}
	</div>
	</center>
@endif
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.admin_navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
{{--  footer --}}
@if ( config('dwo.APPLICATION_ENV') != 'PRODUCTION')
	<center>
		<div style="background-color:{{ config('dwo.APPLICATION_ENV_BARCOLOR') }};color:{{ config('dwo.APPLICATION_ENV_FONTCOLOR')  }};font-weight:bolder">{{ config('dwo.APPLICATION_ENV_TITLE') }}</div>
	</center>
@endif
    </body>
</html>
