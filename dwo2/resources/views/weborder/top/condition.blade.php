<html>
<head>
<meta http-equiv="Content-Type"content="text/html;charset=utf-8">
<title>お取引条件</title>
<link rel="stylesheet"type=" text/css" href="{{ asset('assets/cust/css/common.css') }}">
</head>
<body>
<table border="0">
	<tr>
		<td colspan="2">
		<p class="sidebar">お取引条件</p></td>
	</tr>
	<tr>
		<td colspan="2"><p>
		ご利用ありがとうございます。<br />
		@if (!empty($lastupdate))
			前回のご利用日時は {{ substr( $lastupdate ,0,4) }}年
								{{ substr( $lastupdate ,5,2) }}月
								{{ substr( $lastupdate ,8,2) }}日
								{{ substr( $lastupdate ,11,2) }}時
								{{ substr( $lastupdate ,14,2) }}分 です。
		@else
			<br>
		@endif
		</p></td>
	</tr>
	<tr>
		<td colspan="2" height="60px">
			<table class="select" border="1"cellspacing="0"frame="hsides"rules="rows">
				<tr>
					<td class="item">締め日</td>
					<td width="80px">毎月
						@if (session('agentView')->close_date1 == '99')末@else{{ session('agentView')->close_date1 }}日@endif締
					</td>
					<td class="item">お支払期日</td>
					<td width="115px">
						@if (session('agentView')->pay_cycle1 == '0')
							当月
						@elseif (session('agentView')->pay_cycle1 == '1')
							翌月
						@elseif (session('agentView')->pay_cycle1 == '2')
							翌々月
						@endif
						@if (session('agentView')->pay_date1 == "99")末@else{{ session('agentView')->pay_date1 }}日@endif
					</td>
				</tr>
				<tr>
					<td class="item">お取引残高</td>
					<td></td>
					<td></td>
					<td width="80px">
						\&nbsp;
						@if (config('dwo.CREDIT_LIMIT_ERROR_FLG') == -1)
							--
						@else
							{{ number_format($creditinfo->zan) }}
						@endif
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>