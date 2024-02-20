<x-admin-layout>

<head>
	<title>受注編集詳細 (WEB受注)</title>
</head>

{{--------------------------------------------------------------------}}

<script type="text/javascript">
<!--
	function calc(o_num) {
		var taxRate = document.getElementsByName('itemTaxRate[]')[o_num].value;
		var vol = document.getElementsByName('itemVol[]')[o_num].value;
		var price = document.getElementsByName('itemPrice[]')[o_num].value;
		var total = vol * price;

		document.getElementsByName('itemAmt[]')[o_num].value = total;
		document.getElementsByName('itemAmtDummy[]')[o_num].value = total;

		if (taxRate != "") {
			var tax = Math.floor(total * taxRate);

			document.getElementsByName('itemTax[]')[o_num].value = tax;
			document.getElementsByName('itemTaxDummy[]')[o_num].value = tax;
		}

		totalCalc();
	}


	function totalCalc() {
		var i;
		var j;
		var sum = 0;
		var taxSum = 0;
		var temp;

		for (i = 0; i < {{ $detailViewList->count() }}; i++) {
			if (document.getElementsByName('itemDel[]')[i].checked == true) {
			} else {
				sum = eval(sum + "+" + document.getElementsByName('itemAmt[]')[i].value);
				if (document.getElementsByName('itemTax[]')[i].value != '') {
					taxSum = eval(taxSum + "+" + document.getElementsByName('itemTax[]')[i].value);
				}
			}
		}

		document.dtl.orderAmt.value = sum;
		document.dtl.orderAmtDummy.value = sum;

		if (taxSum == 0) {
			var taxRate = document.dtl.taxRate.value;
			document.dtl.tax.value = Math.floor(sum * taxRate);
			document.dtl.taxDummy.value = document.dtl.tax.value;
		} else {
			document.dtl.tax.value = taxSum;
			document.dtl.taxDummy.value = taxSum;
		}

		document.dtl.totalAmt.value = eval(sum + "+" + document.dtl.tax.value);
		document.dtl.totalAmtDummy.value = document.dtl.totalAmt.value;
	}



	function prod_search(num) {
		if (document.getElementsByName('itemCd[]')[num].value == "") {
			alert("商品コード号を入力してください。");
			document.getElementsByName('itemCd[]')[num].focus();
			return;
		}

		document.frmProd.num.value = num;
		document.frmProd.prodCode.value = document.getElementsByName('itemCd[]')[num].value;
		document.frmProd.custNum.value = "{{ $headerView->cust_num }}";

		w = window.open("", "prodWin", "width=640,height=480,scrollbars=yes");
		if (w) {
			document.frmProd.submit();
		}
	}

	function setProd(p_num ,p_code ,p_name ,p_price) {
		document.getElementsByName('itemCd[]')[p_num].value = p_code;
		document.getElementsByName('itemName[]')[p_num].value = p_name;
		document.getElementsByName('itemPrice[]')[p_num].value = p_price;
		document.getElementsByName('itemPriceDummy[]')[p_num].value = p_price;

		calc(p_num);

	}


	function updateDtlX() {
		var res = confirm("更新してもいいですか？");
		// 選択結果で分岐
		if (res == true) {
			document.dtl.submit();
		}
	}


	function updateMailX() {
		var res = confirm("更新後、メール送信してもいいですか？");
		// 選択結果で分岐
		if (res == true) {
			document.dtl.updateMail.value = "1";
			document.dtl.submit();
		}
	}

-->
</script>

{{ html()->form('GET', '/admin/order/list2/search/prod')->attributes(['name'=> 'frmProd', 'target' => 'prodWin'])->open() }}
{{ html()->hidden('num') }}
{{ html()->hidden('prodCode') }}
{{ html()->hidden('custNum') }}
{{ html()->form()->close() }}


{{ html()->form('POST', '/admin/order/list2/store')->attribute('name', 'dtl')->open() }}
{{ html()->hidden('orderNum' ,$headerView->web_order_num) }}
{{ html()->hidden('contentsType' ,$headerView->contents_type) }}

<DIV align="left">
<TABLE>
<TR>
	<TD nowrap align="center" bgcolor="#0000a0"><FONT color="White">受注編集詳細 (WEB受注)</FONT></TD>
</TR>
<TR>
	<TD nowrap align="center">　</TD>
