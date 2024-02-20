<x-admin-layout>

<head>
	<title>商品分類 登録マスタ　詳細</title>
</head>


{{--------------------------------------------------------------------}}
<DIV align="left">
<TABLE width="600" border="0" cellspacing="0" cellpadding="2">
  <TR>
    <TD nowrap align="center">
    <TABLE width="300">
      <TR>
        <TD nowrap align="center" bgcolor="#0000a0"><FONT color="white"><FONT color="White">商品分類 登録マスタ　詳細</FONT></FONT></TD></TR>
    </TABLE>
<BR>

		{{-- 新規登録エリア --}}
		@foreach ($errors->all() as $error)
			<li style="list-style:none; color:red;">{{ $error }}</li>
		@endforeach

		{{ html()->form('POST', '/admin/product/category/regist')->open() }}
		{{ html()->hidden('prodCode', $prodCode) }}
    <TABLE width="400" border="1" cellspacing="0" cellpadding="2">
			<TR>
				<TH nowrap align="left" bgcolor="#8080c0"><FONT color="white">商品コード</FONT></TH>
				<TD>{{ $prod->item_cd }}</TD>
			</TR>
			<TR>
				<TH nowrap align="left" bgcolor="#8080c0"><FONT color="white">商品名称</FONT></TH>
				<TD>{{ $prod->item_name_kanji }}</TD>
			</TR>
			<TR>
				<TH nowrap align="left" bgcolor="#8080c0"><FONT color="white">商品大分類</FONT></TH>
				<TD nowrap>
					<SELECT name="bigCode">
						@foreach ($bigCategory as $list)
							{{ html()->option($list->big_category_name, $list->big_category_code) }}
						@endforeach
					</SELECT>
				</TD>
			</TR>
			<TR>
				<TH nowrap align="left" bgcolor="#8080c0">
					<FONT color="white">商品中分類</FONT>
				</TH>
				<TD>
					<SELECT name="midCode">
						@foreach ($middleCategory as $list)
							{{ html()->option($list->middle_category_name, $list->middle_category_code) }}
						@endforeach
					</SELECT>
				</TD>
			</TR>
			<TR>
				<TD align="center" colspan="2">
					@if (session('status') === 'success-regist')
						<p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm text-blue-400 dark:text-blue-400" style="color: blue;">新規登録が完了しました。</p>
					@endif

					{{ html()->submit('新規登録') }}
				</TD>
			</TR>
		</TABLE>
		{{ html()->form()->close() }}
		<BR>

		{{-- 一覧更新エリア --}}
		<BR>
    <DIV align="left">
    <TABLE cellspacing="0" cellpadding="2">
      <TR>
        <TH nowrap bgcolor="#8080c0"><FONT color="White">件数　{{ $dataList->count() }}</FONT></TH>
        <TH nowrap></TH>
        <TH nowrap></TH>
    </TABLE>


		{{ html()->form('POST', '/admin/product/category/store')->open() }}
		{{ html()->hidden('prodCode', $prodCode) }}
		<TABLE class="tbl-normal" border="1" cellspacing="0" cellpadding="2">
			<TR>
				<TH nowrap bgcolor="#8080c0"><FONT color="White">商品大分類</FONT></TH>
				<TH nowrap bgcolor="#8080c0"><FONT color="White">商品中分類</FONT></TH>
				<TH nowrap bgcolor="#8080c0"><FONT color="White">更新者 ID</FONT></TH>
				<TH nowrap bgcolor="#8080c0"><FONT color="White">更新日</FONT></TH>
				<TH nowrap bgcolor="#8080c0"><FONT color="White">削除</FONT></TH>
			</TR>

@if (!empty($dataList[0]))
			@foreach ($dataList as $list)
				<TR>
					<INPUT type="hidden" name="codeList[]" value="{{ $list->product_category_no }}">
					<TD nowrap align="center">
						<SELECT name="bigCodeList[{{$list->product_category_no}}]">
							@foreach ($bigCategory as $big)
								{{ html()->option($big->big_category_name, $big->big_category_code, ($big->big_category_code == $list->product_category_big_code)) }}
							@endforeach
						</SELECT>
					</TD>
					<TD nowrap align="center">
						<SELECT name="midCodeList[{{$list->product_category_no}}]">
							@foreach ($middleCategory as $mid)
								{{ html()->option($mid->middle_category_name, $mid->middle_category_code, ($mid->middle_category_code == $list->product_category_middle_code)) }}
							@endforeach
						</SELECT>
					</TD>
					<TD nowrap>
						{{ $list->product_category_modified_id }}
					</TD>
					<TD align="center">
						{{ substr(str_replace("-", "/", $list->product_category_update), 0, 10) }}
					</TD>
					<TD nowrap align="center">
						{{ html()->checkbox("delList[{$list->product_category_no}]", $list->product_category_del, $list->product_category_no) }}
					</TD>
				</TR>
			@endforeach
			<TR>
				<TD nowrap colspan=5 align="center">
					@if (session('status') === 'success-store')
						<p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm text-blue-400 dark:text-blue-400" style="color: blue;">更新が完了しました。</p>
					@endif

					{{ html()->submit('更新') }}
				</TD>
			</TR>
@endif
		</TABLE>
		{{ html()->form()->close() }}
	</TD>
</TR>
</TABLE>
</DIV>

{{--------------------------------------------------------------------}}

</x-admin-layout>
