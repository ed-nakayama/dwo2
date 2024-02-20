<x-admin-layout>

<head>
	<title>受注ステータスマスタ</title>
</head>

{{--------------------------------------------------------------------}}

<TABLE width="500" border="0" cellspacing="5" cellpadding="0">
  <TR>
    <TD nowrap align="left" valign="top">
    
    <CENTER>
    <TABLE width="300">
    <TR>
    <TD nowrap align="center" bgcolor="#0000a0"><FONT color="White">受注ステータス マスタ</FONT></TD></TR>
    </TABLE>
    </CENTER>
    <BR>

	@foreach ($errors->all() as $error)
		<li style="list-style:none; color:red;">{{ $error }}</li>
	@endforeach

	{{ html()->form('POST', '/admin/order/status/regist')->open() }}
    <TABLE width="300" border="1" cellspacing="0" cellpadding="2">
      <TR bgcolor="#0099d2">
        <TH nowrap><FONT color="White">ID</FONT></TH>
        <TH nowrap><FONT color="White">名称</FONT></TH>
      </TR>
      <TR>
        <TD nowrap align="right">
			{{ html()->text('new_id', '')->attributes(['size' => '10' , 'maxlength' => '3']) }}
        </TD>
        <TD nowrap>
			{{ html()->text('new_name', '')->attributes(['size' => '50' , 'maxlength' => '40']) }}
        </TD>
      </TR>
      <tr>
        <TD nowrap colspan=2 align="center">
			@if (session('status') === 'success-regist')
				<p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm text-blue-400 dark:text-blue-400" style="color: blue;">新規登録が完了しました。</p>
			@endif

			{{ html()->submit('新規登録') }}
        </TD>
      </tr>
    </TABLE>
	{{ html()->form()->close() }}


    <BR>
    <TABLE cellspacing="0" cellpadding="2">
      <TR>
        <TH nowrap bgcolor="#8080c0"><FONT color="White">件数 {{ $dataList->count() }}</FONT></TH>
        <TH nowrap></TH>
        <TH nowrap></TH>
      </TR>
    </TABLE>

	{{ html()->form('POST', '/admin/order/status/store')->open() }}
    <TABLE width="600" border="1" cellspacing="0" cellpadding="2">
      <TR bgcolor="#8080c0">
        <TH nowrap><FONT color="White">ID</FONT></TH>
        <TH nowrap><FONT color="White">名称</FONT></TH>
        <TH nowrap><FONT color="White">表示順</FONT></TH>
        <TH nowrap><FONT color="White">更新者ID</FONT></TH>
        <TH nowrap><FONT color="White">更新日</FONT></TH>
        <TH nowrap><FONT color="White">削除</FONT></TH>
      </TR>
@foreach ($dataList as $list)
      <TR>
        <TD nowrap align="right">
        	{{ $list->order_status_id }}
			{{ html()->hidden('idList[]', $list->order_status_id) }}
        </TD>
        <TD nowrap>
			{{ html()->text("nameList[{$list->order_status_id}]", $list->order_status_name)->attributes(['size' => '50' , 'maxlength' => '40']) }}
        </TD>
        <TD nowrap>
			{{ html()->text("sortList[{$list->order_status_id}]", $list->order_sort_num)->attributes(['size' => '4' , 'maxlength' => '3']) }}
        </TD>
        <TD nowrap>{{ $list->order_status_modified_id }}</TD>
        <TD nowrap>{{ substr(str_replace("-", "/", $list->order_status_update),0 ,10) }}</TD>
        <TD align="center">
 			{{ html()->checkbox("delList[{$list->order_status_id}]", $list->order_status_del ,$list->order_status_id) }}
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

</TD>
</TR></TABLE>

{{--------------------------------------------------------------------}}

</x-admin-layout>
