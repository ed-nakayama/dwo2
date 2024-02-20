<x-guest-layout>

<table border="0">
	<tr>
		<td width="550px" height="75px" align="center" valign="bottom">
		<img src="{{ asset('assets/cust/img/welcome.png') }}" alt="弥生webオーダーへようこそ" width="500px" height="50px">
		</td>
	</tr>
</table>

<form method="POST" name="frm" action="{{ route('login') }}">
@csrf

<table align="center" border="0" >

	<tr>
		<td><h4>▼ログインID、パスワードを入力してください。</h4></td>
	</tr>
	@error('profile_cust_code')
		<tr>
			<td align="center"><li style="list-style:none; color:red;">{{ $message }}</li></td>
		<tr>
	@enderror
	@error('password')
		<tr>
			<td align="center"><li style="list-style:none; color:red;">{{ $message }}</li></td>
		<tr>
	@enderror
	@error('no_match_user')
		<tr>
			<td align="center"><li style="list-style:none; color:red;">{{ $message }}</li></td>
		</tr>
	@enderror
	@error('out_of_support')
		<tr>
			<td align="center"><li style="list-style:none; color:red;">{{ $message }}</li></td>
		</tr>
	@enderror
	@error('no_order_user')
		<tr>
			<td align="center"><li style="list-style:none; color:red;">{{ $message }}</li></td>
		</tr>
	@enderror
	@error('over_limit')
		<tr>
			<td align="center"><li style="list-style:none; color:red;">{{ $message }}</li></td>
		</tr>
		<tr>
			<td align="center">
			<p class="words"><span id="essential">申し訳ございませんが、お受付できません。<br />
			{{ config('dwo.DWO_COMP_NAME') }} {{ config('dwo.DWO_UNIT_NAME') }}までお問合せください。<br />
			お問合せ先：{{ config('dwo.DWO_TEL') }}</p></span>
			</td>
		</tr>
	@enderror
	@error('tran_status_error')
		<tr>
			<td align="center">
			<table border="0" cellpadding="0" cellspacing="0">
				<tr><td align="left"><p class="words"><span id="essential">申し訳ございませんが、お受付できません。</p></span></td></tr>
				<tr><td align="left"><p class="words"><span id="essential">後ほど弥生㈱より、ご登録のご連絡先宛に</p></span></td></tr>
				<tr><td align="left"><p class="words"><span id="essential">連絡させていただきます。</p></span></td></tr>
			</table>
			</td>
		</tr>
	@enderror


	<tr>
		<td>
		<table border="0">
			<tr>
				<td>
					<table class="new"  border="1" cellspacing="0" frame="hsides" rules="rows">
						<tr>
							<td class="item" width="100">ログインID</td>
							<td>
								<input id="profile_cust_code" type="text" name="profile_cust_code"  size="20" maxlength="9"  value="{{ old('profile_cust_code') }}"   style="ime-mode: disabled;" required="required" autofocus="autofocus" autocomplete="username"  tabindex="1">
							</td>
							<td>&nbsp;&nbsp;<a href="/information#forgetid" target="_blank">IDを忘れてしまったら</a></td>
						</tr>
						<tr>
							<td class="item">パスワード</td>
							<td>
								<input id="password" type="password" name="password" size="15" maxlength="20" value=""  style="ime-mode: disabled;" required="required"  tabindex="2">
							</td>
							<td>&nbsp;&nbsp;<a href="/information#forgetpassword" target="_blank">パスワードを忘れてしまったら</a></td>
{{--
							<td>
								@if (Route::has('password.request'))
									<a href="{{ route('password.request') }}">パスワードを忘れてしまったら</a>
								@endif
							</td>
--}}
						</tr>
					</table>
				</td>
			</tr>
			<tr>
{{--
				<td align="left"><input type="checkbox" name="frm_rec_id" {%if $app.cookie_recid != ""%}checked{%/if%}  tabindex="4"><font size="2">次回からログインIDを記憶する</font></td>
--}}
{{--
				<td align="left">
					<input id="remember_me" type="checkbox" name="remember"><font size="2">{{ __('Remember me') }}</font>
				</td>
--}}

			</tr>
			<tr>
				<td align="center"><font size="2">弥生会員専用ページのログインID・PWとは異なります</font></td>
			</tr>



		</table>
		</td>
	</tr>
	<tr>
		<td align="center">
			<a href="javascript:document.frm.submit();"  tabindex="5"><img src="{{ asset('assets/cust/img/login.png') }}" alt="ログイン" width="120px" height="50px"></a> 
		</td>
	</tr>

	<tr>
		<td valign="bottom">
			<br /><br />
			<table border="0">
				<tr>
					<td>
					■&nbsp;<a href="/information#weborder" target="_blank">弥生Webオーダーについて</a><br />
					</td>
				</tr>
				<tr>
					<td>
					■&nbsp;<a href="/information#order" target="_blank">ご注文と出荷について</a><br />
					</td>
				</tr>
				<tr>
					<td>
					■&nbsp;<a href="/information#payment" target="_blank">お支払いについて</a><br />
					</td>
				</tr>
				<tr>
					<td>
					■&nbsp;<a href="/information#return" target="_blank">商品のご返品・交換について</a><br />
					</td>
				</tr>
				<tr>
					<td>
					■&nbsp;<a href="/information#inquiry" target="_blank">ご注文に関するお問い合わせについて</a><br />
					</td>
				</tr>
				<tr>
					<td>
					■&nbsp;<a href="/information#password" target="_blank">パスワードについて</a><br />
					</td>
				</tr>
				<tr>
					<td>
					■&nbsp;<a href="https://www.yayoi-kk.co.jp/company/sitepolicy/" target="_blank">サイトポリシー</a><br />
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="50px">
		<p class="mail">
		上記内容以外にご不明な点等ございましたら、<a href="mailto:{{ config('dwo.DWO_ORDER_CENTER_MAIL') }}">{{ config('dwo.DWO_ORDER_CENTER_MAIL') }}</a> にお問い合わせ下さい。</p><p class="top">
		</td>
	</tr>
</table>

</form>

</x-guest-layout>
