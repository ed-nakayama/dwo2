<x-app-layout>

<title>メニュー</title>

<x-slot name="menu">
	{!! App\Http\Controllers\Weborder\MenuManager::setMenu('home') !!}
</x-slot>

@if (session('agentView')->cust_class_code != "OR" && session('agentView')->cust_class_code != "YBP" )
<x-slot name="manual">
</x-slot>
@endif

{{---------------------------------------------------------------------------------------}}

<div id="menu_userinfo">
<table border="0"  width="100%">
	<tr>
		<td class="userinfo" rowspan="3" valign="top">
			@include ('weborder/common/userinfo')
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td height="50px">
						<p class="submenu">
							<a href="/top/condition" target="information">お取引条件</a>
							<a href="/top/history" target="information">注文履歴</a>
							<a href="/top/registrationinfo" target="information">ご登録情報</a>
							@if ($orderinfo->pap_order == 1)
								<a href="/top/ordermethod">ご注文の流れ</a>
							@endif
						</p>
					</td>
				</tr>
				<tr>
					<td>
						<iframe src="/top/condition" height="150" width="380" marginwidth="0px" frameborder="0" name="information"></iframe>
					</td>
				</tr>
				<tr>
					<td align="center"></td>
				</tr>
			</table>
		</td>
		<td>
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<p class="sidebar" style="width:347px">お知らせ</p>
					</td>
				</tr>
				<tr>
					<td>
						<iframe src="/common/information" width="360px" height="540px" frameborder="0"></iframe>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</div>

<div class="next">

<script type="text/javascript"><!--
function on_submit() {
	location.href = "/item/select";
 }
 // --></script>

	<a href="javascript:on_submit();">{{-- 2013/10/24 --}}
	<img src="{{ asset('assets/cust/img/confirmation.png') }}" alt="商品選択" width="120px" height="50px"></a>
</div>
<p class="top_attention">
	<span id="essential">※</span>小ロットサプライは、システムの都合上Webオーダーではご注文できません。<br/>&nbsp;&nbsp;&nbsp;お手数ですがカスタマーセンター@if ($orderinfo->cust_kbn == "OR" || $orderinfo->cust_kbn == "YBP")（0120-500-980）@else（0120-714-841）@endifへお問い合わせください。<br/>
</p>

{{---------------------------------------------------------------------------------------}}

</x-app-layout>
