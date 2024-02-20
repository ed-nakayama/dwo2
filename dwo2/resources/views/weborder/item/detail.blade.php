<x-app-layout>

<title>ユーザー登録済み製品 or 通常製品</title>

<x-slot name="menu">
	{!! App\Http\Controllers\Weborder\MenuManager::setMenu('itemdetail') !!}
</x-slot>

@if (session('agentView')->cust_class_code != "OR" && session('agentView')->cust_class_code != "YBP" )
<x-slot name="manual">
</x-slot>
@endif

{{---------------------------------------------------------------------------------------}}

<script type="text/javascript">
<!--
	function inputCheck() {
		// 入力チェック処理

		document.frm.frm_add_bskflg.value = "on";
		document.frm.submit();
	}
-->
</script>


<div id="menu_userinfo">
<table border="0">
	<tr>
		<td class="userinfo" rowspan="3" valign="top">
			@include ('weborder/common/userinfo')
		</td>
		<td>
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td valign="top">
						<p class="sidebar">買い物かご</p>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<iframe src="/common/shoppingcart" marginheight="4" marginwidth="2" width="385px"height="100px"frameborder="0"></iframe>
					</td>
				<tr>
			</table>
		</td>
	</tr>
</table>
</div>

<br /><table width="100%">
	<tr>
		<td>
		<h4>▼数量を入力して下さい</h4>
		</td>
	</tr>

@if ($yosin_error == "on")
	<tr>
		<td align="center">
		<p class="words"><span id="essential">申し訳ございませんが、限度額以上のお受付はできません。<br />
		現在の買い物かごの内容でよろしければこのまま次へお進み下さい。<br />
		または{{ config('dwo.DWO_COMP_NAME') }} {{ config('dwo.DWO_UNIT_NAME') }}までお問合せください。<br />
		お問合せ先：{{ config('dwo.DWO_TEL') }}</span></p><br />
		</td>
	</tr>
@endif


	<tr>
		<td>
ご注文される数量を半角入力し、右横の購入ボタンをクリックしてください。<br />
全てのご注文数量入力が終わりましたら、画面下の次へボタンをクリックしてください。<br />
現在ご注文済みの商品は、右上の買い物かごで確認できます。<br />
なお、表示されている商品以外をご注文される場合は、戻るボタンをクリックしてください。<br />
<br />
@if ($orderinfo->cust_kbn == "OR" || $orderinfo->cust_kbn == "YBP")
	※参考価格とはオープン価格となる商品の弥生ストアでの販売価格です。<br />
	　定価のある商品は定価が表示されています。<br />
	　詳しくは別途提供している価格表をご参照ください。
	<br /><br />

{{-- 2015/10/19 FY16対応

	{%if ($session.orderinfo.pap_order == TRUE) %}
		@if ($orderinfo->cust_kbn == 'GOLD' || $orderinfo->cust_kbn == 'PAP' || ($orderinfo->cust_kbn == 'OR' && ($memberType == 'GOLD' || $memberType == 'PAP')))
			<font color=red>※サポート付き製品に関して</font><br />
			　「社会保障と税の一体改革”あんしん”キャンペーン」実施に伴い、弥生PAP会員様のお取り扱い内容が変わりました。<br />
			　詳しくは下記URLよりご確認ください。<br />
			<br />
			<a href="https://www.yayoi-kk.co.jp/pap/member/info/2013_anshincp.html" style="color:#0000ff;">　「社会保障と税の一体改革”あんしん”キャンペーン」弥生PAP会員様のお取り扱い内容について</a><br />
			<br />
			　※弥生PAP会員専用ホームページへのログインが必要です。<br />
			　　ログインID及びパスワードは、弥生WebオーダーのID及びパスワードとは異なります。<br />
			<br />
		@endif
	{%/if%}

2015/10/19 FY16対応 --}}

@endif


		</td>
	</tr>
</table>

{{ html()->form('POST', '/item/detail/regist')->attribute('name' , 'frm')->open() }}
{{ html()->hidden('frm_bigcode',   $keep_bigcode) }}
{{ html()->hidden('frm_midcode',   $keep_midcode) }}
{{ html()->hidden('frm_salesstop', $keep_salesstop) }}
{{ html()->hidden('frm_prod_name', $keep_prod_name) }}

@if (!empty($keep_prod_code[0]) )
	@foreach ($keep_prod_code as $prodcd)
		{{ html()->hidden('frm_prod_code[]', $prodcd) }}
	@endforeach
@endif

@foreach ($errors->all() as $error)
	<li style="list-style:none; color:red;">{{ $error }}</li>
