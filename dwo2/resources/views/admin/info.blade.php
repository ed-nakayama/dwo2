<x-admin-layout>

<head>
	<title>お知らせ</title>
</head>


{{--------------------------------------------------------------------}}

    @if (session('flash_message'))
		<FONT color="red">{{ session('flash_message') }}</font><br>
	@endif

	@foreach ($errors->all() as $error)
		<li style="list-style:none; color:red;">{{ $error }}</li>
	@endforeach

<table border=0>
<tr><td>
{{ html()->form('POST', '/admin/info/store')->open() }}
<TABLE border=1>
  <TR>
     <TD nowrap align="center" bgcolor="#0000a0"><FONT color="White">お知らせマスタ（YBP用）</FONT></TD>
  </TR>
  <TR>
    <TD>
		{{ html()->textarea('infoMsg' ,$info->msg)->attributes(['cols' => '48', 'rows' => '20']) }}
    </TD>
  </TR>
  <TR>
    <TD align="center">
		{{ html()->submit('　更新　')->attribute('name', 'update')->value('update') }}
    </TD>
  </TR>
</TABLE>
{{ html()->form()->close() }}
</td>
{{--
<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>
{{ html()->form('POST', '/admin/info/store')->open() }}
<TABLE border=1>
  <TR>
     <TD nowrap align="center" bgcolor="#0000a0"><FONT color="White">お知らせマスタ（PAP用）</FONT></TD>
  </TR>
  <TR>
    <TD>
		{{ html()->textarea('infoMsg2' ,$info->msg2)->attributes(['cols' => '48', 'rows' => '20']) }}
    </TD>
  </TR>
  <TR>
    <TD align="center">
		{{ html()->submit('　更新　')->attribute('name', 'update2')->value('update2') }}
    </TD>
  </TR>
</TABLE>
{{ html()->form()->close() }}
</td>
--}}
</tr>
</table>

{{--------------------------------------------------------------------}}

</x-admin-layout>
