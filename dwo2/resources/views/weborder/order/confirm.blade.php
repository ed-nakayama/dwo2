<x-app-layout>

<title>オーダー確認</title>

<x-slot name="menu">
	{!! App\Http\Controllers\Weborder\MenuManager::setMenu('orderconfirm') !!}
</x-slot>

@if (session('agentView')->cust_class_code != "OR" && session('agentView')->cust_class_code != "YBP" )
<x-slot name="manual">
</x-slot>
@endif

{{---------------------------------------------------------------------------------------}}


<script type="text/javascript">
<!--
	function registration() {
		document.frm.frm_regist.value = "EXEC";
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
	</tr>
	<tr>
		<td></td>
	</tr>
</table>
</div>

@foreach ($errors->all() as $error)
	<li style="list-style:none; color:red;">{{ $error }}</li>
@endforeach

{{ html()->form('POST', '/order/completion')->attribute('name', 'frm')->open() }}
{{ html()->hidden('frm_regist') }}
{{ html()->form()->close() }}

<br /><table border="0">
	<tr>
		<td>
		<h4 class="select">▼オーダー確認</h4>
		</td>
	</tr>
	<tr>
		<td class="search">
			▼ご注文内容
		</td>
	</tr>
	<tr>
		<td>
		<br /><table class="select" border="1" cellspacing="0">
			<tr>
				<td class="item">貴社発注No.</td>
				<td class="item" width="70px" align="center">商品コード</td>
				<td class="item" width="300px" align="center">商品名称</td>
				<td class="item" width="30px" align="center">数量</td>
				<td class="item" width="50px" align="center">単価</td>
				<td class="item" width="50px" align="center">金額</td>
				<td class="item" width="50px" align="center">消費税</td>
				<td class="item" width="50px" align="center">消費税率</td>
			<tr>
			
			<?php $sub_total = 0; ?>
			<?php $tax_total = 0; ?>
			<?php $grand_total = 0; ?>

		@foreach ($basketList as $basketlist)
			<tr>
				<td align="center">&nbsp;{{ $basketlist['cust_order_num'] }}</td>
				<td align="center">{{ $basketlist['product_code'] }}</td>
				<td>{{ $basketlist['item_name_kanji'] }}</td>
				<td align="center">{{ number_format($basketlist['count']) }}</td>
				<td align="right">{{ number_format($basketlist['price_invoice_price']) }}</td>
				<td align="right">{{ number_format($basketlist['count'] * $basketlist['price_invoice_price']) }}</td>
				<td align="right">{{ number_format($basketlist['tax']) }}</td>
				<td align="right">{{ $basketlist['tax_rate'] * 100 }}%</td>
			<tr>
			<?php $sub_total += $basketlist['count'] * $basketlist['price_invoice_price']; ?>
			<?php $tax_total += $basketlist['tax']; ?>
			<?php $grand_total = $sub_total + $tax_total; ?>
		@endforeach

		</table>
		</td>
	</tr>
	<tr>
		<td align="right">
			<table class="select" border="1" cellspacing="0" width="170px">
			  <tr>
			    <td class="item">税抜額</td>
			    <td align="right">\&nbsp;{{ number_format($sub_total) }}</td>
			  </tr>
			  <tr>
			    <td class="item" width="35%">消費税</td>
			    <td align="right" width="65%">\&nbsp;{{ number_format($tax_total) }}</td>
			  </tr>
			  <tr>
			    <td class="item">合計</td>
			    <td align="right">\&nbsp;{{ number_format($grand_total) }}</td>
			  </tr>
			</table>
		</td>
	</tr>
</table>

<table border="0">

	<tr>
		<td>
			@include ('weborder/common/tax10_comment')
		</td>
	</tr>
@if ($orderinfo->syonin_mail_flg == "1")
	<tr>
		<td>
			■パートナー会員様への注意事項■<br />
			ご注文内容および以下の納品先{{--ユーザー登録--}}情報をご確認下さい。<br />
	@if ($orderinfo->pap_order == TRUE)
			ご購入のお客様（ユーザー登録のお客様）に「個人情報保護方針」についての承認確認メールを送信します。<br />
			ご承認後「注文確定」となります。<br /><br />
	@endif

			■ご承認いただいた注文確定分の納期について■<br />
			弊社営業日午後3時までに受け付けたオーダー(注文確定分)は、翌営業日の出荷となります。<br />
			午後3時以降は翌営業日のオーダー扱いとなり、翌々営業日の出荷となります。<br />
			<span id="essential">なお、注文確定日の当日出荷はお受けしておりません。</span><br />
			あらかじめご了承下さい。<br /><br />
		</td>
	</tr>
@else
	<tr>
		<td>
			■納期について■<br />
			弊社営業日午後3時までに受け付けたオーダー(注文確定分)は、翌営業日の出荷となります。<br />
			午後3時以降は翌営業日のオーダー扱いとなり、翌々営業日の出荷となります。<br />
			<span id="essential">なお、注文確定日の当日出荷はお受けしておりません。</span><br />
			あらかじめご了承下さい。<br /><br />
		</td>
	</tr>
@endif

	<tr>
		<td class="search" width="630px">
		▼納品予定日目安表
		</td>
	</tr>
	<tr>
		<td><br /><span id="essential">※</span>交通事情により納品が遅れる場合がありますので予めご了承ください。</td>
	</tr>
	<tr>
		<td align="center">
			<table class="select" border="1" cellspacing="0">
				<tr>
					<td class="item">納品地域</td>
					<td class="item">配送期間（出荷日を含む）</td>
					<td class="item">（例）出荷日2015/10/19の場合の納品予定日</td>
				</tr>
				<tr>
					<td>北海道・沖縄地域</td>
					<td align="right">4～5日</td>
					<td align="right">2015/10/22～2015/10/23</td>
				</tr>
				<tr>
					<td>中国・四国・九州</td>
					<td align="right">3日</td>
					<td align="right">2015/10/21</td>
				</tr>
				<tr>
					<td>その他</td>
					<td align="right">2日</td>
					<td align="right">2015/10/20</td>
				</tr>
			</table><br />
		</td>
	</tr>
	<tr>
		<td class="search">▼納品先情報</td>
	</tr>
	<tr>
		<td align="center">
			<br /><table class="select" width="450px" border="1" cellspacing="1" frame="hsides" rules="rows">
				<tr>
					<td class="item" width="200px">貴社ご発注　担当者</td>
					<td>{{ $orderinfo->order_tantou_name }}</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center">
			<br /><table class="select" width="450px" border="1" cellspacing="1" frame="hsides" rules="rows">
				<tr>
					<td class="item" width="200px">サプライ二重梱包</td>
					<td>@if ($orderinfo->double_package_type == 1)有@else無@endif</td>
				</tr>
				<tr>
					<td class="item">納品先 名称</td>
					<td>{{ $orderinfo->delivery_name }}</td>
				</tr>
				<tr>
					<td class="item">納品先 郵便番号</td>
					<td>{{ $orderinfo->delivery_zip }}</td>
				</tr>
				<tr>
					<td class="item">納品先 都道府県</td>
					<td>{{ $orderinfo->delivery_pref }}</td>
				</tr>
				<tr>
					<td class="item">納品先 住所 1</td>
					<td>{{ $orderinfo->delivery_add1 }}</td>
				</tr>
				<tr>
					<td class="item">納品先 住所 2</td>
					<td>{{ $orderinfo->delivery_add2 }}</td>
				</tr>
				<tr>
					<td class="item">納品先 住所 3</td>
					<td>{{ $orderinfo->delivery_add3 }}</td>
				</tr>
				<tr>
					<td class="item">納品先 担当者</td>
					<td>{{ $orderinfo->delivery_name_of_charge }}</td>
				</tr>
				<tr>
					<td class="item">納品先 電話番号</td>
					<td>{{ $orderinfo->delivery_tel1 }}-{{ $orderinfo->delivery_tel2 }}-{{ $orderinfo->delivery_tel3 }}</td>
				</tr>
				<tr>
					<td class="item">納品先 FAX番号</td>
					<td>
					@if ($orderinfo->delivery_fax1)
						{{ $orderinfo->delivery_fax1 }}-{{ $orderinfo->delivery_fax2 }}-{{ $orderinfo->delivery_fax3 }}
					@endif
					</td>
				</tr>
				<tr>
					<td class="item">伝票送付</td>
					<td>@if ($orderinfo->direct_delivery_type == 1)無@else有@endif
					</td>
				</tr>
			</table>
		</td>
	</tr>

@if ($orderinfo->cust_regist_flg == "1")
	<tr>
		<td align="center">
		<br /><table class="select" width="450px" border="1" cellspacing="0" frame="hsides" rules="rows">
			<tr>
				<td class="item" width="200px">登録名義</td>
				<td>{{ $orderinfo->regist_name }}</td>
			</tr>
			<tr>
				<td class="item">登録名義(フリガナ)</td>
				<td>{{ $orderinfo->regist_kana }}</td>
			</tr>
			<tr>
				<td class="item">代表取締役または代表者</td>
				<td>{{ $orderinfo->regist_ceo }}</td>
			</tr>
			<tr>
				<td class="item">代表取締役または代表者(フリガナ)</td>
				<td>{{ $orderinfo->regist_ceo_kana }}</td>
			</tr>
			<tr>
				<td class="item">担当者</td>
				<td>{{ $orderinfo->regist_name_of_charge }}</td>
			</tr>
			<tr>
				<td class="item">担当者(フリガナ)</td>
				<td>{{ $orderinfo->regist_name_of_charge_kana }}</td>
			</tr>
			<tr>
				<td class="item">メールアドレス</td>
				<td>{{ $orderinfo['regist_mail'] }}</td>
			</tr>
			<tr>
				<td class="item">ホームページURL</td>
				<td>{{ $orderinfo->regist_url }}</td>
			</tr>
			<tr>
				<td class="item">郵便番号</td>
				<td>{{ $orderinfo->regist_zip1 }}-{{ $orderinfo->regist_zip2 }}</td>
			</tr>
			<tr>
				<td class="item">都道府県</td>
				<td>{{ $orderinfo->regist_pref }}</td>
			</tr>
			<tr>
				<td class="item">市区町村</td>
				<td>{{ $orderinfo->regist_add1 }}</td>
			</tr>
			<tr>
				<td class="item">丁番地</td>
				<td>{{ $orderinfo->regist_add2 }}</td>
			</tr>
			<tr>
				<td class="item">建物名</td>
				<td>{{ $orderinfo['regist_add3'] }}</td>
			</tr>
			<tr>
				<td class="item">登録電話番号</td>
				<td>{{ $orderinfo->regist_tel1 }}-{{ $orderinfo->regist_tel2 }}-{{ $orderinfo->regist_tel3 }}</td>
			</tr>
			<tr>
				<td class="item">連絡先電話番号</td>
				<td>
				@if ($orderinfo->regist_contact_tel1 != "")
					{{ $orderinfo->regist_contact_tel1 }}-{{ $orderinfo->regist_contact_tel2 }}-{{ $orderinfo->regist_contact_tel3 }}
				@endif
				</td>
			</tr>
			<tr>
				<td class="item">連絡先FAX番号</td>
				<td>
				@if ($orderinfo->regist_contact_fax1 != "")
					{{ $orderinfo->regist_contact_fax1 }}-{{ $orderinfo->regist_contact_fax2 }}-{{ $orderinfo->regist_contact_fax3 }}
				@endif
				</td>
			</tr>
			</table><br />
		</td>
	</tr>
@endif

	<tr>
		<td>
		内容を確認したら「確定」ボタンをクリックして入力内容を確定してください。<br />
@if ($orderinfo->pap_order == TRUE)
		ご購入のお客様（ユーザー登録のお客様）に「個人情報保護方針」についての承認確認メールを送信します。<br />
		ご承認後<span id="essential">「注文確定」</span>となります。<br />
@endif
		内容に変更がございましたら、「戻る」ボタンで入力画面まで戻って変更してください。<br /><br />

		<span id="essential"><b>※確定後の追加・変更はできませんのでご注意ください。</b></span><br />
		午後3時までは「注文履歴」よりご注文削除が可能です。<br />
		確定後の内容につきましては、「注文履歴」画面にてご確認ください。<br /><br />
		<br /><br />
		</td>
	</tr>

</table>
<div id="next">
	<a href="javascript:history.back();"><img src="{{ asset('assets/cust/img/back.png') }}" alt="戻る" width="120px" height="50px"></a>
	<a href="javascript:registration();"><img src="{{ asset('assets/cust/img/decision.png') }}" alt="確定" width="120px" height="50px"></a>
</div>

{{---------------------------------------------------------------------------------------}}

</x-app-layout>
