<x-admin-layout>

<head>
	<title>納品先マスタ</title>
</head>


{{--------------------------------------------------------------------}}

@foreach ($errors->all() as $error)
	<li style="list-style:none; color:red;">{{ $error }}</li>
@endforeach


{{ html()->form('GET', '/admin/order/delivery/search')->open() }}
<TABLE>
  <TR>
     <TD colspan="4" nowrap align="center" bgcolor="#0000a0"><FONT color="White">納品先マスタ</FONT></TD>
  </TR>

  <TR bgcolor="#8080ff">
    <TD nowrap align="center"><FONT color="white">得意先コード</FONT></TD>
    <TD nowrap align="center"><FONT color="white">納品先名称</FONT></TD>
    <TD nowrap align="center"><FONT color="white">電話番号（‐なし）</FONT></TD>
    <TD nowrap align="center"><FONT color="white">住所１</FONT></TD>
  </TR>
  <TR>
    <TD nowrap align="center">
		{{ html()->text('search_cust_code')->attribute('size', '20') }}
    </TD>
    <TD nowrap align="center">
		{{ html()->text('search_delivery_name')->attribute('size', '50') }}
    </TD>
    <TD nowrap align="center">
		{{ html()->text('search_tel')->attribute('size', '20') }}
    </TD>
    <TD nowrap align="center">
		{{ html()->text('search_addr')->attribute('size', '40') }}
    </TD>
  </tr>
  <tr>
    <TD nowrap align="center" colspan="4">
		{{ html()->submit('検索') }}
    </TD>
  </TR>
</TABLE>
{{ html()->form()->close() }}

{{--------------------------------------------------------------------}}

</x-admin-layout>