</TR>
<TR>
    <TD nowrap align="center">
    <DIV align="left">

      <TABLE width="350" border="1" cellspacing="0" cellpadding="2">
	<TR>
		<TD width="40%" nowrap align="left" bgcolor="#8080c0"><FONT color="white">現在のステータス</FONT></TD>
		<TD nowrap>
			<SELECT name="stateType">
				<OPTION selected value=""></option>
				@foreach ($orderStatus as $st)
					{{ html()->option($st->order_status_name, $st->order_status_id ,($headerView->state_type == $st->order_status_id)) }}
				@endforeach}
			</SELECT>
		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">得意先 名称</FONT></TD>
		<TD nowrap>{{ $headerView->search_name }}</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">受付No.</FONT></TD>
		<TD nowrap>{{ $headerView->web_order_num }}</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">受付日</FONT></TD>
		<TD nowrap>
			{{ html()->text('orderDate', $headerView->order_date)->attributes(['size' => '10', 'maxlength' => '8']) }}
		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">出荷日</FONT></TD>
		<TD nowrap>
			{{ html()->text('shippingDate', $headerView->shipping_date)->attributes(['size' => '10', 'maxlength' => '8']) }}
		</TD>
	</TR>
	<TR>
		<TD nowrap align="light" bgcolor="#8080c0"><FONT color="White">発注担当者</FONT></TD>
		<TD nowrap>
			{{ html()->text('orderPersonName', $headerView->dwo_order_person_name)->attributes(['size' => '15', 'maxlength' => '15']) }}　様
		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">サプライ二重梱包</FONT></TD>
		<TD nowrap>
			{{ html()->checkbox('doublePackageType', $headerView->double_package_type ,'1') }}
		</TD>
	</TR>
	
@if ($headerView->state_type != '1')
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">着日指定</FONT></TD>
		<TD nowrap>
			{{ html()->checkbox('deliveryDateType', $headerView->delivery_date_type ,'1') }}
		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">着日</FONT></TD>
		<TD nowrap>
			{{ html()->text('deliveryDate', $headerView->delivery_date)->attributes(['size' => '10', 'maxlength' => '8']) }}
		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">AM指定</FONT></TD>
		<TD nowrap>
			{{ html()->checkbox('deliveryTimeType', $headerView->delivery_time_type ,'1') }}
		</TD>
	</TR>
@else
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">着日指定</FONT></TD>
		<TD nowrap>
			{{ html()->hidden('deliveryDateType' ,$headerView->delivery_date_type) }}
			 @if ($headerView->delivery_date_type == '1')あり@elseなし@endif
		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">着日</FONT></TD>
		<TD nowrap>
			{{ html()->hidden('deliveryDate' ,$headerView->delivery_date) }}
			{{ $headerView->delivery_date }}
		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">AM指定</FONT></TD>
		<TD nowrap>
			{{ html()->hidden('deliveryTimeType' ,$headerView->delivery_time_type) }}
			@if ($headerView->delivery_time_type == '1')あり@elseなし@endif
		</TD>
	</TR>
@endif

@if ($headerView->state_type == '0' || $headerView->state_type == '5' || $headerView->state_type == '8' || $headerView->state_type == '9')
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 名称</FONT></TD>
		<TD nowrap>
			{{ html()->text('destName1', $headerView->dest_name1)->attribute('size', '50') }}
		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 郵便番号</FONT></TD>
		<TD nowrap>
			{{ html()->text('destPost', $headerView->dest_post) }}
		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 都道府県</FONT></TD>
		<TD nowrap>
			<SELECT name="destPrefCd">
				{{ html()->option('') }}
				@foreach ($prefList as $pref)
					{{ html()->option($pref->pref_name, $pref->pref_cd ,($headerView->dest_pref_cd == $pref->pref_cd)) }}
				@endforeach
			</SELECT>
		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 住所1</FONT></TD>
		<TD nowrap>
			{{ html()->text('destAddress1', $headerView->dest_address1)->attribute('size', '50') }}
		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 住所2</FONT></TD>
		<TD nowrap>
			{{ html()->text('destAddress2', $headerView->dest_address2)->attribute('size', '50') }}
		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 住所3</FONT></TD>
		<TD nowrap>
			{{ html()->text('destAddress3', $headerView->dest_address3)->attribute('size', '50') }}
		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 担当者</FONT></TD>
		<TD nowrap>
			{{ html()->text('destContactName1', $headerView->dest_contact_name1) }}
		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 電話番号</FONT></TD>
		<TD nowrap>
			{{ html()->text('destTel', $headerView->dest_tel) }}
		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 FAX番号</FONT></TD>
		<TD nowrap>
			{{ html()->text('destFax',$headerView->dest_fax) }}
		</TD>
	</TR>
