<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta http-equiv="Content-Type"content="text/html;charset=utf-8">
<link href="{{ asset('assets/cust/css/common.css') }}" rel="stylesheet">

</head>
<body>
<center>
<div id="main">

@include ('weborder.common.header')

@include ('weborder.common.menu')

{{ $slot }}

@include ('weborder.common.footer')

</div>
</center>
</body>
</html>