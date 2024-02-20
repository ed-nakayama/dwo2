<HTML>
<HEAD>
<TITLE>必ずお読みください</TITLE>
</HEAD>
<BODY bgcolor="#fafafa">
<FORM name="myform">
<div id="message">
<br>
<table border="0">
<tr>
	<td>　<img src="../img/caution.jpg" width="45" height="40"></td>
	<td valign="middle">　<font size="+2"><b>必ずお読みください</b></font></td>
</tr>
</table>
<br>
　<b>お取引に掛かる消費税について</b><br>
<br>
{%if $session.agentAry.custGroup2 == '430' || $session.agentAry.custGroup2 == '436' || $session.agentAry.custGroup2 == '454' || $session.agentAry.custGroup2 == '458'  || $session.agentAry.custGroup2 == '460' || $session.agentAry.custGroup2 == '464' %}
　商品出荷時（※）における法定税率で課税し請求させていただきます。<br>
　ご購入のお客様（ユーザー登録のお客様）による「ご承認」が遅れた場合、<br>
　ご注文入力時とは異なる消費税率で請求する場合がございます。<br>
<br>
　（※）あんしん保守サポートは、有償サポート開始日における法定税率で<br>
　　　　課税し、請求させていただきます。<br>
{%else%}{%*非厳選*%}
　商品出荷時における法定税率で課税し請求させていただきます。<br>
　ご購入のお客様（ユーザー登録のお客様）による「ご承認」が遅れた場合、<br>
　ご注文入力時とは異なる消費税率で請求する場合がございます。<br>
{%/if%}
<br>
</div>
<center>
	<input type="button" name="buttonA" value="同意しない" onClick="returnValue=false; self.window.close()">　　　
	<input type="button" name="buttonB" value="同意する" onClick="returnValue=true; self.window.close()">
</center>
</form>
 </BODY>
</HTML>
