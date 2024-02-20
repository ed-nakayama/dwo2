@php
	$today = date('Y/m/d');
@endphp
@if (config('dwo.MSG_START_DATE') <= $today && config('dwo.MSG_END_DATE') >= $today)
消費税について
　商品出荷時における法定税率にて課税させていただきます。
@endif