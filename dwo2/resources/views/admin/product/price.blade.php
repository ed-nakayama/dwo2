<x-admin-layout>

<head>
	<title>PAP用仕切り価格設定</title>
</head>

{{--------------------------------------------------------------------}}

<table>
	<tr>
		<th>商品コード：</th>
		<td>{{ $prodCode }}</td>
	</tr>
	<tr>
		<th>商品名　　：</th>
		<td>{{ $prodName }}</td>
	</tr>
</table>

<br/>

@foreach ($errors->all() as $error)
	<li style="list-style:none; color:red;">{{ $error }}</li>
@endforeach

{{ html()->form('POST', '/admin/product/price/regist')->attribute('name', 'list')->open() }}
{{ html()->hidden('prodCode', $prodCode) }}
{{ html()->hidden('prodName', $prodName) }}

<table border="1">
	<tr bgcolor="#8080c0" nowrap>
		<th nowrap><font size=2 color="#ffffff">保守コード</font></th>
		<th nowrap><font size=2 color="#ffffff">保守短縮名</font></th>
		<th nowrap><font size=2 color="#ffffff">保守年数</font></th>
		<th nowrap><font size=2 color="#ffffff">仕切区分</font></th>
		<th nowrap><font size=2 color="#ffffff">参考価格</font></th>
		<th nowrap><font size=2 color="#ffffff">商品価格</font></th>
		<th nowrap><font size=2 color="#ffffff">保守価格</font></th>
		<th nowrap><font size=2 color="#ffffff">顧客分類2(1)</font></th>
		<th nowrap><font size=2 color="#ffffff">顧客分類2(2)</font></th>
		<th nowrap><font size=2 color="#ffffff">顧客分類2(3)</font></th>
		<th nowrap><font size=2 color="#ffffff">顧客分類2(4)</font></th>
		<th nowrap><font size=2 color="#ffffff">顧客分類2(5)</font></th>
		<th nowrap><font size=2 color="#ffffff">顧客分類2(6)</font></th>
		<th nowrap><font size=2 color="#ffffff">顧客分類2(7)</font></th>
		<th nowrap><font size=2 color="#ffffff">顧客分類2(8)</font></th>
	</tr>
	<tr bgcolor="White">
		<td><INPUT type="text" size=10 name="supCode" value="{{ old('supCode') }}"></td>
		<td><INPUT type="text" size=20 name="supShortName" value="{{ old('supShortName') }}"></td>
		<td><INPUT type="text" size=10 name="supLicenseNum" value="{{ old('supLicenseNum') }}"></td>
		<td>
			<select name="priceClass">
			<option value=""></option>
			@foreach ($priceClassView as $pr)
				<option value="{{ $pr->class_large . '-' . $pr->class_medium . '-' . $pr->class_small }}" @if ( ($pr->class_large . '-' . $pr->class_medium . '-' . $pr->class_small) == old('priceClass') ) selected @endif>{{ $pr->class_name }}</option>
			@endforeach
			</select>
		</td>
		<td style="background-color:#fffacd;"><input type="text" size=10 name="samplePrice" value="" style="background-color:#fffacd; text-align:right;"></td>
		<td><INPUT type="text" size=10 name="prodPrice" value="{{ old('prodPrice') }}"></td>
		<td><INPUT type="text" size=10 name="supPrice" value="{{ old('supPrice') }}"></td>
		<td>
			<select name="agentLevel1">
			<option value=""></option>
			@foreach ($agentLevel as $opt)
				<option value="{{ $opt->agent_level_code }}" @if ($opt->agent_level_code == old('agentLevel1')) selected @endif>{{ $opt->agent_level_name }}</option>
			@endforeach
			</select>
		</td>
		<td>
			<select name="agentLevel2">
			<option value=""></option>
			@foreach ($agentLevel as $opt)
				<option value="{{ $opt->agent_level_code }}" @if ($opt->agent_level_code == old('agentLevel2')) selected @endif>{{ $opt->agent_level_name }}</option>
			@endforeach
			</select>
		</td>
		<td>
			<select name="agentLevel3">
			<option value=""></option>
			@foreach ($agentLevel as $opt)
				<option value="{{ $opt->agent_level_code }}" @if ($opt->agent_level_code == old('agentLevel3')) selected @endif>{{ $opt->agent_level_name }}</option>
			@endforeach
			</select>
		</td>
		<td>
			<select name="agentLevel4">
			<option value=""></option>
			@foreach ($agentLevel as $opt)
				<option value="{{ $opt->agent_level_code }}" @if ($opt->agent_level_code == old('agentLevel4')) selected @endif>{{ $opt->agent_level_name }}</option>
			@endforeach
			</select>
		</td>
		<td>
			<select name="agentLevel5">
			<option value=""></option>
			@foreach ($agentLevel as $opt)
				<option value="{{ $opt->agent_level_code }}" @if ($opt->agent_level_code == old('agentLevel5')) selected @endif>{{ $opt->agent_level_name }}</option>
			@endforeach
			</select>
		</td>
		<td>
			<select name="agentLevel6">
			<option value=""></option>
			@foreach ($agentLevel as $opt)
				<option value="{{ $opt->agent_level_code }}" @if ($opt->agent_level_code == old('agentLevel6')) selected @endif>{{ $opt->agent_level_name }}</option>
			@endforeach
			</select>
		</td>
		<td>
			<select name="agentLevel7">
			<option value=""></option>
			@foreach ($agentLevel as $opt)
				<option value="{{ $opt->agent_level_code }}" @if ($opt->agent_level_code == old('agentLevel7')) selected @endif>{{ $opt->agent_level_name }}</option>
			@endforeach
			</select>
		</td>
		<td>
			<select name="agentLevel8">
			<option value=""></option>
			@foreach ($agentLevel as $opt)
				<option value="{{ $opt->agent_level_code }}" @if ($opt->agent_level_code == old('agentLevel8')) selected @endif>{{ $opt->agent_level_name }}</option>
			@endforeach
			</select>
		</td>
    </tr>
    <tr>
        <td align="center" colspan="21">
			@if (session('status') === 'success-regist')
				<p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm text-blue-400 dark:text-blue-400" style="color: blue;">新規登録が完了しました。</p>
			@endif

			{{ html()->submit('新規登録')->attribute('name', 'reg') }}
        </td>
    </tr>
