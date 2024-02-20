<x-admin-layout>

<head>
	<title>得意先サブマスタ</title>
</head>


{{--------------------------------------------------------------------}}

	@foreach ($errors->all() as $error)
		<font color=red><li>{{ $error }}</font></li>
	@endforeach


{{-- 検索エリア --}}
{{ html()->form('POST', '/admin/cust/search')->open() }}
<TABLE border="1">
  <TR>
     <TD colspan="8" nowrap align="center" bgcolor="#0000a0"><FONT color="White">得意先サブマスタ</FONT></TD>
  </TR>

  <TR bgcolor="#8080ff">
    <TH nowrap><FONT color="white">得意先コード</FONT></TH>
    <TH nowrap><FONT color="white">お客様番号</FONT></TH>
    <TH nowrap><FONT color="white">得意先名称</FONT></TH>
    <TH nowrap><FONT color="white">得意先名称カナ</FONT></TH>
    <TH nowrap><FONT color="white">TEL</FONT></TH>
    <TH nowrap><FONT color="white">Web利用(可)</FONT></TH>
    <TH nowrap><FONT color="white">削除</FONT></TH>
    <TH nowrap><FONT color="white">検索</FONT></TH>
  </TR>
  <TR>
    <TD nowrap>
		{{ html()->text('search_cust_code', $param['search_cust_code'])->attribute('size', '12') }}
    </TD>
    <TD nowrap>
		{{ html()->text('search_account_num', $param['search_account_num'])->attribute('size', '12') }}
    </TD>
    <TD nowrap>
		{{ html()->text('search_name', $param['search_name'])->attribute('size', '24') }}
    </TD>
    <TD nowrap>
		{{ html()->text('search_name_kana', $param['search_name_kana'] )->attribute('size', '24') }}
    </TD>
    <TD nowrap>
		{{ html()->text('search_tel', $param['search_tel'])->attribute('size', '20') }}
    </TD>
    <TD nowrap align="center">
		{{ html()->checkbox('search_web_flag',$param['search_web_flag'] ) }}
    </TD>
    <TD nowrap align="center">
		{{ html()->checkbox('search_del_flag', $param['search_del_flag']) }}
    </TD>
    <TD nowrap align="center">
		{{ html()->submit('検索') }}
    </TD>
  </TR>
</TABLE>
{{ html()->form()->close() }}

<br /><br />

{{-- 一覧エリア --}}
@if(isset($custList[0]))
<table border="1" cellspacing="0" cellpadding="2">
	<tr bgcolor="#8080c0">
		<th nowrap align="center"><font color="white">得意先コード</font></th>
		<th nowrap align="center"><font color="white">お客様番号</font></th>
		<th nowrap align="center"><font color="white">得意先名称</font></th>
		<th nowrap align="center"><font color="white">得意先名称カナ</font></th>
		<th nowrap align="center"><font color="white">TEL</font></th>
		<th nowrap align="center"><font color="white">WEB利用</font></th>
		<th nowrap align="center"><font color="white">削除</font></th> 
		<th nowrap align="center"></th>
	</tr>
	@foreach ($custList as $cust)
		{{ html()->form('POST', '/admin/cust/detail')->attribute('name', 'form' . $loop->index)->open() }}
		{{ html()->hidden('cust_code', $cust->profile_cust_code) }}

		@if (($loop->index % 2) == 0)
			<tr bgcolor="#d1d1e9">
		@else
			<tr bgcolor="white">
		@endif
			<td align="left">{{ $cust->profile_cust_code }}</td>
			<td align="left">{{ $cust->account_num }}</td>
			<td align="left">{{ $cust->name1 . $cust->name2 }}</td>
			<td align="left">{{ $cust->search_name_kana }}</td>
			<td align="left">{{ $cust->tel }}</td>
			<td align="center">
				<font color="red">
					@if (!empty($cust->profile_web_flag))
						可
					@else
						&nbsp;
					@endif
				</font>
			</td>
			<td align="center">
				<font color="red">
					@if (!empty($cust->profile_del))
						〇
					@else
						&nbsp;
					@endif
				</font>
			</td>
			<TD nowrap align="center">
				<a href="javascript:form{{ $loop->index}}.submit()" }}">詳細</a>
			</TD>
		</tr>
		{{ html()->form()->close() }}
	@endforeach
</table>

<center>
<table border="0">
	<tr>
		<td>
			<div class="pager">
				{{ $custList->appends(request()->query())->links('vendor.pagination.admin') }}
			</div>
		</td>
	</tr>
</table>
</center>

@endif


{{--------------------------------------------------------------------}}

</x-admin-layout>
