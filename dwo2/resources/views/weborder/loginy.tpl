<html lang="ja">
<head>
<meta http-equiv="Content-Type"content="text/html;charset=shift_jis">
<title>�퐶 WEB ORDER</title>
<link rel="stylesheet"type="text/css"href="../css/common.css">
</head>
<body topmargin="0">
<center>
<div id="main">
{%include file="weborder/common/header.tpl"%}

<table border="0">
	<tr>
		<td width="100px">
		</td>
		<td width="550px" height="50px" align="center" valign="bottom">
		<img src="../img/welcome.png" alt="�퐶web�I�[�_�[�ւ悤����" width="500px" height="50px">
		</td>
		<td>
		<script src=https://seal.verisign.com/getseal?host_name=dwo2.yayoi-kk.co.jp&size=M&use_flash=YES&use_transparent=NO&lang=ja></script>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center" valign="middle" height="50px">
			<input type="button" value="���̃y�[�W���u�b�N�}�[�N�ɂ���" onClick="javascript:if (window.external) external.addFavorite(location.href, '�퐶Web�I�[�_�[');">
		</td>
	</tr>
</table>

<form name="frm" action="{%$script%}" method="POST" style="margin:0px">
<input type="hidden" name="action_weborderLoginDo" value="true">

<table align="center" border="0" >

	<tr>
		<td><h4>
�@�@�@�@�@�@�@�@�@�@�@�@�����T�[�r�X�ꎞ��~�̂��m�点����<br>	
�@�@�@�@�@�@�@�@�@�@�@�@�V�X�e�������e�i���X�̂��߁A���L���ԑтŃT�[�r�X��<br>
�@�@�@�@�@�@�@�@�@�@�@�@�ꎞ��~�����Ă��������܂��B<br>
�@�@�@�@�@�@�@�@�@�@�@�@�����p�̂��q�l�ɂ͂����f���������v���܂����A<br>
�@�@�@�@�@�@�@�@�@�@�@�@��������������������悤���肢�\���グ�܂��B<br><br>

�@�@�@�@�@�@�@�@�@�@�@�@�y��~���ԁz<br>
�@�@�@�@�@�@�@�@�@�@�@�@2009�N11��14��(�y) 20:00 �` 2009�N11��15(��) 9:30<�\��><br>

		</h4></td>
	</tr>
<!--


	<tr>
		<td><h4>�����O�C��ID�A�p�X���[�h1�A�p�X���[�h2����͂��Ă��������B</h4></td>
	</tr>

{%if count($errors)%}
{%foreach from=$errors item=error%}
	<tr>
		<td align="center">
          <font color=red><li>{%$error%}</font></li>
		</td>
	<tr>
{%/foreach%}
{%/if%}

{%foreach from=$app.errors item=error%}
	<tr>
		<td align="center">
			<font color=red><li>{%$error%}</font></li>
		</td>
	<tr>
{%/foreach%}

{%if $app.yosin_error == "on"%}
	<tr>
		<td align="center">
		<p class="words"><span id="essential">�\���󂲂����܂��񂪁A����t�ł��܂���B<br />
		�퐶������� �󒍊Ǘ��ۂ܂ł��⍇�����������B<br />
		���⍇����F03-5207-8730</p></span>
		</td>
	</tr>
{%/if%}

{%if $app.tran_status_error == "on"%}
	<tr>
		<td align="center">
		<table border="0" cellpadding="0" cellspacing="0">
			<tr><td align="left"><p class="words"><span id="essential">�\���󂲂����܂��񂪁A����t�ł��܂���B</p></span></td></tr>
			<tr><td align="left"><p class="words"><span id="essential">��قǖ퐶�����A���o�^�̂��A���戶��</p></span></td></tr>
			<tr><td align="left"><p class="words"><span id="essential">�A�������Ă��������܂��B</p></span></td></tr>
		</table>
		</td>
	</tr>
{%/if%}

	<tr>
		<td>
		<table border="0">
			<tr>
				<td>
					<table class="new"  border="1" cellspacing="0" frame="hsides" rules="rows">
						<tr>
							<td class="item" width="100">���O�C��ID</td>
{%if $app.cookie_recid == ""%}
							<td><input type="text" name="cust_code" size="20" maxlength="9" value="{%$form.cust_code%}" style="ime-mode: disabled;"></td>
{%else%}
							<td><input type="text" name="cust_code" size="20" maxlength="9" value="{%$app.cookie_recid%}" style="ime-mode: disabled;"></td>
{%/if%}
							<td>&nbsp;&nbsp;<a href="?action_weborderInformation=t#forgetid" target="_blank">ID��Y��Ă��܂�����</a></td>
						</tr>
						<tr>
							<td class="item">�p�X���[�h1</td>
							<td><input type="password" name="passwd1" size="15" maxlength="20" value="{%$form.password1%}" style="ime-mode: disabled;"></td>
							<td>&nbsp;&nbsp;<a href="?action_weborderInformation=t#forgetpassword" target="_blank">�p�X���[�h��Y��Ă��܂�����</a></td>
						</tr>
						<tr>
							<td class="item">�p�X���[�h2</td>
							<td colspan="2"><input type="password" name="passwd2" size="15" maxlength="20" value="{%$form.password2%}" style="ime-mode: disabled;"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td align="left"><input type="checkbox" name="frm_rec_id" {%if $app.cookie_recid != ""%}checked{%/if%}><font size="2">���񂩂烍�O�C��ID���L������</font></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td align="center">
			<a href="javascript:document.frm.submit();"><img src="../img/login.png" alt="���O�C��" width="120px" height="50px"></a> 
		</td>
	</tr>

-->

	<tr>
		<td valign="bottom">
			<br /><br />
			<table border="0">
				<tr>
					<td>
					��&nbsp;<a href="?action_weborderInformation=t#weborder" target="_blank">�퐶Web�I�[�_�[�ɂ���</a><br />
					</td>
				</tr>
				<tr>
					<td>
					��&nbsp;<a href="?action_weborderInformation=t#order" target="_blank">�������ɂ���</a><br />
					</td>
				</tr>
				<tr>
					<td>
					��&nbsp;<a href="?action_weborderInformation=t#shipment" target="_blank">���i�����Ɠ`�[���t�ɂ���</a><br />
					</td>
				</tr>
				<tr>
					<td>
					��&nbsp;<a href="?action_weborderInformation=t#payment" target="_blank">���x�����ɂ���</a><br />
					</td>
				</tr>
				<tr>
					<td>
					��&nbsp;<a href="?action_weborderInformation=t#return" target="_blank">���������i�̕ԕi�ɂ���</a><br />
					</td>
				</tr>
				<tr>
					<td>
					��&nbsp;<a href="?action_weborderInformation=t#inquiry" target="_blank">�������Ɋւ��邨�₢���킹�ɂ���</a><br />
					</td>
				</tr>
				<tr>
					<td>
					��&nbsp;<a href="?action_weborderInformation=t#password" target="_blank">�p�X���[�h�ɂ���</a><br />
					</td>
				</tr>
				<tr>
					<td>
					��&nbsp;<a href="?action_weborderInformation=t#browser" target="_blank">�Ή��u���E�U�ɂ���</a><br />
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="50px">
		<p class="mail">
		���L���e�ȊO�ɂ��s���ȓ_���������܂�����A<a href="mailto:order-center@yayoi-kk.co.jp">order-center@yayoi-kk.co.jp</a> �ɂ��₢���킹�������B</p><p class="top">
		</td>
	</tr>
</table>

</form>

{%include file="weborder/common/footer.tpl"%}
</div>
</center>
</body>
</html>