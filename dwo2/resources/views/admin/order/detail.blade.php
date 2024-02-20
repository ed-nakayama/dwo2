<x-admin-layout>

<head>
	<title>受注詳細 (WEB受注)</title>
</head>


{{--------------------------------------------------------------------}}

     <TABLE width="300">
     <TR>
     <TD nowrap align="center" bgcolor="#0000a0"><FONT color="White">受注詳細 (WEB受注)</FONT></TD></TR>
    </TABLE>

{{ html()->form('POST', '/admin/order/list/detail/store')->attribute('name','dtl')->open() }}
<INPUT type ="hidden" name = "orderNum" value ="{{ $headerView->web_order_num }}">
<DIV align="left">
<TABLE>
  <TR>
    <TD nowrap align="center">
    <DIV align="left">
      <TABLE width="350" border="1" cellspacing="0" cellpadding="2">
      <TR>
        <TD nowrap align="left" width="10%" bgcolor="#8080c0"><FONT color="white">現在のステータス</FONT></TD>
        <TD nowrap>
        <SELECT name="stateType">
        <OPTION selected value="">　</option>
		@foreach ($orderStatus as $st)
			{{ html()->option($st->order_status_name, $st->order_status_id ,($headerView->state_type == $st->order_status_id)) }}
		@endforeach
        </SELECT>
        </TD>
      </TR>
      <TR>
        <TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">得意先 名称</FONT></TD>
        <TD nowrap>{{ $headerView->search_name }}</TD></TR>
      <TR>
        <TD nowrap align="left" width="10%" bgcolor="#8080c0"><FONT color="white">受付No.</FONT></TD>
        <TD nowrap>{{ $headerView->web_order_num }}</TD></TR>
      <TR>
        <TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">受付日</FONT></TD>
        <TD nowrap>
			{{ html()->text('orderDate', $headerView->order_date)->attributes(['size' => '10', 'maxlength' => '8']) }}
        </TD></TR>
      <TR>
        <TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">出荷日</FONT></TD>
        <TD nowrap>
			{{ html()->text('shippingDate', $headerView->shipping_date)->attributes(['size' => '10', 'maxlength' => '8']) }}
        </TD></TR>
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
        </TD></TR>
      <TR>
        <TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">AM指定</FONT></TD>
        <TD nowrap>
			{{ html()->checkbox('deliveryTimeType', $headerView->delivery_time_type ,'1') }}
        </TD></TR>
@else
      <TR>
        <TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">着日指定</FONT></TD>
        <TD nowrap>
			{{ html()->hidden('deliveryDateType' ,$headerView->delivery_date_type) }}
        	@if ($headerView->delivery_date_type == '1')あり@elseなし@endif
        </TD></TR>
      <TR>
        <TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">着日</FONT></TD>
        <TD nowrap>
			{{ html()->hidden('deliveryDate' ,$headerView->delivery_date) }}
        	{{ str_replace('-', '/' ,substr($headerView->delivery_date,0,10)) }}
        </TD></TR>
      <TR>
        <TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">AM指定</FONT></TD>
        <TD nowrap>
			{{ html()->hidden('deliveryTimeType' ,$headerView->delivery_time_type) }}
        	@if ($headerView->delivery_time_type == '1')あり@elseなし@endif
        </TD></TR>
@endif
@if ($headerView->state_type == '0' || $headerView->state_type == '5' || $headerView->state_type == '8' || $headerView->state_type == '9')
      <TR>
        <TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 名称</FONT></TD>
        <TD nowrap>
			{{ html()->text('destName1', $headerView->dest_name1)->attribute('size', '30') }}
        </TD></TR>
      <TR>
        <TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 郵便番号</FONT></TD>
        <TD nowrap>
			{{ html()->text('destPost', $headerView->dest_post) }}
        </TD></TR>
      <TR>
        <TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 都道府県</FONT></TD>
        <TD nowrap>
        <SELECT name="destPrefCd">
        <OPTION selected value="">　</option>
			@foreach ($prefList as $pre)
				{{ html()->option($pre->pref_name, $pre->pref_cd ,($headerView->dest_pref_cd == $pre->pref_cd)) }}
			@endforeach
        </SELECT>
        </TD></TR>
      <TR>
        <TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 住所1</FONT></TD>
        <TD nowrap>
			{{ html()->text('destAddress1', $headerView->dest_address1)->attribute('size', '50') }}
        </TD></TR>
      <TR>
        <TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 住所2</FONT></TD>
        <TD nowrap>
			{{ html()->text('destAddress2', $headerView->dest_address2)->attribute('size', '50') }}
        </TD></TR>
      <TR>
        <TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 住所3</FONT></TD>
        <TD nowrap>
			{{ html()->text('destAddress3', $headerView->dest_address3)->attribute('size', '50') }}
        </TD></TR>
      <TR>
        <TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 担当者</FONT></TD>
        <TD nowrap>
			{{ html()->text('destContactName1', $headerView->dest_contact_name1) }}
        </TD></TR>
      <TR>
        <TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 電話番号</FONT></TD>
        <TD nowrap>
			{{ html()->text('destTel', $headerView->dest_tel) }}
        </TD></TR>
      <TR>
        <TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 FAX番号</FONT></TD>
        <TD nowrap>
			{{ html()->text('destFax',$headerView->dest_fax) }}
        </TD></TR>
