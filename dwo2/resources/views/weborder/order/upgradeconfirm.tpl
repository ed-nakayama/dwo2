<html>
<head>
<title>ユーザー登録済み製品</title>
<link rel="stylesheet"type="text/css"href="../css/common.css">
<script type="text/javascript">
<!--
	function registration() {
		document.frm.frm_regist.value = "EXEC";
		document.frm.submit();
	}
-->
</script>
</head>
<body>
<center>
<div id="main">

{%include file="weborder/common/header.tpl"%}

{%include file="weborder/common/menu.tpl"%}

<div id="menu_userinfo">
<table border="0">
	<tr>
		<td class="userinfo" rowspan="3" valign="top">
{%include file="weborder/common/userinfo.tpl"%}
		</td>
	</tr>
	<tr>
		<td></td>
	</tr>
</table>
</div>

<form name="frm" action="{%$script%}" method="post" style="margin:0px;">
	<input type="hidden" name="action_weborderOrderUpgradecomp" value="true">
	<input type="hidden" name="frm_regist" value="">
</form>

<br />
<table border="0">
	<tr>
		<td>
		<h4 class="select">▼オーダー確認</h4>
		</td>
	</tr>
	<tr>
		<td>
		<table class="select" border="1" cellspacing="0">
			<tr>
				<td class="item" width="70px" align="center">商品コード</td>
				<td class="item" width="300px" align="center">商品名称</td>
				<td class="item" width="50px" align="center">{%if $session.orderinfo.upgrade_order == TRUE || ($session.orderinfo.cust_kbn != "OR" && $session.orderinfo.cust_kbn != "YBP") %}定価{%else%}参考価格{%/if%}</td>
				<td class="item" width="50px" align="center">提供価格</td>
				<td class="item" width="30px" align="center">数量</td>
				<td class="item" width="50px" align="center">金額</td>
			</tr>
			<tr>
				<td width="70px" align="center">{%$session.second_total_sp_item_cd%}</td>
				<td width="300px" align="left">{%$session.soft_name%}<br>&nbsp;
				（トータル{% if ($session.month_num >= 12) %}12{% else %}{%$session.month_num%}{%/if%}ヶ月分）</td>
				<td width="50px" align="right">\&nbsp;{%$session.upgrade_sale_price|number_format%}</td>
				<td class="discount" width="50px" align="right">\&nbsp;{%$session.upgrade_discount_price|number_format%}</td>
				<td width="30px" align="center">&nbsp;1&nbsp;</td>
				<td width="50px" align="right">\&nbsp;{%$session.upgrade_price|number_format%}</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td align="right">
			<table class="select" border="1" cellspacing="0" width="170px">
{%*
				<tr>
					<td class="item" width="35%">消費税</td>
					<td align="right" width="65%">\&nbsp;{%$session.upgrade_tax|number_format%}</td>
				</tr>
				<tr>
					<td class="item">合計</td>
					<td align="right">\&nbsp;{%$session.upgrade_total_price|number_format%}</td>
				</tr>
*%}
			<tr>
				<td class="item">合計(税抜)</td>
				<td align="right">\&nbsp;{%$session.upgrade_price|number_format%}</td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="right">（別途消費税）</td>
	</tr>
</table>

