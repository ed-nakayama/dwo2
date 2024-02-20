<HTML>
<HEAD>
<TITLE>認証エラー</TITLE>
</HEAD>

<BODY bgcolor="#FFFFFF">

ログインできません。エラー内容をご確認の上、再度ログインして下さい。<BR><BR>
再度トライしてもログインできない場合は、受注管理課までお問合せ下さい。<BR><BR>

<FONT color="#ff0000">■</FONT> エラー内容 <FONT color="#ff0000">■</FONT><BR>
{%foreach from=$errors item=error%}
          <font color=red><li>{%$error%}</font></li>
{%/foreach%}

<FORM>
<INPUT type="button" name="button" value="戻る" onClick="history.go(-1)">
</FORM>
</BODY>
</HTML>
