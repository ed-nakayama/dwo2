<x-app-layout>

<title>webオーダー履歴</title>

<script type="text/javascript">
<!--
	function printPreview() {
		document.frmPrt.submit();
	}

	function printPreviewUpgrade() {
		document.frmPrtUpgrade.submit();
	}

	function delSubmit() {
		if (window.confirm("この注文を削除してもよろしいですか？")) {
			document.frm.submit();
		}
	}
-->
</script>


{{ html()->form('POST', '/order/printview')->attributes(['name' => 'frmPrt', 'target' => '_blank'])->open() }}
{{ html()->hidden('orderNum', $orderheader->web_order_num) }}
{{ html()->form()->close() }}

{{ html()->form('POST', '/order/upgradeprint')->attributes(['name' => 'frmPrtUpgrade', 'target' => '_blank'])->open() }}
{{ html()->hidden('orderNum', $orderheader->web_order_num) }}
{{ html()->form()->close() }}

{{ html()->form('POST', '/top/history/delete')->attribute('name', 'frm')->open() }}
{{ html()->hidden('del_order_num', $orderheader->web_order_num) }}
{{ html()->hidden('frm_from_date', $frm_from_date) }}
{{ html()->hidden('frm_to_date', $frm_to_date) }}
{{ html()->hidden('frm_web_order_num', $frm_web_order_num) }}
{{ html()->hidden('frm_item_cd', $frm_item_cd) }}
{{ html()->hidden('frm_dwo_order_person_name', $frm_dwo_order_person_name) }}
{{ html()->hidden('frm_direct_delivery_type', $frm_direct_delivery_type) }}
{{ html()->hidden('frm_dest_name1', $frm_dest_name1) }}
{{ html()->hidden('frm_state_type', $frm_state_type) }}
{{ html()->form()->close() }}

{{ html()->form('GET', '/top/history/mail/change')->attribute('name', 'frmmailchg')->open() }}
{{ html()->hidden('chg_order_num', $orderheader->web_order_num) }}
{{ html()->hidden('old_mail_addr', $orderheader->license_mail_address) }}
{{ html()->form()->close() }}

<br /><table width="550px">
	<tr>
		<td>
		<h4>▼注文履歴 詳細</h4>
		</td>
	</tr>
</table>

<table border="0">
	@if ($orderheader->delete_ok == 1)
	<tr>
		<td width="60px"></td>
		<td align="left">
			<span id="essential">※</span>「削除」をクリックすると、ご注文がキャンセルされます。<br />
		</td>
	<tr>
	@endif
	<tr>
		<td align="center" colspan="2">
		<br /><table class="select" border="1" cellspacing="0" frame="hsides" rules="rows">
			<tr>
				<td class="item" width="150px">
				現在のステータス</td>
				<td width="250px">
					@foreach ($orderStatus as $stat)
						@if ($orderheader->state_type == $stat->order_status_id)
							{{ $stat->order_status_name }}
						@endif
					@endforeach
				</td>
			</tr>
			<tr>
				<td class="item">受付No.</td>
				<td>{{ $orderheader->web_order_num }}</td>
			</tr>
			<tr>
				<td class="item">受付日</td>
				<td>{{ $orderheader->dwo_last_update }}</td>
			</tr>
			<tr>
				<td class="item">出荷予定日</td>
				<td>
					@if (!empty($orderheader->shipping_date) )
						{{ $orderheader->shipping_date2 }}</td>
					@else
						&nbsp;
					@endif
				</td>
			</tr>
			<tr>
				<td class="item">貴社発注担当者</td>
				<td>{{ $orderheader->dwo_order_person_name }}</td>
			</tr>
			<tr>
				<td class="item">サプライ二重梱包</td>
				<td>@if ($orderheader->double_package_type == "1")有@else無@endif</td>
			</tr>
			<tr>
				<td class="item">納品先 名称</td>
				<td>{{ $orderheader->dest_name1 }}{{ $orderheader->dest_name2 }}</td>
			</tr>
			<tr>
				<td class="item">納品先 郵便番号</td>
				<td>{{ $orderheader->dest_post }}</td>
			<tr>
				<td class="item">納品先 住所1</td>
				<td>
				@foreach ($prefList as $klist)
					@if ($klist->pref_cd == $orderheader->dest_pref_cd){{ $klist->pref_name }}@endif
				@endforeach
					{{ $orderheader->dest_address1 }}{{ $orderheader->dest_address2 }}
				</td>
			</tr>
			<tr>
				<td class="item">納品先 住所2</td>
				<td>{{ $orderheader->dest_address3 }}</td>
			</tr>
			<tr>
				<td class="item">納品先 担当者</td>
				<td>{{ $orderheader->dest_contact_name1 }}</td>
			</tr>
			<tr>
				<td class="item">納品先電話番号</td>
				<td>{{ $orderheader->dest_tel }}</td>
			</tr>
			<tr>
				<td class="item">納品先fax番号</td>
				<td>{{ $orderheader->dest_fax }}</td>
			<tr>
				<td class="item">伝票添付</td>
				<td>@if ($orderheader->direct_delivery_type == "1")無@else有@endif</td>
			</tr>
			<tr>
				<td class="item">備考</td>
				<td>{{ $orderheader->deliver_memo }}</td>
			</tr>
		</table>
		</td>
	</tr>
