<x-app-layout>

<title>貴社登録情報</title>

<table width="550px">
	<tr>
		<td>
		<h4 class="select">▼貴社登録情報</h4>
		</td>
	</tr>
</table>

<table class="select">
	<tr>
		<td>
		現在の貴社ご登録情報です。<br />
		ご登録のE-Mailアドレスへ、ご注文受付完了のメールを配信いたします。<br /><br />
		<span id="essential">※</span>住所等の変更がある場合には、
		@if (session('agentView')->cust_class_code == "YBP")
			<a href="http://partner.yayoi-kk.co.jp/ishop/" target="_blank">こちらへ</a>
		@elseif (session('agentView')->cust_class_code == "OR")
			<a href="http://partner.yayoi-kk.co.jp/ishop/" target="_blank">こちらへ</a>
		@else
			<a href="https://www.yayoi-kk.co.jp/pap/login/login.jsp" target="_blank">こちらへ</a>
		@endif
		<br />
		&nbsp;&nbsp;&nbsp;弥生会員専用ページにログイン（※）してご変更下さい。<br />
		&nbsp;&nbsp;&nbsp;（※）WebオーダーへログインするID・PWとは異なります
		</td>
	</tr>
	<tr>
		<td align="center">
		<br />
		<table width="350px" border="1" cellspacing="0" frame="hsides" rules="rows">
			<tr>
				<td class="item" width="35%">貴社コード</td>
				<td>{{ session('agentView')->cust_num }}</td>
			</tr>
			<tr>
				<td class="item">貴社名</td>
				<td>{{  session('agentView')->name1 .  session('agentView')->name2 }}</td>
			</tr>
			<tr>
				<td class="item">郵便番号</td>
				<td>{{  session('agentView')->post }}</td>
			</tr>
			<tr>
				<td class="item">住所 1</td>
				<td>{{  session('agentView')->pref .  session('agentView')->address1 }}</td>
			</tr>
			<tr>
				<td class="item">住所 2</td>
				<td>{{  session('agentView')->address2 }}</td>
			</tr>
			<tr>
				<td class="item">住所 3</td>
				<td>{{  session('agentView')->address3 }}</td>
			</tr>
			<tr>
				<td class="item">部署名</td>
				<td>{{  session('agentView')->contact_department }}</td>
			</tr>
			<tr>
				<td class="item">役職</td>
				<td>{{  session('agentView')->contact_title }}</td>
			</tr>
			<tr>
				<td class="item">ご担当者</td>
				<td>{{  session('agentView')->contact_name1 }}&nbsp;様</td>
			</tr>
			<tr>
				<td class="item">電話番号</td>
				<td>{{  session('agentView')->tel }}</td>
			</tr>
			<tr>
				<td class="item">FAX番号</td>
				<td>{{  session('agentView')->fax }}</td>
			</tr>
			<tr>
				<td class="item">E-Mail</td>
				<td>{{  session('agentView')->mail_address }}</td>
			<tr>
				<td class="item">E-Mail送信</td>
				<td>@if (Auth::user()->profile_mail_flag == "1")可@else不可@endif</td>
			</tr>
			<tr>
				<td class="item">請求締日</td>
				<td>毎月
					@if ( session('agentView')->close_date1 == "99")末@else{{  session('agentView')->close_date1 }}日@endif締
				</td>
			</tr>
			<tr>
				<td class="item">お支払い条件</td>
				<td>
					@if ( session('agentView')->pay_cycle1 == "0")
						当月
					@elseif ( session('agentView')->pay_cycle1 == "1")
						翌月
					@elseif ( session('agentView')->pay_cycle1 == "2")
						翌々月
					@endif
					@if ( session('agentView')->pay_date1 == "99")末@else{{  session('agentView')->pay_date1 }}日@endif
				</td>
			</tr>
			<tr>
				<td class="item">更新日</td>
				<td>{{ Auth::user()->profile_update->format('Y/m/d') }}</td>
			</tr>
		</table><br />
		</td>
	</tr>
	<tr>
		<td align="center">
			<a href="javascript:window.close();"><img src="{{ asset('assets/cust/img/close.png') }}"></a>
		</td>
	</tr>
</table>

</x-app-layout>
