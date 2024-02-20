<x-app-layout>

<head>
	<title>ご注文方法</title>
</head>

<div id="menu_userinfo">
<table border="0">
	<tr>
		<td class="userinfo" rowspan="3" valign="top">
@include ('weborder/common/userinfo')
		</td>
		<td>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td>
					<p class="sidebar">お知らせ</p>
				</td>
			<tr>
		</table>
		<iframe src="/common/information" width="360px" height="100px" frameborder="0">
		</iframe>
		</td>
	</tr>
</table>
</div>

<br /><table width="550px">
	<tr>
		<td>
		<h4 class="select">▼ご注文の流れ</h4>
		</td>
	</tr>
</table>
<img src="{{ asset('assets/cust/img/procedure.png') }}" alt="ご利用手順" width="760px" height="300px">
<a href="javascript:history.back();"><img src="{{ asset('assets/cust/img/back.png') }}" alt="戻る" width="120px" height="50px"></a>

</x-app-layout>