</table>

<table border="0" cellpadding="0" cellspacing="0" width="100%"> 
	<tr>
		<td colspan="2">
			<br />
			<table border="0" cellpadding="0" cellspacing="0"> 
			@if ($orderheader->reti_state_type == '2')
			<tr>
				<td>
					<table width="700px" border="0" cellspacing="0">
					<tr>
						<td>
						</td>
					</tr>
					</table>
				</td>
				<td>　</td>
				<td>
					<table border="1" cellspacing="0">
					<tr>
						<td nowrap width="120px" bgcolor="#cccccc">左記のうち、返品</td>
					</tr>
					</table>
				</td>
			</tr>
			@endif
			<tr>
				<td>
					<table width="800px" border="1" cellspacing="0">
					<tr>
						<td nowrap class="item">貴社発注No.</td>
						<td nowrap width="80px" class="item">商品コード</td>
						<td nowrap width="300px" class="item">商品名称</td>
						<td nowrap width="60px" class="item">提供価格</td>
						<td nowrap width="30px" class="item">数量</td>
						<td nowrap width="60px" class="item">金額</td>
						<td nowrap width="60px" class="item">消費税</td>
						<td nowrap width="60px" class="item">消費税率</td>
					</tr>
					</table>
				</td>
				@if ($orderheader->reti_state_type == '2')
				<td>　</td>
				<td>
					<table border="1" cellspacing="0">
					<tr>
						<td nowrap width="60px" bgcolor="#cccccc">返品数量</td>
						<td nowrap width="60px" bgcolor="#cccccc">返品金額</td>
					</tr>
					</table>
				</td>
				@endif
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">
		<table border="0" cellpadding="0" cellspacing="0"> 
			@foreach ($orderdetailList as $detaillist)
			<tr>
				<td>
					<table width="800px" border="1" cellspacing="0">
					<tr>
						<td nowrap>{{ $detaillist->cust_order_num }}&nbsp;</td>
						<td nowrap width="80px">{{ $detaillist->item_cd }}</td>
						<td nowrap width="300px">{{ $detaillist->item_name_kanji }}@if ($orderheader->contents_type=="54" || $orderheader->contents_type=="55")<br>サポートプランアップグレード@endif</td>
						<td nowrap width="60px" align="right">\&nbsp;{{ number_format($detaillist->item_price) }}</td>
						<td nowrap width="30px" align="right">{{ number_format($detaillist->item_vol) }}</td>
						<td nowrap width="60px" align="right">\&nbsp;{{ number_format($detaillist->item_amt) }}</td>
						<td nowrap width="60px" align="right">\&nbsp;{{ number_format($detaillist->tax) }}</td>
						<td nowrap width="60px" align="right">@if (!empty($detaillist->tax_rate)){{ $detaillist->tax_rate * 100 }}%@endif</td>
					</tr>
					</table>
				</td>
				@if ($orderheader->reti_state_type == '2')
				<td>　</td>
				<td valign="top">
					<table border="1" cellspacing="0">
					<tr>
						<td  valign="top" nowrap width="60px" align="right"><font color="red">&nbsp; @if ($detaillist->reti_vol == "")0 @else{{ number_format($detaillist->reti_vol) }}@endif</font></td>
						<td  valign="top" nowrap width="60px" align="right"><font color="red">\&nbsp; @if ($detaillist->reti_price == "")0 @else{{ number_format($detaillist->reti_price) }}@endif</font></td>
					</tr>
					</table>
				</td>
				@endif
			</tr>
			@endforeach
		</table>
		</td>
	</tr>
	<tr>
		<td align="right" colspan="2">　</td>
	</tr>
	<tr>
		<td colspan="2">
			<table border="0" cellpadding="0" cellspacing="0"> 
			<tr>
				<td>
					<table width="800px" border="0" cellspacing="0" cellpadding=0>
					<tr>
						<td nowrap width="550px">　</td>
						<td align="right">
							<table border="1" cellspacing="0">
							<tr>
								<td nowrap width="60px" class="item">税抜額</td>
								<td nowrap width="60px" align="right">\&nbsp;{{ number_format($orderheader->order_amt) }}</td>
							</tr>
							<tr>
								<td nowrap width="60px" class="item">消費税</td>
								<td nowrap width="60px" align="right">\&nbsp;{{ number_format($orderheader->tax) }}</td>
							</tr>
							<tr>
								<td nowrap width="60px" class="item">合計</td>
								<td nowrap width="60px" align="right">\&nbsp;{{ number_format($orderheader->total_amt) }}</td>
							</tr>
							</table>
						</td>
					</tr>
					</table>
				<td>　</td>

				@if ($orderheader->reti_state_type == '2')
				<td>
					<table border="1" cellspacing="0" cellpadding=0>
					<tr>
						<td nowrap width="60px" bgcolor="#cccccc">返品合計</td>
						<td nowrap width="60px" align="right"><font color="red">\&nbsp;{{ number_format($orderheader->distri_reti_total_amt) }}</font></td>
					</tr>
					</table>
				</td>
				@endif
			</tr>
		</table>
		</td>
	</tr>
