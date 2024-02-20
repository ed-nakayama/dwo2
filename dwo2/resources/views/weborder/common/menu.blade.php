<table border="0" width="100%">
	<tr>
		<td width="600px">
			<p>
				@if(!empty($menu)){{ $menu }}@endif
			</p>
		</td>
		<td align="right">
			<p class="login">
			<form method="POST" action="/logout" name="logoutForm">
			@csrf
			@if(!empty($manual))
				<a href="{{ asset('assets/cust/pdf/manual.pdf') }}" target="_blank"><img src="{{ asset('assets/cust/img/usage.png') }}" alt="マニュアル" width="60px" height="20px"></a>&nbsp;&nbsp;
			@endif
			@if(!empty($menu))
				<a href="" onclick="event.preventDefault(); this.closest('form').submit();"><img src="{{ asset('assets/cust/img/logout.png') }}" alt="ログアウト" width="60px" height="20px"></a>
			@endif
			</form>
			</p>
		</td>
	</tr>
</table>