@endforeach
	
@if (!empty($keep_prodList))
	{{ html()->hidden('frm_add_bskflg') }}
	<table class="select" border="1" cellspacing="0">
	<tr align="center">
		<td class="item">商品コード</td>
		<td class="item" width="290px">商品名称</td>
		<td class="item" width="60px">@if (!empty($orderinf->upgrade_order) || ($orderinfo->cust_kbn != "OR" && $orderinfo->cust_kbn != "YBP")) 定価@else参考価格@endif</td>
		<td class="item" width="60px">提供価格</td>
		<td class="item">在庫状況</td>
		<td class="item" >出荷予定日</td>
		<td class="item" width="100px">数量（半角）</td>
	</tr>


	@foreach ($keep_prodList as $prodlist)
	<tr>
		<td class="item2" align="left" nowrap>
			{{ $prodlist['product_code'] }}
		</td>
		<td class="item2" nowrap>
			@if ($prodlist['price_product_sup_code'] == "") {{ $prodlist['item_name_kanji'] }}@else{{ $prodlist['item_name_kanji'] }} {{ $prodlist['price_product_sup_short'] }}@endif
		</td>
		<td class="item2" align="right">\&nbsp;{{ number_format($prodlist['sales_price']) }}</td>
		<td class="discount">\&nbsp;{{ number_format($prodlist['view_invoce_price']) }}</td>
		<td class="item2" width="60">
			@foreach ($productStatus as $st)
				@if ($prodlist['product_status_id'] == $st->prod_status_id)
					@if ($st->prod_status_id == '3')
						<strong><font color="#FF0000">{{ $st->prod_status_name }}</font></strong>
					@else
						{{ $st->prod_status_name }}
					@endif
					@break
				@endif
				@if ($loop->last)
					不明
				@endif
			@endforeach
		</td>
		<td class="item2">
			{{ $prodlist['product_ship_date'] }}&nbsp;
		</td>
		<td class="item2" align="right">
			@if ($prodlist['product_status_id'] == "3")
				{{ html()->text()->attributes(['size' => '4', 'maxlength' => '4'])->style("background-color: #d3d3d3;")->disabled() }}個&nbsp;
				{{ html()->submit('購入')->disabled() }}
			@else
				{{ html()->text('frm_add_count_' . $prodlist['product_code']  . '_' . $prodlist['price_product_sup_code'])->attributes(['size' => '4', 'maxlength' => '4']) }}個&nbsp;
{{--	
				{{ html()->hidden('prod[]' ,$prodlist['product_code']) }}
				{{ html()->text('frm_add[]')->attributes(['size' => '4', 'maxlength' => '4']) }}個&nbsp;
--}}
				{{ html()->submit('購入')->attribute('onClick', 'inputCheck();') }}
			@endif
		</td>
	</tr>
	@endforeach


	</table>
	{{ html()->form()->close() }}
@else
	<br>
	<font color="red">
	現在の条件では商品が見つかりませんでした。戻るボタンをクリックして検索条件を変更してください。
	</font>
@endif
<br />
<table align="center">
	<tr>
		<td>
		<div id="next"><a href="javascript:history.back();"><img src="{{ asset('assets/cust/img/back.png') }}" alt="戻る" width="120px" height="50px"></a>
@if (session()->get('keep_bsk_count') > 0)
<a href="/basket/confirm"><img src="{{ asset('assets/cust/img/next.png') }}" alt="次へ" width="120px" height="50px"></a></div>
@else
<a href="#"><img src="{{ asset('assets/cust/img/next.png') }}"" alt="次へ" width="120px" height="50px" onClick="javascript:alert('買い物かごに、ご注文される商品が見つからないために\n次へ進むことが出来ません。');"></a></div>
@endif
		</td>
	</tr>
</table>
<br />
<table border="0" width="700px">
	<tr>
		<td>
		■在庫状況について■
		</td>
	</tr>
	<tr>
		<td>1.在庫あり ---- 欠品の恐れなし</td>
	</tr>
	<tr>
		<td>2.品薄 ---- 欠品の恐れあり（{{ config('dwo.DWO_UNIT_NAME') }}にご確認下さい。）</td>
	</tr>
	<tr>
		<td>3.欠品 ---- 現在欠品中（出荷可能日をご確認下さい。）</td>
	</tr>
	<tr>
		<td>4.予約受付中---ご注文のご予約が可能です。</td>
	</tr>
</table>

{{---------------------------------------------------------------------------------------}}

</x-app-layout>