@else
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 名称</FONT></TD>
		<TD nowrap>
			{{ html()->hidden('destName1', $headerView->dest_name1) }}
			{{ $headerView->dest_name1 }}
		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 郵便番号</FONT></TD>
		<TD nowrap>
			{{ html()->hidden('destPost', $headerView->dest_post) }}
			{{ $headerView->dest_post }}
		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 都道府県</FONT></TD>
		<TD nowrap>
			{{ html()->hidden('destPrefCd', $headerView->dest_pref_cd) }}
			@foreach ($prefList as $pref)
				@if ($headerView->dest_pref_cd == $pref->pref_cd)
					{{ $pref->pref_name }}
				@break;
				@endif
			@endforeach
		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 住所1</FONT></TD>
		<TD nowrap>
			{{ html()->hidden('destAddress1', $headerView->dest_address1) }}
			{{ $headerView->dest_address1 }}
		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 住所2</FONT></TD>
		<TD nowrap>
			{{ html()->hidden('destAddress2', $headerView->dest_address2) }}
			{{ $headerView->dest_address2 }}
		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 住所3</FONT></TD>
		<TD nowrap>
			{{ html()->hidden('destAddress3', $headerView->dest_address3) }}
			{{ $headerView->dest_address3 }}
		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 担当者</FONT></TD>
		<TD nowrap>
			{{ html()->hidden('destContactName1', $headerView->dest_contact_name1) }}
			{{ $headerView->dest_contact_name1 }}
		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 電話番号</FONT></TD>
		<TD nowrap>
			{{ html()->hidden('destTel', $headerView->dest_tel) }}
			{{ $headerView->dest_tel }}
			</TD>
		</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 FAX番号</FONT></TD>
		<TD nowrap>
			{{ html()->hidden('destFax', $headerView->dest_fax) }}
			{{ $headerView->dest_fax }}
		</TD>
	</TR>
@endif

	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">直送(伝票添付なし)</FONT></TD>
		<TD nowrap>
			{{ html()->checkbox('directDeliveryType', $headerView->direct_delivery_type ,'1') }}
		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">備考</FONT></TD>
		<TD nowrap></TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">ユーザ削除</FONT></TD>
		<TD nowrap>
			{{ html()->checkbox('custDelType', $headerView->cust_del_type ,'1') }}
		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">オペレータ削除</FONT></TD>
		<TD nowrap>
			{{ html()->checkbox('operatorDelType', $headerView->operator_del_type ,'1') }}
		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#008080"><FONT color="White">[摘要項目]PAP事業所コード</FONT></TD>
		<TD nowrap>{{ $secondaryCustNum }}</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#008080"><FONT color="White">[摘要項目]PAP事業所名</FONT></TD>
		<TD nowrap>{{ $secondaryCustName }}</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#008080"><FONT color="White">[摘要項目]登録ユーザー名</FONT></TD>
		<TD nowrap>{{ $headerView->reg_name1 }}</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#008080"><FONT color="White">[摘要項目]メモ</FONT></TD>
		<TD nowrap>{{ $headerView->deliver_memo }}</TD>
	</TR>
</TABLE>
</DIV>
@foreach ($errors->all() as $error)
          <font color=red><li>{{ $error }}</font></li>
@endforeach