@else
      <TR>
        <TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 名称</FONT></TD>
        <TD nowrap>
			{{ html()->hidden('destName1', $headerView->dest_name1) }}
			{{ $headerView->dest_name1 }}
        </TD></TR>
      <TR>
        <TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 郵便番号</FONT></TD>
        <TD nowrap>
			{{ html()->hidden('destPost', $headerView->dest_post) }}
			{{ $headerView->dest_post }}
        </TD></TR>
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
        </TD></TR>
      <TR>
        <TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 住所1</FONT></TD>
        <TD nowrap>
			{{ html()->hidden('destAddress1', $headerView->dest_address1) }}
        	{{ $headerView->dest_address1 }}
        </TD></TR>
      <TR>
        <TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 住所2</FONT></TD>
        <TD nowrap>
			{{ html()->hidden('destAddress2', $headerView->dest_address2) }}
        	{{ $headerView->dest_address2 }}
        </TD></TR>
      <TR>
        <TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 住所3</FONT></TD>
        <TD nowrap>
			{{ html()->hidden('destAddress3', $headerView->dest_address3) }}
        	{{ $headerView->dest_address3 }}
        </TD></TR>
      <TR>
        <TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 担当者</FONT></TD>
        <TD nowrap>
			{{ html()->hidden('destContactName1', $headerView->dest_contact_name1) }}
        	{{ $headerView->dest_contact_name1 }}
        </TD></TR>
      <TR>
        <TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 電話番号</FONT></TD>
        <TD nowrap>
			{{ html()->hidden('destTel', $headerView->dest_tel) }}
        	{{ $headerView->dest_tel }}
        </TD></TR>
      <TR>
        <TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 FAX番号</FONT></TD>
        <TD nowrap>
			{{ html()->hidden('destFax', $headerView->dest_fax) }}
        	{{ $headerView->dest_fax }}
        </TD></TR>
@endif
      <TR>
        <TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">直送(伝票添付なし)</FONT></TD>
        <TD nowrap>
			{{ html()->checkbox('directDeliveryType', $headerView->direct_delivery_type ,'1') }}
        </TD></TR>
      <TR>
        <TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">備考</FONT></TD>
        <TD nowrap>
			{{ html()->text('deliverMemo', $headerView->deliver_memo)->attributes(['size' => '30', 'maxlength' => '30']) }}
        </TD></TR>
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
        </TD></TR>
      <TR>
        <TD nowrap align="left" bgcolor="#008080"><FONT color="White">[摘要項目]PAP事業所コード</FONT></TD>
        <TD nowrap>{{ $secondaryCustNum }}</TD></TR>
      <TR>
        <TD nowrap align="left" bgcolor="#008080"><FONT color="White">[摘要項目]PAP事業所名</FONT></TD>
        <TD nowrap>{{ $secondaryCustName }}</TD></TR>
      <TR>
        <TD nowrap align="left" bgcolor="#008080"><FONT color="White">[摘要項目]登録ユーザー名</FONT></TD>
        <TD nowrap>{{ $headerView->name1 }}</TD></TR>
      <TR>
        <TD nowrap align="left" bgcolor="#008080"><FONT color="White">[摘要項目]メモ</FONT></TD>
        <TD nowrap>{{ $headerView->deliver_memo }}</TD></TR>
    </TABLE>
<BR>
<center>
		@if (session('status') === 'success-store')
			<p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm text-blue-400 dark:text-blue-400" style="color: blue;">更新が完了しました。</p>
		@endif
{{ html()->submit('更新') }}

</center>
{{ html()->form()->close() }}
</DIV>

<BR>
<table  border="0">
<tr><td>
    <TABLE width="600" border="1" cellspacing="0" cellpadding="2">
      <TR bgcolor="#8080c0">
        <TH nowrap align="center"><FONT color="White">貴社発注No.</FONT></TH>
        <TH nowrap align="center" width="12%"><FONT color="White">商品コード</FONT></TH>
        <TH nowrap align="center" width="22%"><FONT color="White">商品名称</FONT></TH>
        <TH nowrap align="center" width="14%"><FONT color="White">ご提供価格</FONT></TH>
        <TH nowrap align="center" width="6%"><FONT color="White">数量</FONT></TH>
        <TH nowrap align="center" width="16%"><FONT color="White">金額</FONT></TH>
      </TR>
@foreach ($detailViewList as $list)
      <TR>
        <TD nowrap align="center">{{ $list->order_line_num }}</TD>
        <TD nowrap align="center">{{ $list->item_cd }}</TD>
        <TD nowrap align="left">{{ $list->item_name_kanji }}</TD>
        <TD nowrap align="right">{{ number_format($list->item_price) }}</TD>
        <TD nowrap align="right">{{ number_format($list->item_vol) }}</TD>
        <TD nowrap align="right">{{ number_format($list->item_amt) }}</TD>
      </TR>
@endforeach
   </TABLE>
</td></tr>
<tr>
	<td align="right">
		<TABLE width="150" border="1" cellspacing="0" cellpadding="2">
			<TR>
				<TD nowarp align="center" bgcolor="#8080c0"><FONT color="white">合計</FONT></TD>
				<TD align="right"bgcolor="white">{{ number_format($headerView->order_amt) }}</TD>
			</TR>
		</TABLE>
	</td>
</tr>
</table>
<BR>

@if ($headerView->contents_type == '54' || $headerView->contents_type == '55')
	{{ html()->form('POST', '/admin/order/list/detail/upgradeprint')->attributes(['name' => 'frmPrt', 'target' => '_blank'])->open() }}
@else
	{{ html()->form('POST', '/admin/order/list/detail/printview')->attributes(['name' =>'frmPrt' ,'target' =>'_blank'])->open() }}
@endif
{{ html()->hidden('orderNum', $headerView->web_order_num) }}
{{ html()->submit('注文確認書 発行') }}
{{ html()->form()->close() }}

</TD>
</TR>
</TABLE>
{{--------------------------------------------------------------------}}

</x-admin-layout>
