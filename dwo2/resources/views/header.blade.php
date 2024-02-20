@if ( config('dwo.APPLICATION_ENV') != 'PRODUCTION')
<div style="background-color:{{ config('dwo.APPLICATION_ENV_BARCOLOR') }};color:{{ config('dwo.APPLICATION_ENV_FONTCOLOR')  }};font-weight:bolder">
	{{ config('dwo.APPLICATION_ENV_TITLE') }} 今日の日付：{{ date('Y年m月d日') }}
</div>
@endif
<table border="0" width="100%">
	<tr>
		<td>
		<img src="{{ asset('assets/cust/img/logo.jpg') }}">

		</td>
	</tr>
	<tr>
		<td width="100%">
		<h1 class="weborder" align="center"><img src="{{ asset('assets/cust/img/mainbar.png') }}" alt="Webオーダー" width="350px" height="50px"></h1>
		</td>
	</tr>
</table>