</table>
<br>
<table border="0" width="95%">
	<tr>
		<td width="30%">&nbsp;</td>
		<td width="40%" align="center">
		@if ($orderheader->delete_ok == 1 )
			@if ($orderheader->contents_type == "54" || $orderheader->contents_type == "55")
				<a href="javascript:printPreviewUpgrade();"><img src="{{ asset('assets/cust/img/print.png') }}" alt="注文書印刷" width="120px" height="50px"></a>
			@else
				<a href="javascript:printPreview();"><img src="{{ asset('assets/cust/img/print.png') }}" alt="注文書印刷" width="120px" height="50px"></a>
			@endif
		@else
				&nbsp;
		@endif
		</td>
		<td width="30%" align="right">
		@if ($orderheader->delete_ok == 1)
			<a href="javascript:delSubmit();"><img src="{{ asset('assets/cust/img/delete.png') }}" alt="削除" width="120px" height="50px"></a>
		@else
			&nbsp;
		@endif
		</td>
	</tr>
</table>

{{-- お客様情報が登録されている場合のみ表示 --}}
@if( !empty($orderheader->name1))
<table border="0">
	<tr>
		<td>
			<br /><br /><table class="select" width="400px" border="1" cellspacing="0" frame="hsides" rules="rows">
				<tr>
					<td class="item" width="200px">登録名義</td>
					<td>{{ $orderheader->name1 }}{{ $orderheader->name2 }}</td>
				</tr>
				<tr>
					<td class="item">登録名義(フリガナ)</td>
					<td>{{ $orderheader->name_kana1 }}</td>
				</tr>
				<tr>
					<td class="item">代表取締役または代表者</td>
					<td>{{ $orderheader->president_name1 }}</td>
				</tr>
				<tr>
					<td class="item">代表取締役または代表者(フリガナ)</td>
					<td>{{ $orderheader->president_name_kana1 }}</td>
				</tr>
				<tr>
					<td class="item">担当者</td>
					<td>{{ $orderheader->contact_name1 }}</td>
				</tr>
				<tr>
					<td class="item">担当者(フリガナ)</td>
					<td>{{ $orderheader->contact_name_kana1 }}</td>
				</tr>
				<tr>
				@if ($orderheader->state_type == "4")
					<td class="item">メールアドレス　　
						{{ html()->submit('変更')->style('font-size:10px;')->attribute('onclick' , 'document.frmmailchg.submit();') }}
					</td>
				@else
					<td class="item">メールアドレス</td>
				@endif
					<td>{{ $orderheader->license_mail_address }}</td>
				</tr>
				<tr>
					<td class="item">ホームページurl</td>
					<td>{{ $orderheader->url }}</td>
				</tr>
				<tr>
					<td class="item">郵便番号</td>
					<td>{{ $orderheader->post }}</td>
				</tr>
				<tr>
					<td class="item">都道府県市区町村</td>
					<td>
					@foreach ($prefList as $klist)
						@if ($klist->pref_cd == $orderheader->prefecture_cd){{ $klist->pref_name }}@endif
					@endforeach
						{{ $orderheader->address1 }}
					</td>
				</tr>
				<tr>
					<td class="item">丁番地</td>
					<td>{{ $orderheader->address2 }}</td>
				</tr>
				<tr>
					<td class="item">建物名</td>
					<td>{{ $orderheader->address3 }}</td>
				</tr>
				<tr>
					<td class="item">登録電話番号</td>
					<td>{{ $orderheader->tel }}</td>
				</tr>
				<tr>
					<td class="item">連絡先電話番号</td>
					<td>{{ $orderheader->communicate_tel }}</td>
				</tr>
				<tr>
					<td class="item">連絡先fax番号</td>
					<td>{{ $orderheader->fax }}</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
@endif


<br /><a href="javascript:history.back();"><img src="{{ asset('assets/cust/img/back.png') }}" width="120px" height="50px"></a>　<a href="javascript:window.close();"><img src="{{ asset('assets/cust/img/close.png') }}"></a>


</x-app-layout>
