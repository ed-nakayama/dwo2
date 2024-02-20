@php
	$today = date('Y/m/d');
@endphp
@if (config('dwo.MSG_START_DATE') <= $today && config('dwo.MSG_END_DATE') >= $today)
	<b>消費税について</b><br>
		　商品出荷時における法定税率にて課税させていただきます。<br><br>
@endif