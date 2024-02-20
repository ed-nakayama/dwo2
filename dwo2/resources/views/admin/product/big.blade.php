<x-admin-layout>

<head>
	<title>商品大分類マスタ</title>
</head>

{{--------------------------------------------------------------------}}


<TABLE width="500" border="0" cellspacing="5" cellpadding="0">
  <TR>
    <TD nowrap align="left" valign="top">

    <CENTER>
    <TABLE width="300">
    <TR>
    <TD nowrap align="center" bgcolor="#0000a0"><FONT color="White">商品大分類　マスタ</FONT></TD></TR>
    </TABLE>
    </CENTER>
    <BR>


	{{-- 新規登録エリア --}}
	@error('new_code')
		<li style="list-style:none; color:red;">{{ $message }}</li>
	@enderror
	@error('new_name')
		<li style="list-style:none; color:red;">{{ $message }}</li>
	@enderror

	{{ html()->form('POST', '/admin/product/big/regist')->open() }}

    <TABLE width="300" border="1" cellspacing="0" cellpadding="2">
      <TR bgcolor="#0099d2">
        <TH nowrap><FONT color="White">コード</FONT></TH>
        <TH nowrap><FONT color="White">名称</FONT></TH>
        <TH nowrap><FONT color="White">旧商品フラグ</FONT></TH>
      </TR>
      <TR>
        <TD>
			{{ html()->text('new_code', '')->attributes(['size' => '10' , 'maxlength' => '3']) }}
        </TD>
        <TD nowrap>
			{{ html()->text('new_name', '')->attributes(['size' => '50' , 'maxlength' => '40']) }}
        </TD>
        <TD nowrap align="center">
			{{ html()->checkbox('new_old_prod', '' ,'1') }}
        </TD>
      </TR>
      <tr>
        <TD nowrap colspan="3" align="center">
			@if (session('status') === 'success-regist')
				<p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm text-blue-400 dark:text-blue-400" style="color: blue;">新規登録が完了しました。</p>
			@endif
			{{ html()->submit('新規登録') }}
        </TD>
      </tr>
    </TABLE>
    <br />
	{{ html()->form()->close() }}

    
	{{-- 検索エリア --}}
	{{ html()->form('GET', '/admin/product/big/search')->open() }}
	<table border="1" cellspacing="0" cellpadding="2">
		<tr bgcolor="#0099d2">
			<th nowrap>
				<font color="White">削除</font>
			</th>
		</tr>
		<tr>
			<td nowrap align="center">
				<select name="search_del">
					{{ html()->option('削除なし', '1' ,($search_del == '1')) }}
					{{ html()->option('削除あり', '2' ,($search_del == '2')) }}
					{{ html()->option('全て'    , '3' ,($search_del == '3')) }}
				</select>
			</td>
		</tr>
		<tr>
			<td nowrap rowspan="2" align="center">
				{{ html()->submit('検索') }}
			</td>
		</tr>
      </table>    
    <BR>
	{{ html()->form()->close() }}

	{{-- 一覧更新エリア --}}
	@error('nameList.*')
		<li style="list-style:none; color:red;">{{ $message }}</li>
	@enderror


	{{ html()->form('POST', '/admin/product/big/store')->open() }}
	{{ html()->hidden('search_del', $search_del) }}
@if(isset($bigList[0]))
    <TABLE cellspacing="0" cellpadding="2">
      <TR>
        <TH nowrap bgcolor="#8080c0"><FONT color="White">件数 {{ $bigList->count() }}</FONT></TH>
        <TH nowrap></TH>
        <TH nowrap></TH>
      </TR>
    </TABLE>
@endif

    <TABLE width="600" border="1" cellspacing="0" cellpadding="2">
      <TR bgcolor="#8080c0">
        <TH nowrap><FONT color="White">コード</FONT></TH>
        <TH nowrap><FONT color="White">名称</FONT></TH>
        <TH nowrap><FONT color="White">旧商品フラグ</FONT></TH>
        <TH nowrap><FONT color="White">更新者ID</FONT></TH>
        <TH nowrap><FONT color="White">更新日</FONT></TH>
        <TH nowrap><FONT color="White">削除</FONT></TH>
      </TR>
	@foreach ($bigList as $list)
      <TR>
        <TD nowrap align="right">
			{{ $list->big_category_code }}
			{{ html()->hidden('codeList[]', $list->big_category_code) }}
        </TD>
        <TD nowrap>
			{{ html()->text("nameList[{$list->big_category_code}]", $list->big_category_name)->attributes(['maxlength' => '40' ,'size' => '50']) }}
        </TD>
        <TD nowrap align="center">
			{{ html()->checkbox("oldProdList[{$list->big_category_code}]", $list->big_category_old_product , $list->big_category_code) }}
        </TD>
        <TD nowrap>{{ $list->big_category_modified_id }}</TD>
        <TD nowrap>{{ substr(str_replace("-", "/", $list->big_category_update), 0, 10) }}</TD>
        <TD nowrap align="center">
			{{ html()->checkbox("delList[{$list->big_category_code}]",$list->big_category_del, $list->big_category_code) }}
        </TD>
      </TR>
      
	@endforeach
      <TR>
        <TD nowrap colspan=6 align="center">
			@if (session('status') === 'success-store')
				<p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm text-blue-400 dark:text-blue-400" style="color: blue;">更新が完了しました。</p>
			@endif

			{{ html()->submit('更新') }}
        </TD>
      </TR>
   </TABLE>
	{{ html()->form()->close() }}
</TD></TR></TABLE>

{{--------------------------------------------------------------------}}

</x-admin-layout>
