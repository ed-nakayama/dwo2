<html lang="ja">
<head>
<meta http-equiv="Content-Type"content="text/html;charset=shift_jis">
<title>弥生 WEB ORDER</title>
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
		<img src="../img/welcome.png" alt="弥生webオーダーへようこそ" width="500px" height="50px">
		</td>
		<td>
		<script src=https://seal.verisign.com/getseal?host_name=dwo2.yayoi-kk.co.jp&size=M&use_flash=YES&use_transparent=NO&lang=ja></script>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center" valign="middle" height="50px">
			<input type="button" value="このページをブックマークにする" onClick="javascript:if (window.external) external.addFavorite(location.href, '弥生Webオーダー');">
		</td>
	</tr>
</table>

<form name="frm" action="{%$script%}" method="POST" style="margin:0px">
<input type="hidden" name="action_weborderLoginDo" value="true">

<table align="center" border="0" >

	<tr>
		<td><h4>
　　　　　　　　　　　　■■サービス一時停止のお知らせ■■<br>	
　　　　　　　　　　　　システムメンテナンスのため、下記時間帯でサービスを<br>
　　　　　　　　　　　　一時停止させていただきます。<br>
　　　　　　　　　　　　ご利用のお客様にはご迷惑をおかけ致しますが、<br>
　　　　　　　　　　　　何卒ご了承いただけるようお願い申し上げます。<br><br>

　　　　　　　　　　　　【停止期間】<br>
　　　　　　　　　　　　2009年11月14日(土) 20:00 ～ 2009年11月15(日) 9:30<予定><br>

		</h4></td>
	</tr>
<!--


	<tr>
		<td><h4>▼ログインID、パスワード1、パスワード2を入力してください。</h4></td>
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
		<p class="words"><span id="essential">申し訳ございませんが、お受付できません。<br />
		弥生株式会社 受注管理課までお問合せください。<br />
		お問合せ先：03-5207-8730</p></span>
		</td>
	</tr>
{%/if%}

{%if $app.tran_status_error == "on"%}
	<tr>
		<td align="center">
		<table border="0" cellpadding="0" cellspacing="0">
			<tr><td align="left"><p class="words"><span id="essential">申し訳ございませんが、お受付できません。</p></span></td></tr>
			<tr><td align="left"><p class="words"><span id="essential">後ほど弥生㈱より、ご登録のご連絡先宛に</p></span></td></tr>
			<tr><td align="left"><p class="words"><span id="essential">連絡させていただきます。</p></span></td></tr>
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
							<td class="item" width="100">ログインID</td>
{%if $app.cookie_recid == ""%}
							<td><input type="text" name="cust_code" size="20" maxlength="9" value="{%$form.cust_code%}" style="ime-mode: disabled;"></td>
{%else%}
							<td><input type="text" name="cust_code" size="20" maxlength="9" value="{%$app.cookie_recid%}" style="ime-mode: disabled;"></td>
{%/if%}
							<td>&nbsp;&nbsp;<a href="?action_weborderInformation=t#forgetid" target="_blank">IDを忘れてしまったら</a></td>
						</tr>
						<tr>
							<td class="item">パスワード1</td>
							<td><input type="password" name="passwd1" size="15" maxlength="20" value="{%$form.password1%}" style="ime-mode: disabled;"></td>
							<td>&nbsp;&nbsp;<a href="?action_weborderInformation=t#forgetpassword" target="_blank">パスワードを忘れてしまったら</a></td>
						</tr>
						<tr>
							<td class="item">パスワード2</td>
							<td colspan="2"><input type="password" name="passwd2" size="15" maxlength="20" value="{%$form.password2%}" style="ime-mode: disabled;"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td align="left"><input type="checkbox" name="frm_rec_id" {%if $app.cookie_recid != ""%}checked{%/if%}><font size="2">次回からログインIDを記憶する</font></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td align="center">
			<a href="javascript:document.frm.submit();"><img src="../img/login.png" alt="ログイン" width="120px" height="50px"></a> 
		</td>
	</tr>

-->

	<tr>
		<td valign="bottom">
			<br /><br />
			<table border="0">
				<tr>
					<td>
					■&nbsp;<a href="?action_weborderInformation=t#weborder" target="_blank">弥生Webオーダーについて</a><br />
					</td>
				</tr>
				<tr>
					<td>
					■&nbsp;<a href="?action_weborderInformation=t#order" target="_blank">ご注文について</a><br />
					</td>
				</tr>
				<tr>
					<td>
					■&nbsp;<a href="?action_weborderInformation=t#shipment" target="_blank">商品発送と伝票送付について</a><br />
					</td>
				</tr>
				<tr>
					<td>
					■&nbsp;<a href="?action_weborderInformation=t#payment" target="_blank">お支払いについて</a><br />
					</td>
				</tr>
				<tr>
					<td>
					■&nbsp;<a href="?action_weborderInformation=t#return" target="_blank">ご注文商品の返品について</a><br />
					</td>
				</tr>
				<tr>
					<td>
					■&nbsp;<a href="?action_weborderInformation=t#inquiry" target="_blank">ご注文に関するお問い合わせについて</a><br />
					</td>
				</tr>
				<tr>
					<td>
					■&nbsp;<a href="?action_weborderInformation=t#password" target="_blank">パスワードについて</a><br />
					</td>
				</tr>
				<tr>
					<td>
					■&nbsp;<a href="?action_weborderInformation=t#browser" target="_blank">対応ブラウザについて</a><br />
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="50px">
		<p class="mail">
		下記内容以外にご不明な点等ございましたら、<a href="mailto:order-center@yayoi-kk.co.jp">order-center@yayoi-kk.co.jp</a> にお問い合わせ下さい。</p><p class="top">
		</td>
	</tr>
</table>

</form>

{%include file="weborder/common/footer.tpl"%}
</div>
</center>
</body>
</html>