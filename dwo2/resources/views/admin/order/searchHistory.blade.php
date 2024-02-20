<x-admin-layout>

<head>
	<title>受注履歴照会</title>
</head>


{{--------------------------------------------------------------------}}


<table width="500" border="0" cellspacing="5" cellpadding="0">

	<tr>
		<td nowrap align="center" valign="top">
			<table width="300">
				<tr>
					<td nowrap align="center" bgcolor="#0000a0">
						<font color="White">受注履歴照会</font>
					</td>
				</tr>
			</table>
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

			{{ html()->form('POST', '/admin/order/search/history/search')->open() }}

				<table cellspacing="0" cellpadding="2">

					<tr>
						<td nowrap bgcolor="#8080ff">
							<font color="White"> 検 索 条 件 </font>
						</td>
					</tr>
				</table>

				<table width="300" border="1" cellspacing="0" cellpadding="2">

					<tr>
						<td nowrap bgcolor="#8080ff">
							<font color="white">受付No.</font>
						</td>
						<td nowrap width="100px">
							{{ html()->text('orderNum', $param['orderNum'] )->attribute('size', '12') }}
						</td>
						<td nowrap align="center" bgcolor="#8080ff">
							<font color="white">受付日(YYYYMMDD)</font>
						</td>
						<td nowrap align="left">
							{{ html()->text('orderStartDate', $param['orderStartDate'])->attribute('size', '12') }}～{{ html()->text('orderEndDate', $param['orderEndDate'])->attribute('size', '12') }}
						</td>
						<td bgcolor="#8080ff">
							<font color="White">ステータス</font>
						</td>
						<td>
							<select name="statusId[]" multiple size="5">
							@foreach ($orderStatus as $list)
								@if (isset($param['statusId']))
									{{ html()->option($list->order_status_name, $list->order_status_id, in_array($list->order_status_id, $param['statusId']) ) }}
								@else
									{{ html()->option($list->order_status_name, $list->order_status_id) }}
								@endif
							@endforeach
							</select>
						</td>
					</tr>

					<tr>
						<td nowrap bgcolor="#8080ff">
							<font color="White">顧客番号</font>
						</td>
						<td nowrap>
							{{ html()->text('custNum', $param['custNum'] )->attribute('size', '15') }}
						</td>
						<td nowrap bgcolor="#8080ff">
							<font color="White">顧客名</font>
						</td>
						<td nowrap colspan="3">
							{{ html()->text('custName', $param['custName'])->attribute('size', '80') }}
						</td>
					</tr>

					<tr>
						<td nowrap bgcolor="#8080ff">
							<font color="White">商品コード</font>
						</td>
						<td nowrap>
							{{ html()->text('itemCode', $param['itemCode'])->attribute('size', '15') }}
						</td>
						<td nowrap bgcolor="#8080ff">
							<font color="White">発注番号</font>
						</td>
						<td nowrap>
							{{ html()->text('custOrderNum', $param['custOrderNum'])->attribute('size', '15') }}
						</td>
						<td nowrap bgcolor="#8080ff">
							<font color="White">取引先形態</font>
						</td>
						<td nowrap>
							<select name="custClass">
								{{ html()->option('PAP'      , '1' , ($param['custClass'] == '1')) }}
								{{ html()->option('YBP'      , '2' , ($param['custClass'] == '2')) }}
								{{ html()->option('全て'     , '3' , ($param['custClass'] == '3' || empty($param['custClass']))) }}
							</select>
						</td>
					</tr>

					<tr>
						<td nowrap align="center" bgcolor="#8080ff">
							<font color="white">ユーザ削除</font>
						</td>
						<td nowrap align="center">
							<select name="custDel">
								{{ html()->option('削除なし', '1' ,($param['custDel'] == '1' || empty($param['custDel']))) }}
								{{ html()->option('削除あり', '2' ,($param['custDel'] == '2')) }}
								{{ html()->option('全て'    , '3' ,($param['custDel'] == '3')) }}
							</select>
						</td>
						<td nowrap align="center" bgcolor="#8080ff">
							<font color="white">オペレータ削除</font>
						</td>
						<td nowrap align="center" colspan="3">
							<select name="operatorDel">
								{{ html()->option('削除なし', '1' ,($param['operatorDel'] == '1' || empty($param['operatorDel']))) }}
								{{ html()->option('削除あり', '2' ,($param['operatorDel'] == '2')) }}
								{{ html()->option('全て'    , '3' ,($param['operatorDel'] == '3')) }}
							</select>
						</td>

					</tr>

					<tr>
						<td colspan="6" align="center">
							{{ html()->submit('検索') }}
						</td>
					</tr>

				</table>
			{{ html()->form()->close() }}

		</td>
	</tr>

	<br />

	<tr>
		<td>
		
			<table cellspacing="0" cellpadding="2">
				<tr>
					<td nowrap bgcolor="#8080c0">
						<font color="White">検 索 結 果</font>
					</td>
					<td nowrap></td>
					<td nowrap bgcolor="#8080c0">
						<font color="White">該当数 {{ number_format($dataCount) }}</font>
					</td>
					<td nowrap></td>
					<td nowrap bgcolor="#8080c0">
						<font color="White">数量合計 {{ number_format($totalItemQuantity) }}</font>
					</td>
				</tr>
			</table>

			<table width="600" border="1" cellspacing="0" cellpadding="2">

				<tr bgcolor="#8080c0">
					<td nowrap align="center" width="8%">
						<font color="White">受付No.</font>
					</td>
					<td nowrap align="center" width="8%">
						<font color="White">受付日</font>
					</td>
					<td nowrap align="center" width="10%">
						<font color="White">ステータス</font>
					</td>
					<td nowrap align="center" width="22%">
						<font color="White">顧客番号</font>
					</td>
					<td nowrap align="center" width="22%">
						<font color="White">顧客名</font>
					</td>
					<td nowrap align="center" width="22%">
						<font color="White">商品コード</font>
					</td>
					<td nowrap align="center" width="12%">
						<font color="White">数量</font>
					</td>
					<td nowrap align="center" width="22%">
						<font color="White">発注番号</font>
					</td>
					<td nowrap align="center" width="12%">
						<font color="White">取引先形態</font>
					</td>
					<td nowrap align="center" width="12%">
						<font color="White">詳細</font>
					</td>
					<td nowrap align="center" width="5%">
						<font color="White">ユーザ削除</font>
					</td>
					<td nowrap align="center" width="5%">
						<font color="White">オペレータ削除</font>
					</td>
					<td nowrap align="center" width="5%">
						<font color="White">バッチ更新日</font>
					</td>
				</tr>

				@foreach ($dataList as $list)

					<tr>
						<td nowrap align="right">{{ $list->web_order_num }}&nbsp;</td>
						<td nowrap align="left">{{ str_replace('-','/' ,substr($list->order_date,0,10)) }}&nbsp;</td>
						<td nowrap align="center">
							@foreach ($orderStatus as $stat)
								@if ($list->state_type == $stat->order_status_id)
									{{ $stat->order_status_name }}
								@endif
							@endforeach
						</td>
						<td nowrap align="left">{{ $list->cust_num }}&nbsp;</td>
						<td nowrap align="left">{{ $list->name1 . $list->name2 }}&nbsp;</td>
						<td nowrap align="left">{{ $list->item_cd }}&nbsp;</td>
						<td nowrap align="right">{{ $list->item_vol }}&nbsp;</td>
						<td nowrap align="right">{{ $list->cust_order_num }}&nbsp;</td>
						<td nowrap align="center">@if ($list->cust_class_medium == '01')PAP @elseif ($list->cust_class_medium == '02')YBP @endif&nbsp;</td>
						<td nowrap align="center"><a href="/admin/order/list/detail?orderNum={{ $list->web_order_num }}">詳細</a>&nbsp;</td>

						<td nowrap align="center">@if ($list->cust_del_type)削除@endif &nbsp;</td>
						<td nowrap align="center">@if ($list->operator_del_type)削除@endif &nbsp;</td>
						<td nowrap align="center">{{ str_replace('-','/' ,$list->batch_update) }}&nbsp;</td>
					</tr>

				@endforeach

			</table>

			<table cellspacing="0" cellpadding="2">
				<tr>
					<td nowrap bgcolor="#8080c0">
						<font color="White">検 索 結 果</font>
					</td>
					<td nowrap></td>
					<td nowrap bgcolor="#8080c0">
						<font color="White">該当数 {{ number_format($dataCount) }}</font>
					</td>
					<td nowrap></td>
					<td nowrap bgcolor="#8080c0">
						<font color="White">数量合計 {{ number_format($totalItemQuantity) }}</font>
					</td>
				</tr>
			</table>

			<table align="center" border="0">
				<tr>
					<td>
						<div class="pager">
							{{ $dataList->links('vendor.pagination.admin') }}
						</div>
					</td>
				</tr>
			</table>

		</td>
	</tr>

</table>

{{--------------------------------------------------------------------}}

</x-admin-layout>