<table border="0">
	<tr>
		<td>
{%include file="weborder/common/tax_comment.tpl"%}
		</td>
	</tr>
	<tr>
		<td>
			■パートナー会員様への注意事項■<br />
			ご注文内容および以下のユーザー登録情報をご確認下さい。<br />
{%if $session.orderinfo.cust_kbn == "OR" || $session.orderinfo.cust_kbn == "YBP" %}
			ご購入のお客様（ユーザー登録のお客様）に「個人情報保護方針」についての承認確認メールを送信します。<br />
			ご承認後「注文確定」となります。<br /><br />
{%/if%}
		</td>
	</tr>
	<tr>
		<td class="search">▼ユーザー情報</td>
	</tr>
	<tr>
		<td align="center">
		<br /><table class="select" width="450px" border="1" cellspacing="0" frame="hsides" rules="rows">
			<tr>
				<td class="item" width="200px">登録名義</td>
				<td>{%$app.orderinfo.regist_name%}</td>
			</tr>
			<tr>
				<td class="item">登録名義(フリガナ)</td>
				<td>{%$app.orderinfo.regist_kana%}</td>
			</tr>
			<tr>
				<td class="item">代表取締役または代表者</td>
				<td>{%$app.orderinfo.regist_ceo%}</td>
			</tr>
			<tr>
				<td class="item">代表取締役または代表者(フリガナ)</td>
				<td>{%$app.orderinfo.regist_ceo_kana%}</td>
			</tr>
			<tr>
				<td class="item">担当者</td>
				<td>{%$app.orderinfo.regist_name_of_charge%}</td>
			</tr>
			<tr>
				<td class="item">担当者(フリガナ)</td>
				<td>{%$app.orderinfo.regist_name_of_charge_kana%}</td>
			</tr>
			<tr>
				<td class="item">メールアドレス</td>
				<td>{%$app.orderinfo.regist_mail%}</td>
			</tr>
			<tr>
				<td class="item">ホームページURL</td>
				<td>{%$app.orderinfo.regist_url%}</td>
			</tr>
			<tr>
				<td class="item">郵便番号</td>
				<td>{%$app.orderinfo.regist_zip1%}-{%$app.orderinfo.regist_zip2%}</td>
			</tr>
			<tr>
				<td class="item">都道府県</td>
				<td>{%$app.orderinfo.regist_pref%}</td>
			</tr>
			<tr>
				<td class="item">市区町村</td>
				<td>{%$app.orderinfo.regist_add1%}</td>
			</tr>
			<tr>
				<td class="item">丁番地</td>
				<td>{%$app.orderinfo.regist_add2%}</td>
			</tr>
			<tr>
				<td class="item">建物名</td>
				<td>{%$app.orderinfo.regist_add3%}</td>
			</tr>
			<tr>
				<td class="item">登録電話番号</td>
				<td>{%$app.orderinfo.regist_tel1%}-{%$app.orderinfo.regist_tel2%}-{%$app.orderinfo.regist_tel3%}</td>
			</tr>
			<tr>
				<td class="item">連絡先電話番号</td>
				<td>
					{%if $app.orderinfo.regist_contact_tel1 != ""%}
					{%$app.orderinfo.regist_contact_tel1%}-{%$app.orderinfo.regist_contact_tel2%}-{%$app.orderinfo.regist_contact_tel3%}
					{%/if%}
				</td>
			</tr>
			<tr>
				<td class="item">連絡先FAX番号</td>
				<td>
					{%if $app.orderinfo.regist_contact_fax1 != ""%}
					{%$app.orderinfo.regist_contact_fax1%}-{%$app.orderinfo.regist_contact_fax2%}-{%$app.orderinfo.regist_contact_fax3%}
					{%/if%}
				</td>
			</tr>
			</table><br />
		</td>
	</tr>

	<tr>
		<td>
		内容を確認したら「確定」ボタンをクリックして入力内容を確定してください。<br />
{%if $session.orderinfo.cust_kbn == "OR" || $session.orderinfo.cust_kbn == "YBP" %}
		ご購入のお客様（ユーザー登録のお客様）に「個人情報保護方針」についての承認確認メールを送信します。<br />
		ご承認後<span id="essential">「注文確定」</span>となります。<br />
{%/if%}
		内容に変更がございましたら、「戻る」ボタンで入力画面まで戻って変更してください。<br /><br />

		<span id="essential"><b>※確定後の追加・変更はできませんのでご注意ください。</b></span><br />
		午後3時までは「注文履歴」よりご注文削除が可能です。<br />
		確定後の内容につきましては、「注文履歴」画面にてご確認ください。<br /><br />
		<br /><br />
		</td>
	</tr>
</table>

<div id="next">
	<a href="javascript:history.back();"><img src="img/back.png" alt="戻る" width="120px" height="50px"></a>
	<a href="javascript:registration();"><img src="img/decision.png" alt="確定" width="120px" height="50px"></a>
</div>


{%include file="weborder/common/footer.tpl"%}

</div>
</center>
</body>
</html>

