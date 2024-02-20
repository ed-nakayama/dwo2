<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta http-equiv="Content-Type"content="text/html;charset=utf-8">
<title>弥生 WEB ORDER</title>
<link href="{{ asset('assets/cust/css/common.css') }}" rel="stylesheet">

</head>
<body topmargin="0">
	<center>
	<div id="main">
	
@include ('weborder.common.header')

{{ $slot }}


@include ('weborder.common.footer')

</div>
</center>
</body>
</html>