</table>
{{ html()->form()->close() }}

{{ html()->form('POST', '/admin/product/price/store')->attribute('name', 'list')->open() }}
{{ html()->hidden('prodCode', $prodCode) }}
{{ html()->hidden('prodName', $prodName) }}
    <TABLE cellspacing="0" cellpadding="2">
      <TR>
        <TH nowrap bgcolor="#8080c0"><FONT color="White">件数　{{ $total }}</FONT></TH>
        <TH nowrap></TH>
        <TH nowrap></TH>
    </TABLE>
<table border="1">
	<tr bgcolor="#8080c0">
		<th nowrap><font size=2 color="#ffffff">No.</font></th>
		<th nowrap><font size=2 color="#ffffff">保守コード</font></th>
		<th nowrap><font size=2 color="#ffffff">保守短縮名</font></th>
		<th nowrap><font size=2 color="#ffffff">保守年数</font></th>
		<th nowrap><font size=2 color="#ffffff">仕切区分</font></th>
		<th nowrap><font size=2 color="#ffffff">参考価格</font></th>
		<th nowrap><font size=2 color="#ffffff">商品価格</font></th>
		<th nowrap><font size=2 color="#ffffff">保守価格</font></th>
		<th nowrap><font size=2 color="#ffffff">顧客分類2(1)</font></th>
		<th nowrap><font size=2 color="#ffffff">顧客分類2(2)</font></th>
		<th nowrap><font size=2 color="#ffffff">顧客分類2(3)</font></th>
		<th nowrap><font size=2 color="#ffffff">顧客分類2(4)</font></th>
		<th nowrap><font size=2 color="#ffffff">顧客分類2(5)</font></th>
		<th nowrap><font size=2 color="#ffffff">顧客分類2(6)</font></th>
		<th nowrap><font size=2 color="#ffffff">顧客分類2(7)</font></th>
		<th nowrap><font size=2 color="#ffffff">顧客分類2(8)</font></th>
		<th nowrap><font size=2 color="#ffffff">更新日</font></th>
		<th nowrap><font size=2 color="#ffffff">削除</font></th>
	</tr>
