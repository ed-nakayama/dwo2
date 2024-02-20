<x-admin-layout>

<head>
	<title>得意先サブマスタ　詳細</title>
</head>


{{--------------------------------------------------------------------}}

<CENTER>

<DIV align="left">
<TABLE width="500" border="0" cellspacing="0" cellpadding="2">
<TR>
	<TD nowrap align="center">
		<TABLE width="300">
			<TR>
				<TD>
					@foreach ($errors->all() as $error)
			          <font color=red><li>{{ $error }}</font></li>
					@endforeach
				</TD>
			</TR>
		</table>

		{{ html()->form('POST', '/admin/cust/detail/store')->open() }}
		{{ html()->hidden('cust_code', $cust->profile_cust_code) }}

		<TABLE width="350" border="1" cellspacing="0" cellpadding="2">
			<TR>
				<TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">得意先コード</FONT></TD>
				<TD colspan="3">{{ $cust->profile_cust_code }}</TD>
			</TR>
			<TR>
				<TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">得意先名称</FONT></TD>
				<TD colspan="3">{{ $cust->name1 . $cust->name2 }}</TD>
			</TR>
			<TR>
				<TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">取引先形態（取引先別）</FONT></TD>
				<TD colspan="3">{{ $cust->class_medium_name . '(' . $cust->class_small_name . ')' }}&nbsp;</TD>
			</TR>
			<TR>
				<TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">電話番号</FONT></TD>
				<TD colspan="3">{{ $cust->tel }}</TD>
			</TR>
			<TR>
				<TD nowrap align="left" width="10%" bgcolor="#8080c0"><FONT color="white">登録メールアドレス（シェルパ）</FONT></TD>
				<TD>{{ $cust->email }}</TD>
				<TD nowrap align="left" width="10%" bgcolor="#8080c0"><FONT color="white">送信</FONT></TD>
				<TD>
					{{ html()->checkbox('mail_flag', $cust->profile_mail_flag, '1') }}
				</TD>
			</TR>
			<TR>
				<TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">追加メールアドレス</FONT></TD>
				<TD>
					{{ html()->text('extra_mail', $cust->profile_extra_mail)->attribute('size', '40') }}
				</TD>
				<TD nowrap align="left" width="10%" bgcolor="#8080c0"><FONT color="white">送信</FONT></TD>
				<TD>
					{{ html()->checkbox('extra_mail_flag', $cust->profile_extra_mail_flag, '1') }}
				</TD>
			</TR>
			<TR>
				<TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">WEB 利用</FONT></TD>
				<TD colspan="3">
					{{ html()->checkbox('web_flag', $cust->profile_web_flag, '1') }}
				</TD>
			</TR>
			<TR>
				<TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">備考</FONT></TD>
				<TD colspan="3">
					{{ html()->text('comment', $cust->profile_comment)->attributes(['size' => '40' , 'maxlength' => '40']) }}
				</TD>
			</TR>
			<TR>
				<TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">更新者ID</FONT></TD>
				<TD colspan="3">{{ $cust->profile_modified_id }}</TD>
			</TR>
			<TR>
				<TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">更新日</FONT></TD>
				<TD colspan="3">{{ str_replace("-", "/", $cust->profile_update) }}</TD>
			</TR>
			<TR>
				<TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">削除</FONT></TD>
				<TD colspan="3">
					{{ html()->checkbox('del_flag', $cust->profile_del, '1') }}
				</TD>
			</TR>
			<TR>
				<TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">売掛残高</FONT></TD>
				<TD colspan="3">￥{{ number_format( $cust->salesPrice) }}</TD>
			</TR>
			<TR>
				<TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">DWO受注残高</FONT></TD>
				<TD colspan="3">￥{{ number_format( $cust->zanPrice) }}</TD>
			</TR>
			<TR>
				<TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">与信限度額</FONT></TD>
				<TD colspan="3">￥{{ number_format( $cust->limitPrice) }}</TD>
			</TR>
			<TR>
				<TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">取引猶予額</FONT></TD>
				<TD colspan="3">￥{{ number_format( $cust->restPrice) }}</TD>
			</TR>
			<TR>
				<TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">保守開始日</FONT></TD>
				<TD colspan="3">{{ substr($cust->start_date, 0 ,4) . '/' . substr($cust->start_date, 4 ,2) . '/'. substr($cust->start_date, 6 ,2) }}&nbsp;</TD>
			</TR>
			<TR>
				<TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">保守終了日</FONT></TD>
				<TD colspan="3">{{ substr($cust->end_date, 0 ,4) . '/' . substr($cust->end_date, 4 ,2) . '/'. substr($cust->end_date, 6 ,2) }}&nbsp;</TD>
			</TR>
		</TABLE>

		<BR>
		@if (session('status') === 'success-updated')
			<p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm text-blue-400 dark:text-blue-400" style="color: blue;">修正が完了しました。</p>
		@endif

		{{ html()->submit('修正') }}
		{{ html()->form()->close() }}
	</TD>
</TR>
</TABLE>

<!--
<script language="JavaScript">
function dsp_hist() {
	window.open( "", "win_hist", "width=600,height=500"+
				",scrollbars=1,resizable=1"+
				",toolbar=0,menubar=0,location=0,directories=0,status=0" );
	document.frm_hist.submit();
}
</script>
<FORM name="frm_hist" method="post" action="ope_hist.html" target="win_hist">
<INPUT type="hidden" name="code" value="001001">
<HR>
<TABLE border="1" cellspacing="0" cellpadding="2">
<TR><TD bgcolor="#e0e0e0">
開始 <INPUT name="dsp_sno" value="0" size="4">
件数 <INPUT name="dsp_cnt" value="20" size="3">
<input type="button" value="操作履歴" onClick="dsp_hist()">
</TD></TR>
</TABLE>
</FORM>
-->

{{--------------------------------------------------------------------}}

</x-admin-layout>
