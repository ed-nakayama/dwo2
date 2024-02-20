<x-admin-layout>

<head>
	<title>商品サブマスタ</title>
</head>

{{--------------------------------------------------------------------}}

@foreach ($errors->all() as $error)
          <font color=red><li>{{ $error }}</font></li>
@endforeach
{{ html()->form('GET', '/admin/product/list/search')->open() }}

<TABLE border=1>
  <TR>
     <TD  colspan=6 nowrap align="center" bgcolor="#0000a0"><FONT color="White">商品サブマスタ</FONT></TD>
  </TR>

  <TR bgcolor="#8080ff">
    <TD nowrap align="center"><FONT color="white">商品コード</FONT></TD>
    <TD nowrap align="center"><FONT color="white">Web利用(可)</FONT></TD>
    <TD nowrap align="center"><FONT color="white">在庫状況</FONT></TD>
    <TD nowrap align="center"><FONT color="white">削除</FONT></TD>
    <TD nowrap align="center"><FONT color="white">新規</FONT></TD>
    <TD nowrap align="center"><FONT color="white">検索</FONT></TD>
  </TR>
  <TR>
    <TD nowrap align="center">
		{{ html()->text('prodCode', $prodCode)->attribute('size', '12') }}
    </TD>
    <TD nowrap align="center">
		{{ html()->checkbox('webOrder', $webOrder ,'1') }}
    </TD>
    <TD nowrap>
    <SELECT name="status">
      <OPTION value="">
		@foreach ($productStatus as $list)
			{{ html()->option($list->prod_status_name, $list->prod_status_id ,($list->prod_status_id == $status)) }}
		@endforeach
    </SELECT>
    </TD>
    <TD nowrap align="center">
		{{ html()->checkbox('del', $del ,'1') }}
    </TD>
    <TD nowrap align="center">
		{{ html()->checkbox('newFlag', $newFlag ,'1') }}
    </TD>
    <TD nowrap align="center">
		{{ html()->submit('検索') }}
    </TD>
  </TR>
</TABLE>
{{ html()->form()->close() }}
    <BR>

{{ html()->form('POST', '/admin/product/list/store')->open() }}
{{ html()->hidden('prodCode', $prodCode) }}
{{ html()->hidden('webOrder', $webOrder) }}
{{ html()->hidden('status', $status) }}
{{ html()->hidden('del', $del) }}
{{ html()->hidden('newFlag', $newFlag) }}

@if(isset($prodList[0]))
    <TABLE cellspacing="0" cellpadding="2" width="100%">
      <TR>
        <td nowrap colspan="2" align="center">
			<div class="pager">
				{{ $prodList->appends(request()->query())->links('vendor.pagination.admin') }}
			</div>
		</td>
      </TR>
      <TR>
		<TH nowrap bgcolor="#8080c0" width="20"><FONT color="White">件数 {{ number_format($prodList->total()) }}</FONT></TH>
		<td></td>
      </TR>
    </TABLE>
@endif

<TABLE width="600" border="1" cellspacing="0" cellpadding="2">

	<TR bgcolor="#8080c0">
    	<TD nowrap align="center"><FONT color="white">商品コード</FONT></TD>
    	<TD nowrap align="center"><FONT color="white">商品名称</FONT></TD>
    	<TD nowrap align="center"><FONT color="white">通常製品参考価格</FONT></TD>
	    <TD nowrap align="center"><FONT color="white">販売開始日<br><font size=2>(YYYY/MM/DD)</FONT></FONT></TD>
	    <TD nowrap align="center"><FONT color="white">販売終了日<br><font size=2>(YYYY/MM/DD)</FONT></FONT></TD>
	    <TD nowrap align="center"><FONT color="white">在庫状況</FONT></TD>
	    <TD nowrap align="center"><FONT color="white">出荷可能日<br><font size=2>(YYYY/MM/DD)</FONT></FONT></TD>
	    <TD nowrap align="center"><FONT color="white">Web利用(可)</FONT></TD>
	    <TD nowrap align="center"><FONT color="white">可視</FONT></TD>
	    <TD nowrap align="center"><FONT color="white">削除</FONT></TD>
	    <TD nowrap align="center"><FONT color="white">仕切価格</FONT></TD>
    </TR>