<TABLE border="0">
	<tr>
		<td align="right">受注内容区分:{{$headerView->contents_type }}　　明細行数：{{ $detailViewList->count() }}</td>
	</tr>
	<tr>
		<td>
			<TABLE width="600" border="1" cellspacing="0" cellpadding="2">
				<TR bgcolor="#8080c0">
					<TH nowrap align="center"><FONT color="White">No.</FONT></TH>
					<TH nowrap align="center"><FONT color="White">貴社発注No.</FONT></TH>
					<TH nowrap align="center"><FONT color="White">商品コード</FONT></TH>
					<TH nowrap align="center"><FONT color="White">商品名称</FONT></TH>
					<TH nowrap align="center"><FONT color="White">ご提供価格</FONT></TH>
					<TH nowrap align="center"><FONT color="White">数量</FONT></TH>
					<TH nowrap align="center"><FONT color="White">金額</FONT></TH>
					<TH nowrap align="center"><FONT color="White">消費税率</FONT></TH>
					<TH nowrap align="center"><FONT color="White">消費税</FONT></TH>
					@if ($headerView->contents_type  == '40' || $headerView->contents_type  == '81' || $headerView->contents_type  == '82')
						<TH nowrap align="center"><FONT color="White">削除</FONT></TH>
					@endif
				</tr>

				@foreach ($detailViewList as $list)
					@if ($headerView->contents_type  == '40' || $headerView->contents_type  == '81' || $headerView->contents_type  == '82')
						<TR>
							{{ html()->hidden('orderLineNum[]', $list->order_line_num) }}
							<TD nowrap align="right">{{ $list->order_line_num }}</TD>
							<TD nowrap align="center">
								{{ html()->text('custOrderNum[]', $list->cust_order_num)->attribute('size', '20') }}
							</TD>
							<TD nowrap align="center"><INPUT type="text" size="20" name="itemCd[]" value="{{ $list->item_cd }}">
								{{ html()->submit('検索')->attribute('onclick', "prod_search($loop->index)") }}
							</TD>
							<TD nowrap align="left">
								{{ html()->text('itemName[]', $list->item_name_kanji)->attribute('size', '40') }}
							</TD>
							<TD nowrap align="right">
								{{ html()->hidden('itemPrice[]', $list->item_price) }}
								{{ html()->text('itemPriceDummy[]', $list->item_price)->attribute('size', '10')->disabled() }}
							</TD>
							<TD nowrap align="right"><INPUT size="10" type="text" onChange="calc({{ $loop->index }})" name="itemVol[]" value="{{ $list->item_vol }}"></TD>
							<TD nowrap align="right">
								{{ html()->hidden('itemAmt[]', $list->item_amt) }}
								{{ html()->text('itemAmtDummy[]', $list->item_amt)->attribute('size', '10')->disabled() }}
							</TD>
							<TD nowrap align="right">
								{{ html()->hidden('itemTaxRate[]', $list->tax_rate) }}
								{{ html()->text('itemTaxRateDummy[]', number_format($list->tax_rate,2))->attribute('size', '10')->disabled() }}
							</TD>
							<TD nowrap align="right">
								{{ html()->hidden('itemTax[]', $list->tax) }}
								{{ html()->text('itemTaxDummy[]', $list->tax)->attribute('size', '10')->disabled() }}
							</TD>
							<TD nowrap align="center">
								{{ html()->checkbox('itemDel[]', false, $list->order_line_num)->attribute('onClick', 'totalCalc();') }}
							</TD>
						</TR>
					@else
						<TR>
							<INPUT type="hidden" name="orderLineNum[]" value="{{ $list->order_line_num }}">
							<TD nowrap align="right">{{ $list->order_line_num }}</TD>
			 				<TD nowrap align="center">
								{{ html()->hidden('custOrderNum[]', $list->cust_order_num) }}
								{{ $list->cust_order_num }}
							</TD>
							 <TD nowrap align="center">
								{{ html()->hidden('itemCd[]', $list->item_cd) }}
								{{ $list->item_cd }}
							</TD>
							<TD nowrap align="left">{{ $list->item_name_kanji }}</TD>
							<TD nowrap align="right">
								{{ html()->hidden('itemPrice[]', $list->item_price) }}
								{{ number_format($list->item_price) }}
							</TD>
							<TD nowrap align="right">
								{{ html()->hidden('itemVol[]', $list->item_vol) }}
								{{ $list->item_vol }}
							</TD>
							<TD nowrap align="right">
								{{ html()->hidden('itemAmt[]', $list->item_amt) }}
								{{ number_format($list->item_amt) }}
							</TD>
							<TD nowrap align="right">
								{{ html()->hidden('itemTaxRate[]', $list->tax_rate) }}
								{{ number_format($list->tax_rate, 2) }}
							</TD>
							<TD nowrap align="right">
								{{ html()->hidden('itemTax[]', $list->tax) }}
								{{ number_format($list->tax) }}
							</TD>
						</TR>
					@endif
				@endforeach

			</TABLE>
		</td>
	</tr>
<tr>
	<td>
		<DIV align="right">
		<TABLE  align="right" border="1" cellspacing="0" cellpadding="2">