@if (isset($priceList))
	@foreach ($priceList as $list)
	<tr bgcolor="White">
		<td>{{ $list->price_seq }}</td>
        <input type="hidden" name="seqList[]" value="{{ $list->price_seq }}">
		<td><INPUT type="text" size=10 name="supCodeList[]" value="{{ $list->price_product_sup_code }}"></td>
		<td><INPUT type="text" size=20 name="supShortNameList[{$list->price_seq}]" value="{{ $list->price_product_sup_short }}"></td>
		<td><INPUT type="text" size=10 name="supLicenseNumList[{$list->price_seq}]" value="{{ $list->price_product_sup_license_n }}"></td>
		<td>
			<select name="priceClassList[{$list->price_seq}]">
			<option value=""></option>
			@foreach ($priceClassView as $pr)
				<option value="{{ $pr->class_large . '-' . $pr->class_medium . '-' . $pr->class_small }}" @if ( ($pr->class_large . '-' . $pr->class_medium . '-' . $pr->class_small) == ($list->price_class_large . '-' . $list->price_class_medium . '-' . $list->price_class_small) ) selected @endif>{{ $pr->class_name }}</option>
			@endforeach
			</select>
		</td>
		<td style="background-color:#fffacd;"><input type="text" size=10 name="samplePriceList[{$list->price_seq}]" value="{{ $list->sample_price }}" style="background-color:#fffacd; text-align:right;"></td>
		<td><INPUT type="text" size=10 name="prodPriceList[{$list->price_seq}]" value="{{ $list->price_invoice_price }}"></td>
		<td><INPUT type="text" size=10 name="supPriceList[{$list->price_seq}]" value="{{ $list->price_invoice_price_sup }}"></td>
		<td>
			<select name="agentLevel1List[{$list->price_seq}]">
			<option value=""></option>
			@foreach ($agentLevel as $opt)
				<option value="{{ $opt->agent_level_code }}" @if ($opt->agent_level_code == $list->price_agent_level_1) selected @endif>{{ $opt->agent_level_name }}</option>
			@endforeach
			</select>
		</td>

		<td>
			<select name="agentLevel2List[{$list->price_seq}]">
			<option value=""></option>
			@foreach ($agentLevel as $opt)
				<option value="{{ $opt->agent_level_code }}" @if ($opt->agent_level_code == $list->price_agent_level_2) selected @endif>{{ $opt->agent_level_name }}</option>
			@endforeach
			</select>
		</td>
		<td>
			<select name="agentLevel3List[{$list->price_seq}]">
			<option value=""></option>
			@foreach ($agentLevel as $opt)
				<option value="{{ $opt->agent_level_code }}" @if ($opt->agent_level_code == $list->price_agent_level_3) selected @endif>{{ $opt->agent_level_name }}</option>
			@endforeach
			</select>
		</td>
		<td>
			<select name="agentLevel4List[{$list->price_seq}]">
			<option value=""></option>
			@foreach ($agentLevel as $opt)
				<option value="{{ $opt->agent_level_code }}" @if ($opt->agent_level_code == $list->price_agent_level_4) selected @endif>{{ $opt->agent_level_name }}</option>
			@endforeach
			</select>
		</td>
		<td>
			<select name="agentLevel5List[{$list->price_seq}]">
			<option value=""></option>
			@foreach ($agentLevel as $opt)
				<option value="{{ $opt->agent_level_code }}" @if ($opt->agent_level_code == $list->price_agent_level_5) selected @endif>{{ $opt->agent_level_name }}</option>
			@endforeach
			</select>
		</td>
		<td>
			<select name="agentLevel6List[{$list->price_seq}]">
			<option value=""></option>
			@foreach ($agentLevel as $opt)
				<option value="{{ $opt->agent_level_code }}" @if ($opt->agent_level_code == $list->price_agent_level_6) selected @endif>{{ $opt->agent_level_name }}</option>
			@endforeach
			</select>
		</td>
		<td>
			<select name="agentLevel7List[{$list->price_seq}]">
			<option value=""></option>
			@foreach ($agentLevel as $opt)
				<option value="{{ $opt->agent_level_code }}" @if ($opt->agent_level_code == $list->price_agent_level_7) selected @endif>{{ $opt->agent_level_name }}</option>
			@endforeach
			</select>
		</td>
		<td>
			<select name="agentLevel8List[{$list->price_seq}]">
			<option value=""></option>
			@foreach ($agentLevel as $opt)
				<option value="{{ $opt->agent_level_code }}" @if ($opt->agent_level_code == $list->price_agent_level_8) selected @endif>{{ $opt->agent_level_name }}</option>
			@endforeach
			</select>
		</td>
		<td>{{ substr($list->price_update,0,4) . '/' . substr($list->price_update,5,2) . '/' . substr($list->price_update,8,2) }}</td>
        <td><INPUT type="checkbox" name="delList[{$list->price_seq}]" value="{{ $list->price_seq }}" @if ($list->price_del == 1) CHECKED @endif></td>
    </tr>
	@endforeach
    <tr>
        <td align="center" colspan="24">
			@if (session('status') === 'success-store')
				<p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm text-blue-400 dark:text-blue-400" style="color: blue;">更新が完了しました。</p>
			@endif

			{{ html()->submit('更新')->attribute('name', 'update') }}
        </td>
    </tr>
@endif
</table>
{{ html()->form()->close() }}


{{--------------------------------------------------------------------}}

</x-admin-layout>
