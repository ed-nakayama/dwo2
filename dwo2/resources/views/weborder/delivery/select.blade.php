<x-app-layout>

<title>納品先指定選択</title>

<x-slot name="menu">
	{!! App\Http\Controllers\Weborder\MenuManager::setMenu('delivery') !!}
</x-slot>

@if (session('agentView')->cust_class_code != "OR" && session('agentView')->cust_class_code != "YBP" )
<x-slot name="manual">
</x-slot>
@endif

{{---------------------------------------------------------------------------------------}}

<div id="menu_userinfo">
<table border="0">
	<tr>
		<td class="userinfo" rowspan="3" valign="top">
			@include ('weborder/common/userinfo')
		</td>
	</tr>
	<tr>
		<td></td>
	</tr>
</table>
</div>

<br /><table width="700px">
	<tr>
		<td>
		<h4 class="select">▼納品先指定選択</h4>
		</td>
	</tr>
</table>

<table border="0">
	<tr>
		<td>
@if (session()->get('keep_deliveryotherview') == "貴社")
<span id="essential">※</span>表示される販売店様住所への納品でよろしければ次へボタンをクリックして下さい。
@else
<span id="essential">※</span>表示されておりますご住所への納品でよければ次へボタンをクリックして下さい。
@endif
@if (session()->get('keep_deliveryotherview') == "貴社")
		<br />
&nbsp;&nbsp;&nbsp;住所等変更がある場合は、お手数ですがホームの『ご登録情報』から納品先を削除後新たに納品先を登録して下さい。 
@endif
		<br /><br />
@if (session()->get('keep_deliveryotherview') == "貴社")
		<span id="essential">※</span>エンドユーザー様への納品や貴社支店・営業所・倉庫等への納品を希望される場合は<br />&nbsp;&nbsp;&nbsp;別途納品先ボタンをクリックして納品先をご指定下さい。<br /><br />
@endif
		</td>
	</tr>
	<tr>
		<td align="center">
			<table class="select" border="1" cellspacing="0" frame="hsides" rules="rows">
				<tr>
					<td class="item" width="100px">
					{{ session()->get('keep_deliveryotherview') }}名
					</td>
					<td width="350px">{{ $orderinfo->delivery_name }}</td>
				</tr>
				<tr>
					<td class="item">{{ session()->get('keep_deliveryotherview') }}郵便番号</td>
					<td>{{ $orderinfo->delivery_zip }}</td>
				</tr>
				<tr>
					<td class="item">{{ session()->get('keep_deliveryotherview') }}都道府県</td>
					<td>{{ $orderinfo->delivery_pref }}</td>
				</tr>
				<tr>
					<td class="item">{{ session()->get('keep_deliveryotherview') }}住所 1</td>
					<td>{{ $orderinfo->delivery_add1 }}</td>
				</tr>
				<tr>
					<td class="item">{{ session()->get('keep_deliveryotherview') }}住所 2</td>
					<td>{{ $orderinfo->delivery_add2 }}</td>
				</tr>
				<tr>
					<td class="item">{{ session()->get('keep_deliveryotherview') }}住所 3</td>
					<td>{{ $orderinfo->delivery_add3 }}</td>
				</tr>
				<tr>
					<td class="item">{{ session()->get('keep_deliveryotherview') }}担当者</td>
					<td>{{ $orderinfo->delivery_name_of_charge }}&nbsp;&nbsp;様</td>
				</tr>
				<tr>
					<td class="item">{{ session()->get('keep_deliveryotherview') }}電話番号</td>
					<td>
						@if ($orderinfo->delivery_tel1 != "")
							{{ $orderinfo->delivery_tel1 }}-{{ $orderinfo->delivery_tel2 }}-{{ $orderinfo->delivery_tel3 }}
						@endif
					</td>
				</tr>
				<tr>
					<td class="item">{{ session()->get('keep_deliveryotherview') }}FAX番号</td>
					<td>
						@if ($orderinfo->delivery_fax1 != "")
							{{ $orderinfo->delivery_fax1 }}-{{ $orderinfo->delivery_fax2 }}-{{ $orderinfo->delivery_fax3 }}
						@endif
					</td>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center">
		<br /><a href="/delivery/other"><img src="{{ asset('assets/cust/img/delivery.png') }}" alt="別途納品先" width="120px" height="50px"></a>
		</td>
	</tr>
	<tr>
		<td align="center"><div id="next">
			<a href="javascript:history.back();"><img src="{{ asset('assets/cust/img/back.png') }}" alt="戻る" width="120px" height="50px"></a>
			@if ($orderinfo->cust_regist_flg == "1")
				<a href="/custinfo/input"><img src="{{ asset('assets/cust/img/next.png') }}" alt="次へ" width="120px" height="50px"></a></div>
			@else
				<a href="/order/confirm"><img src="{{ asset('assets/cust/img/next.png') }}" alt="次へ" width="120px" height="50px"></a></div>
			@endif
		</td>
	</tr>
</table>

{{---------------------------------------------------------------------------------------}}

</x-app-layout>
