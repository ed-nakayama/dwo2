<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
</HEAD>

<body topmargin="0">
	<center>
	<div id="main">

{{--  header --}}
@if ( config('dwo.APPLICATION_ENV') != 'PRODUCTION')
	<center>
	<div style="background-color:{{ config('dwo.APPLICATION_ENV_BARCOLOR') }};color:{{ config('dwo.APPLICATION_ENV_FONTCOLOR')  }};font-weight:bolder">
		{{ config('dwo.APPLICATION_ENV_TITLE') }} 今日の日付：{{ date('Y年m月d日') }}
	</div>
	</center>
@endif

	<main>
		<br>
		{{ $slot }}
	</main>

</div>
</center>
</body>
</html>