@if ($headerView->contents_type == '40' || $headerView->contents_type == '81' || $headerView->contents_type == '82')
		<TR>
			<TD nowrap align="center" bgcolor="#8080c0"><FONT color="white">合計</FONT></TD>
			<TD align="right" bgcolor="white">
				{{ html()->hidden('orderAmt', $headerView->order_amt) }}
				{{ html()->text('orderAmtDummy', $headerView->order_amt)->attribute('size', '15')->disabled() }}
			</TD>
		</TR>
		<TR>
			<TD nowrap align="center" bgcolor="#8080c0"><FONT color="white">消費税率</FONT></TD>
			<TD align="right"bgcolor="white">
				{{ html()->hidden('taxRate', $headerView->tax_rate) }}
				{{ html()->text('taxRateDummy', number_format($headerView->tax_rate, 2))->attribute('size', '15')->disabled() }}
			</TD>
		</TR>
		<TR>
			<TD nowrap align="center" bgcolor="#8080c0"><FONT color="white">消費税</FONT></TD>
			<TD align="right"bgcolor="white">
				{{ html()->hidden('tax', $headerView->tax) }}
				{{ html()->text('taxDummy', $headerView->tax)->attribute('size', '15')->disabled() }}
			</TD>
		</TR>
		<TR>
			<TD nowrap align="center" bgcolor="#8080c0"><FONT color="white">総合計金額</FONT></TD>
			<TD align="right"bgcolor="white">
				{{ html()->hidden('totalAmt', $headerView->total_amt) }}
				{{ html()->text('totalAmtDummy', $headerView->total_amt)->attribute('size', '15')->disabled() }}
			</TD>
		</TR>
@else
		<TR>
			<TD nowrap align="center" bgcolor="#8080c0"><FONT color="white">合計</FONT></TD>
			<TD align="right"bgcolor="white">
				{{ html()->hidden('orderAmt', $headerView->order_amt) }}
				{{ number_format($headerView->order_amt) }}
			</TD>
		</TR>
{{--
		<TR>
			<TD nowrap align="center" bgcolor="#8080c0"><FONT color="white">消費税率</FONT></TD>
			<TD align="right"bgcolor="white">
				{{ html()->hidden('taxRate', $headerView->tax_rate) }}
				{{  number_format($headerView->tax_rate, 2) }}
			</TD>
		</TR>
--}}
		<TR>
			<TD nowrap align="center" bgcolor="#8080c0"><FONT color="white">消費税</FONT></TD>
			<TD align="right"bgcolor="white">
				{{ html()->hidden('tax', $headerView->tax) }}
				{{ number_format($headerView->tax) }}
			</TD>
		</TR>
		<TR>
			<TD nowrap align="center" bgcolor="#8080c0"><FONT color="white">総合計金額</FONT></TD>
			<TD align="right"bgcolor="white">
				{{ html()->hidden('totalAmt', $headerView->total_amt) }}
				{{ number_format($headerView->total_amt) }}
			</TD>
		</TR>
@endif
		</TABLE>
		</DIV>
	</td>
</tr>
<tr>
	<td align="center">
		@if (session('status') === 'success-store')
			<p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm text-blue-400 dark:text-blue-400" style="color: blue;">更新が完了しました。</p>
		@endif
	</td>
</tr>
<tr>
	<td align="center">
		{{ html()->hidden('updateMail') }}
		{{ html()->submit('　更新　')->attributes(['name' => 'updDtl', 'onclick' => "updateDtlX();return false;"]) }}
		{{ html()->submit('更新後メール送信')->attributes(['name' => 'updMail', 'onclick' => "updateMailX();return false;"]) }}
	</td>
</tr>
{{ html()->form()->close() }}
<tr>
	<td align="center">
		<BR>
	@if  ($headerView->contents_type == "54" || $headerView->contents_type == "55")
		{{ html()->form('POST', '/admin/order/list/detail/upgradeprint')->attributes(['name' => 'frmPrt', 'target' => '_blank'])->open() }}
	@else
		{{ html()->form('POST', '/admin/order/list/detail/printview')->attributes(['name' => 'frmPrt', 'target' => '_blank'])->open() }}
	@endif
		{{ html()->hidden('orderNum', $headerView->web_order_num) }}
		{{ html()->submit('注文確認書 発行') }}
		{{ html()->form()->close() }}
	</td>
</tr>
</TABLE>


{{--------------------------------------------------------------------}}

</x-admin-layout>
