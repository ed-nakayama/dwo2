<x-admin-layout>

<head>
	<title>納品先マスタ</title>
</head>


{{--------------------------------------------------------------------}}

<table width="500" border="0" cellspacing="5" cellpadding="0">

	<tr>
		<td nowrap align="center" valign="top">
			<TABLE width="300">
    			<TR><TD nowrap align="center" bgcolor="#0000a0"><FONT color="White">納品先マスタ</FONT></TD></TR>
    		</TABLE>
    	</td>
    </tr>

    <tr>
		<td nowrap align="left" valign="top">
			@foreach ($errors->all() as $error)
				<li style="list-style:none; color:red;">{{ $error }}</li>
			@endforeach
		</td>
	</tr>

	<tr>
		<td>
		    <TABLE width="300" border="1" cellspacing="0" cellpadding="2">
		      <TR bgcolor="#8080c0">
		        <TH nowrap><FONT size=2 color="White">得意先コード</FONT></TH>
		        <TH nowrap><FONT size=2 color="White">得意先名称</FONT></TH>
		      </TR>
@if (!empty($cust))
		      <TR>
		        <td nowrap>{{ $cust->cust_num }}</td><td nowrap>{{ $cust->name1 . $cust->name2 }}</td>
		      </TR>
@endif
		    </TABLE>
		</td>
	</tr>
	
	<tr>
		<td>
			<table cellspacing="0" cellpadding="2" style="width:100%;">
		      <tr>
		        <td align="center" colspan="2" align="center">
				@if(isset($dataList[0]))
					<div class="pager">
						{{ $dataList->appends(request()->query())->links('vendor.pagination.admin') }}
					</div>
				@endif
		       	</td>
		      </tr>
		      <tr>
		      	<td></td>
				<th nowrap align="right">
					<TH nowrap bgcolor="#8080c0" width="20"><FONT color="White">総件数 {{ number_format($dataList->total()) }}</FONT></TH>
				</th>
		      </tr>
		    </table>
		</td>
	</tr>
	
	<tr>
		<td>
			{{ html()->form('POST', '/admin/order/delivery/store')->open() }}
			{{ html()->hidden('search_cust_code', $param['search_cust_code']) }}
			{{ html()->hidden('search_delivery_name', $param['search_delivery_name']) }}
			{{ html()->hidden('search_tel', $param['search_tel']) }}
			{{ html()->hidden('search_addr', $param['search_addr']) }}
			<TABLE width="600" border="1" cellspacing="0" cellpadding="2">
				<TR bgcolor="#8080c0">
					<TH nowrap colspan=2><FONT size=2 color="White">納品先名称</FONT></TH>
					<TH nowrap><FONT size=2 color="White">担当者</FONT></TH>
					<TH nowrap><FONT size=2 color="White">電話番号</FONT></TH>
					<TH nowrap><FONT size=2 color="White">FAX番号</FONT></TH>
					<TH nowrap><FONT size=2 color="White">更新日</FONT></TH>
					<TH nowrap><FONT size=2 color="White">削除</FONT></TH>
				</TR>
				<TR bgcolor="#8080c0">
					<TH nowrap><FONT size=2 color="White">郵便番号</FONT></TH>
					<TH nowrap><FONT size=2 color="White">都道府県</FONT></TH>
					<TH nowrap><FONT size=2 color="White">住所１</FONT></TH>
					<TH nowrap colspan=2><FONT size=2 color="White">住所２</FONT></TH>
					<TH nowrap colspan=2><FONT size=2 color="White">住所３</FONT></TH>
				</TR>
@if (!empty($dataList[0]))
				@foreach ($dataList as  $list)
					<tbody>
					@if ($loop->index %2 == 0)
						<TR bgcolor="#d1d1e9">
					@else
						<TR>
					@endif
						{{ html()->hidden('codeList[]', $list->delivery_cust_code) }}
						{{ html()->hidden('seqList[]', $list->delivery_seq) }}

						@php
							$arg = $list->delivery_cust_code . '_' . $list->delivery_seq;
						@endphp
						<TD nowrap colspan=2>
							{{ html()->text("destList[$arg]", $list->delivery_name)->attribute('size', '50') }}
						</TD>
						<TD nowrap>
							{{ html()->text("personNameList[$arg]", $list->delivery_name_of_charge)->attribute('size', '15') }}
						</TD>
						<TD nowrap>
							{{ html()->text("telList[$arg]", $list->delivery_tel)->attribute('size', '15') }}
						</TD>
						<TD nowrap>
							{{ html()->text("faxList[$arg]", $list->delivery_fax)->attribute('size', '15') }}
					</TD>
						<TD nowrap>
							{{ substr(str_replace("-", "/", $list->delivery_update), 0, 10) }}
						</TD>
						<TD nowrap align="center">
							{{ html()->checkbox("delList[$arg]", $list->delivery_del ,$arg) }}
						</TD>
					</TR>
					@if ($loop->index %2 == 0)
						<TR bgcolor="#d1d1e9">
					@else
						<TR>
					@endif
						<TD nowrap>
							{{ html()->text("zipList[$arg]", $list->delivery_zip)->attribute('size', '10') }}
						</TD>
						<TD>
							<SELECT name="prefList[{{$arg}}]">
								<OPTION value="">
								@foreach ($prefList as $pref)
									{{ html()->option($pref->pref_name, $pref->pref_cd ,($pref->pref_cd == $list->delivery_pref)) }}
								@endforeach
							</SELECT>
						</TD>
						<TD nowrap>
							{{ html()->text("address1List[$arg]", $list->delivery_add1)->attribute('size', '40') }}
						</TD>
						<TD nowrap colspan=2>
							{{ html()->text("address2List[$arg]", $list->delivery_add2)->attribute('size', '40') }}
						</TD>
						<TD nowrap colspan=2>
							{{ html()->text("address3List[$arg]", $list->delivery_add3)->attribute('size', '40') }}
						</TD>
					</TR>
					</tbody>
				@endforeach
@endif
	<TR>
		<TD nowrap colspan=7 align="center">
			@if (session('status') === 'success-store')
				<p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm text-blue-400 dark:text-blue-400" style="color: blue;">更新が完了しました。</p>
			@endif
			{{ html()->submit('更新') }}
		</TD>
	</TR>
			</TABLE>
		</td>
	</TR>

	<tr>
		<td align="right">
			<table cellspacing="0" cellpadding="2" style="width:100%;">
		      <tr>
		      	<td></td>
				<th nowrap align="right">
					<TH nowrap bgcolor="#8080c0" width="20"><FONT color="White">総件数 {{ number_format($dataList->total()) }}</FONT></TH>
				</th>
		      </tr>
		      </tr>
		      <tr>
		        <td align="center" colspan="2" align="center">
				@if(isset($dataList[0]))
					<div class="pager">
						{{ $dataList->appends(request()->query())->links('vendor.pagination.admin') }}
					</div>
				@endif
		       	</td>
		      </tr>
		    </table>
		</td>
	</tr>

	{{ html()->form()->close() }}

	
</TABLE>

{{--------------------------------------------------------------------}}

</x-admin-layout>