@if(isset($prodList[0]))
	@foreach ($prodList as $key => $prod)
		<TR>
			<TD nowrap>
				<font size=2>{{ $prod->item_cd }}</font>
				{{ html()->hidden('codeList[]', $prod->item_cd) }}
			</TD>
	        <TD nowrap><font size=2>{{ $prod->item_name_kanji }}</font></TD>
	        <td nowrap style="background-color:#fffacd;">
				{{ html()->text("samplePriceList[{$prod->item_cd}]", $prod->sample_price)->attribute('style', 'background-color:#fffacd; text-align:right;') }}
	        </td>
	        <TD nowrap>
				{{html()->date("startDateList[{$prod->item_cd}]",$prod->product_sales_start_date) }}
	        </TD>
	        <TD nowrap>
				{{ html()->date("endDateList[{$prod->item_cd}]", $prod->product_sales_stop_date) }}
	        </TD>
	        <TD nowrap>
	        	<SELECT name="statusList[{{$prod->item_cd}}]">
			        <OPTION value="">
					@foreach ($productStatus as $list)
						{{ html()->option($list->prod_status_name, $list->prod_status_id ,($list->prod_status_id == $prod->product_status_id)) }}
					@endforeach
					</option>
				</select>
	        </TD>
	        <TD nowrap>
				{{ html()->date("shipDateList[{$prod->item_cd}]", $prod->product_ship_date) }}
	        </TD>
	        <TD nowrap>
				{{ html()->checkbox("webOrderList[{$prod->item_cd}]", $prod->product_web_order_flag ,$prod->item_cd) }}
	        </TD>
	        <TD nowrap>
				{{ html()->checkbox("visiblePAPStdList[{$prod->item_cd}]", $prod->product_visible_pap_std ,$prod->item_cd) }}<font size=2>PAP-M</font>
				{{ html()->checkbox("visiblePAPGoldList[{$prod->item_cd}]", $prod->product_visible_pap_gld ,$prod->item_cd) }}<font size=2>PAP-G</font>
				{{ html()->checkbox("visibleYbpPapList[{$prod->item_cd}]", $prod->product_visible_ybp_pap ,$prod->item_cd) }}<font size=2>パートナー</font>
				{{ html()->checkbox("visibleYBPList[{$prod->item_cd}]", $prod->product_visible_ybp ,$prod->item_cd) }}<font size=2>通常製品</font>　
	        </TD>
	        <TD nowrap>
				{{ html()->checkbox("delList[{$prod->item_cd}]", $prod->product_del ,$prod->item_cd) }}
	        </TD>
	        <TD nowrap><a  class="link"  href="/admin/product/price?prodCode={{ $prod->item_cd }}&prodName={{ $prod->item_name_kanji }}"><font size=2>仕切価格</font></a></TD>
	@endforeach

		<TR>
        	<TD nowrap colspan=10 align="center">
			@if (session('status') === 'success-store')
				<p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm text-blue-400 dark:text-blue-400" style="color: blue;">更新が完了しました。</p>
			@endif
				{{ html()->submit('更新') }}
        	</TD>
      	</TR>

   </TABLE>

    <TABLE cellspacing="0" cellpadding="2" width="100%">
      <TR>
        <TH nowrap bgcolor="#8080c0" width="20"><FONT color="White">件数 {{ number_format($prodList->total()) }}</FONT></TH>
		<td></td>
      </TR>
      <TR>
        <td nowrap colspan="2" align="center">
			<div class="pager">
				{{ $prodList->appends(request()->query())->links('vendor.pagination.admin') }}
			</div>
		</td>
      </TR>
    </TABLE>


@endif

{{ html()->form()->close() }}

{{--------------------------------------------------------------------}}

</x-admin-layout>
