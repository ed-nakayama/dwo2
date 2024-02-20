<x-admin-layout>

<head>
	<title>管理ユーザマスタ</title>
</head>


{{--------------------------------------------------------------------}}
<TABLE width="500" border="0" cellspacing="5" cellpadding="0">
  <TR>
    <TD nowrap align="left" valign="top">
    
    <CENTER>
    <TABLE width="300">
    <TR>
    <TD nowrap align="center" bgcolor="#0000a0"><FONT color="White">管理ユーザマスタ</FONT></TD></TR>
    </TABLE>
    </CENTER>
    <BR>

		{{-- 新規登録エリア --}}
		<ul class="oneRow">
			@error('new_id')
				<li><span class="invalid-feedback" role="alert" style="color:#ff0000;">{{ $message }}</span></li>
			@enderror
			@error('new_name')
				<li><span class="invalid-feedback" role="alert" style="color:#ff0000;">{{ $message }}</span></li>
			@enderror
			@error('new_name_roman')
				<li><span class="invalid-feedback" role="alert" style="color:#ff0000;">{{ $message }}</span></li>
			@enderror
			@error('new_password')
				<li><span class="invalid-feedback" role="alert" style="color:#ff0000;">{{ $message }}</span></li>
			@enderror
			@error('new_tel')
				<li><span class="invalid-feedback" role="alert" style="color:#ff0000;">{{ $message }}</span></li>
			@enderror
			@error('new_mail')
				<li><span class="invalid-feedback" role="alert" style="color:#ff0000;">{{ $message }}</span></li>
			@enderror
		</ul>
		

		{{ html()->form('POST', '/admin/operator/detail/regist')->open() }}
		<TABLE width="300" border="1" cellspacing="0" cellpadding="2">
			<TR bgcolor="#0099d2">
				<TH nowrap><FONT size=2 color="White">ID</FONT></TH>
				<TH nowrap><FONT size=2 color="White">アクセス権</FONT></TH>
				<TH nowrap><FONT size=2 color="White">名前</FONT></TH>
				<TH nowrap><FONT size=2 color="White">名前<br>(ローマ字)</FONT></TH>
				<TH nowrap><FONT size=2 color="White">パスワード</FONT></TH>
				<TH nowrap><FONT size=2 color="White">内線番号</FONT></TH>
				<TH nowrap><FONT size=2 color="White">E-Mail</FONT></TH>
			</TR>
			<TR>
				<TD nowrap>
					{{ html()->text('new_id')->attribute('size', '30') }}
				</TD>
				<TD nowrap align="center">
					{{ html()->checkbox('new_priv', '' ,'1') }}
				</TD>
				<TD nowrap>
					{{ html()->text('new_name')->attribute('size', '15') }}
				</TD>
				<TD nowrap>
					{{ html()->text('new_name_roman')->attribute('size', '15') }}
				</TD>
				<TD nowrap>
					{{ html()->text('new_password')->attribute('size', '10') }}
				</TD>
				<TD nowrap>
					{{ html()->text('new_tel')->attribute('size', '10') }}
				</TD>
				<TD nowrap>
					{{ html()->text('new_mail')->attribute('size', '30') }}
				</TD>

			</TR>
			<tr>
				<TD nowrap colspan=8 align="center">
					@if (session('status') === 'success-regist')
						<p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm text-blue-400 dark:text-blue-400" style="color: blue;">新規登録が完了しました。</p>
					@endif

					{{ html()->submit('新規登録') }}
				</TD>
			</tr>
		</TABLE>
		{{ html()->form()->close() }}
		<BR>

		<ul class="oneRow">
			@error('idList.*')
				<li><span class="invalid-feedback" role="alert" style="color:#ff0000;">{{ $message }}</span></li>
			@enderror
			@error('nameList.*')
				<li><span class="invalid-feedback" role="alert" style="color:#ff0000;">{{ $message }}</span></li>
			@enderror
			@error('mailList.*')
				<li><span class="invalid-feedback" role="alert" style="color:#ff0000;">{{ $message }}</span></li>
			@enderror
			@error('telList.*')
				<li><span class="invalid-feedback" role="alert" style="color:#ff0000;">{{ $message }}</span></li>
			@enderror
		</ul>

    <TABLE cellspacing="0" cellpadding="2">
      <TR>
        <TH nowrap bgcolor="#8080c0"><FONT color="White">件数 {{ $adminList->count() }}</FONT></TH>
        <TH nowrap></TH>
        <TH nowrap></TH>
      </TR>
    </TABLE>

		{{ html()->form('POST', '/admin/operator/detail/store')->attribute('name', 'upform')->open() }}
	    <TABLE width="600" border="1" cellspacing="0" cellpadding="2">
			<TR bgcolor="#8080c0">
				<TH nowrap><FONT size=2 color="White">コード</FONT></TH>
				<TH nowrap><FONT size=2 color="White">ID</FONT></TH>
				<TH nowrap><FONT size=2 color="White">アクセス権</FONT></TH>
				<TH nowrap><FONT size=2 color="White">名前</FONT></TH>
				<TH nowrap><FONT size=2 color="White">名前<br>(ローマ字)</FONT></TH>
				<TH nowrap><FONT size=2 color="White">内線番号</FONT></TH>
				<TH nowrap><FONT size=2 color="White">E-Mail</FONT></TH>
				<TH nowrap><FONT size=2 color="White">更新者ID</FONT></TH>
				<TH nowrap><FONT size=2 color="White">更新日</FONT></TH>
				<TH nowrap><FONT size=2 color="White">削除</FONT></TH>
			</TR>
			@foreach ($adminList as $admin)
				<TR>
					<TD nowrap align="right">
						{{ $admin->operator_code }}
						{{ html()->hidden('codeList[]', $admin->operator_code) }}
					</TD>
					<TD>
						{{ html()->text("idList[{$admin->operator_code}]", $admin->operator_id)->attribute('size', '10') }}
					</TD>
					<TD align="center">
						{{ html()->checkbox("privList[{$admin->operator_code}]", $admin->operator_priv, $admin->operator_code) }}
					</TD>
					<TD>
						{{ html()->text("nameList[{$admin->operator_code}]", $admin->operator_name)->attribute('size', '15') }}
					</TD>
					<TD>
						{{ html()->text("nameRomanList[{$admin->operator_code}]", $admin->operator_name_roman)->attribute('size', '15') }}
					</TD>
					<TD>
						{{ html()->text("telList[{$admin->operator_code}]", $admin->operator_tel)->attribute('size', '10') }}
					</TD>
					<TD>
						{{ html()->text("mailList[{$admin->operator_code}]", $admin->email)->attribute('size', '30') }}
					</TD>
					<TD nowrap>{{ $admin->operator_modified_id  }}</TD>
					<TD>{{ substr(str_replace("-", "/", $admin->operator_update), 0, 10) }}</TD>
					<TD align="center">
						{{ html()->checkbox("delList[{$admin->operator_code}]", $admin->operator_del, $admin->operator_code) }}
					</TD>
				</TR>
			@endforeach
			<TR>
				<TD nowrap colspan=12 align="center">
					@if (session('status') === 'success-store')
						<p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm text-blue-400 dark:text-blue-400" style="color: blue;">更新が完了しました。</p>
					@endif

					{{ html()->submit('更新') }}
				</TD>
			</TR>
		</TABLE>
		{{ html()->form()->close() }}

	</TD>
</TR>
</TABLE>
{{--------------------------------------------------------------------}}

</x-admin-layout>
