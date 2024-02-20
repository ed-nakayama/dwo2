<x-admin-layout>

<head>
	<title>商品中分類マスタ</title>
</head>


{{--------------------------------------------------------------------}}

<TABLE width="500" border="0" cellspacing="5" cellpadding="0">
<TR>
	<TD nowrap align="left" valign="top">
    <CENTER>
	    <TABLE width="300">
	      <TR>
	        <TD nowrap align="center" bgcolor="#0000a0"><FONT color="White">商品中分類　マスタ</FONT></TD></TR>
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

		{{ html()->form('POST', '/admin/product/middle/regist')->open() }}
		{{ html()->hidden('search_code', $search_code) }}
		{{ html()->hidden('search_big_code', $search_big_code) }}
		{{ html()->hidden('search_name', $search_name) }}
		{{ html()->hidden('search_prodLink', $search_prodLink) }}
		{{ html()->hidden('search_supLink', $search_supLink) }}
		{{ html()->hidden('search_del', $search_del) }}

	    <TABLE width="400" border="1" cellspacing="0" cellpadding="2">
	    	<TR bgcolor="#0099d2">
	    		<TH nowrap><FONT color="White">コード</FONT></TH>
	    		<TH nowrap><FONT color="White">商品大分類</FONT></TH>
	    		<TH nowrap><FONT color="white">名称</FONT></TH>
	    		<TH nowrap><FONT color="white">商品<br>LINK不可</FONT></TH>
	    		<TH nowrap><FONT color="white">サプライ<br>LINK不可</FONT></TH>
	    	</TR>
	    	<TR>
	    		<TD nowrap>
					{{ html()->text('new_code', '')->attributes(['size' => '10' , 'maxlength' => '3']) }}
	    		</TD>
	    		<TD nowrap width="200px">
	    			<SELECT name="new_big_code">
	    				@foreach ($bigCategory as $list)
							{{ html()->option($list->big_category_name, $list->big_category_code) }}
	    				@endforeach
					</SELECT>
				</TD>
				<TD nowrap>
					{{ html()->text('new_name')->attributes(['size' => '30', 'maxlength' => '40']) }}
				</TD>
				<TD nowrap align="center">
					{{ html()->checkbox('new_prodLink', '', '1') }}
				</TD>
				<TD nowrap align="center">
					{{ html()->checkbox('new_supLink', '', '1') }}
				</TD>
			</TR>
			
			<tr>
				<TD align="center" nowrap colspan=5>
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
		{{ html()->form('POST', '/admin/product/middle/search')->open() }}
		<table width="400" border="1" cellspacing="0" cellpadding="2">
	    
	    	<tr bgcolor="#0099d2">
	    		<th nowrap><font color="White">コード</font></th>
	    		<th nowrap><font color="White">商品大分類</font></th>
	    		<th nowrap><font color="white">名称</FONT></font>
	    		<th nowrap><font color="white">商品<br>LINK不可</font></th>
	    		<th nowrap><font color="white">サプライ<br>LINK不可</font></th>
	    		<th nowrap><font color="white">削除</font></th>
	    	</tr>
	    	
	    	<tr>
	    		<td nowrap>
					{{ html()->text('search_code', $search_code)->attributes(['size' => '10' , 'maxlength' => '3']) }}
	    		</td>
	    		<td nowrap width="200px">
	    			<select name="search_big_code">
	    				<OPTION value=""></option>
	    				@foreach ($bigCategoryAll as $list)
	    					<option value="{{ $list->big_category_code }}" @if ($list->big_category_code == $search_big_code) selected @endif @if ($list->big_category_del == '1') style="color:red" @endif>
	    						{{ $list->big_category_code }}：{{ $list->big_category_name }} @if ($list->big_category_del == '1') &nbsp;[削除] @endif
	    					</option>
	    				@endforeach
					</select>
				</td>
				<td nowrap>
					{{ html()->text('search_name', $search_name)->attributes(['size' => '30' , 'maxlength' => '40']) }}
				</td>
				<td nowrap align="center">
					{{ html()->checkbox('search_prodLink', $search_prodLink, '1') }}
				</td>
				<td nowrap align="center">
					{{ html()->checkbox('search_supLink', $search_supLink, '1') }}
				</td>
				<td nowrap align="center" width="100px">
					<select name="search_del">
						{{ html()->option('削除なし', '1' ,($search_del == '1')) }}
						{{ html()->option('削除あり', '2' ,($search_del == '2')) }}
						{{ html()->option('全て'    , '3' ,($search_del == '3')) }}
					</select>
				</td>
			</tr>
			
			<tr>
				<td nowrap align="center" colspan="6">
					{{ html()->submit('検索') }}
				</td>
			</tr>
			
		</TABLE>
		<BR>
		{{ html()->form()->close() }}
	
		@error('codeList.*')
			<li style="list-style:none; color:red;">{{ $message }}</li>
		@enderror
		@error('bigCodeList.*')
			<li style="list-style:none; color:red;">{{ $message }}</li>
		@enderror
		@error('nameList.*')
			<li style="list-style:none; color:red;">{{ $message }}</li>
		@enderror

		{{-- 一覧更新エリア --}}
		@if(isset($middleList[0]))
	    <TABLE cellspacing="0" cellpadding="2">
	      <TR>
	        <TH nowrap bgcolor="#8080c0"><FONT color="White">件数　{{ $middleList->count() }}</FONT></TH>
	        <TH nowrap></TH>
	        <TH nowrap></TH>
	      </TR>
	    </TABLE>
		@endif

		{{ html()->form('POST', '/admin/product/middle/store')->attribute('name', 'storeform')->open() }}
		{{ html()->hidden('search_code', $search_code) }}
		{{ html()->hidden('search_big_code', $search_big_code) }}
		{{ html()->hidden('search_name', $search_name) }}
		{{ html()->hidden('search_prodLink', $search_prodLink) }}
		{{ html()->hidden('search_supLink', $search_supLink) }}
		{{ html()->hidden('search_del', $search_del) }}

	    <TABLE width="600" border="1" cellspacing="0" cellpadding="2">
			<TR bgcolor="#8080c0">
				<TH nowrap><FONT color="White">コード</FONT></TH>
				<TH nowrap><FONT color="White">商品大分類</FONT></TH>
				<TH nowrap><FONT color="White">名称</FONT></TH>
				<TH nowrap><FONT color="White">商品<br>LINK不可</FONT></TH>
				<TH nowrap><FONT color="White">サプライ<br>LINK不可</FONT></TH>
				<TH nowrap><FONT color="White">更新者 ID</FONT></TH>
				<TH nowrap><FONT color="White">更新日</FONT></TH>
				<TH nowrap><FONT color="White">削除</FONT></TH>
			</TR>
	      
			@foreach ($middleList as $mid_list)
				<TR bgcolor="White">
					<TD align="center">{{ $mid_list->middle_category_code }}
						{{ html()->hidden('codeList[]', $mid_list->middle_category_code) }}
					</TD>
					<TD align="center" width="200px">
						<SELECT name="bigCodeList[{{$mid_list->middle_category_code}}]">
							@foreach ($bigCategoryAll as $big)
								<option value="{{ $big->big_category_code }}" @if ($big->big_category_code == $mid_list->middle_big_category_code) selected @endif @if ($big->big_category_del == '1') style="color:red" @endif>
									{{ $big->big_category_code }}：{{ $big->big_category_name }} @if ($big->big_category_del == '1') &nbsp;[削除] @endif
								</option>
							@endforeach
						</SELECT>
					</TD>
					<TD nowrap>
						{{ html()->text("nameList[{$mid_list->middle_category_code}]", $mid_list->middle_category_name)->attributes(['maxlength' => '40' ,'size' => '50']) }}
					</TD>
					<TD align="center">
						{{ html()->checkbox("prodLinkList[{$mid_list->middle_category_code}]", $mid_list->middle_category_link_flag , $mid_list->middle_category_code) }}
					</TD>
					<TD align="center">
						{{ html()->checkbox("supLinkList[{$mid_list->middle_category_code}]", $mid_list->middle_category_sup_link_flag , $mid_list->middle_category_code) }}
					</TD>
					<TD align="center">
						{{ $mid_list->middle_category_modified_id }}
					</TD>
					<TD align="center">
						{{ substr(str_replace("-", "/", $mid_list->middle_category_update), 0, 10) }}
					</TD>
					<TD align="center">
						{{ html()->checkbox("delList[{$mid_list->middle_category_code}]", $mid_list->middle_category_del, $mid_list->middle_category_code) }}
					</TD>
				</TR>
			@endforeach
			
			<TR>
				<TD colspan=8 align="center">
					@if (session('status') === 'success-store')
						<p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm text-blue-400 dark:text-blue-400" style="color: blue;">更新が完了しました。</p>
					@endif

					{{ html()->submit('更新')->attribute('name', 'update') }}
				</TD>
			</TR>
		</TABLE>

		{{ html()->form()->close() }}

	</TD>
</TR>
</TABLE>

{{--------------------------------------------------------------------}}

</x-admin-layout>
