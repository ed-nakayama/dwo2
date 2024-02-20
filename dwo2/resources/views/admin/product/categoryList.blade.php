<x-admin-layout>

<head>
	<title>商品分類登録マスタ</title>
</head>


{{--------------------------------------------------------------------}}

<TABLE width="300">
	@foreach ($errors->all() as $error)
		<li style="list-style:none; color:red;">{{ $error }}</li>
	@endforeach
</TABLE>

{{ html()->form('GET', '/admin/product/category')->open() }}
<TABLE>
  <TR>
     <TD  colspan=2 nowrap align="center" bgcolor="#0000a0"><FONT color="White">商品分類 登録マスタ</FONT></TD>
  </TR>

	<TR bgcolor="#8080ff">
		<th>
			<FONT color="white">商品コード</FONT>
		</th>
		<TD></TD>
	</TR>
	<TR>
		<TD nowrap align="center">
			{{ html()->text('prodCode', $prodCode)->attribute('size', '12') }}
		</TD>
		<TD nowrap align="center">
			{{ html()->submit('検索') }}
		</TD>
	</TR>
</TABLE>
{{ html()->form()->close() }}

{{--------------------------------------------------------------------}}

</x-admin-layout>
