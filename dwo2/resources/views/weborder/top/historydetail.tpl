<html>
<head>
<meta http-equiv="Content-Type"content="text/html;charset=shift_jis">
<link rel="stylesheet"type="text/css"href="../css/common.css">
<title>webオーダー履歴</title>

<script type="text/javascript">
<!--
	function printPreview() {
		document.frmPrt.submit();
	}
	function delSubmit() {
		if (window.confirm("この注文を削除してもよろしいですか？")) {
			document.frm.submit();
		}
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
		<td>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td>
					<p class="sidebar">お知らせ</p>
				</td>
			<tr>
		</table>
		<iframe src="?action_weborderCommonInformation=t" width="360px" height="100px" frameborder="0">
		</iframe>
		</td>
	</tr>
</table>
</div>

<form name="frmPrt" action="{%$script%}" method="post" style="margin:0px;" target="_blank">
	<input type="hidden" name="action_weborderOrderPrintview" value="true">
	<input type="hidden" name="print_order_num" value="{%$app.orderheader.web_order_num%}">
</form>

<form name="frm" action="{%$script%}" method="post" style="margin:0px;">
	<input type="hidden" name="action_weborderTopHistorydeleteDo" value="true">
	<input type="hidden" name="del_order_num" value="{%$app.orderheader.web_order_num%}">
</form>

<form name="frmMailChg" action="{%$script%}" method="post" style="margin:0px;">
	<input type="hidden" name="action_weborderTopHistorymailchg" value="true">
	<input type="hidden" name="chg_order_num" value="{%$app.orderheader.web_order_num%}">
	<input type="hidden" name="old_mail_addr" value="{%$app.orderheader.mail_address%}">
</form>

<br /><table width="550px">
	<tr>
		<td>
		<h4>▼注文確認 詳細</h4>
		</td>
	</tr>
</table>

{%if count($errors) <= 0%}

<table border="0">
{%if $app.orderheader.delete_ok == 1%}
	<tr>
		<td width="60px"></td>
		<td align="left">
		<span id="essential">※</span>「削除」をクリックすると、ご注文がキャンセルされます。<br />
		</td>
	<tr>
{%/if%}
	<tr>
		<td align="center" colspan="2">
		<br /><table class="select" border="1" cellspacing="0" frame="hsides" rules="rows">
			<tr>
				<td class="item" width="150px">
				現在のステータス</td>
				<td width="250px">{%$app.orderheader.state_type_str%}</td>
			</tr>
			<tr>
				<td class="item">受付No.</td>
				<td>{%$app.orderheader.web_order_num%}</td>
			</tr>
			<tr>
				<td class="item">受付日</td>
				<td>{%$app.orderheader.dwo_last_update%}</td>
			</tr>
			<tr>
				<td class="item">出荷日</td>
				<td>
{%if $app.orderheader.shipping_date != ""%}
{%$app.orderheader.shipping_date|date_format:"%Y"%}-{%$app.orderheader.shipping_date|date_format:"%m"%}-{%$app.orderheader.shipping_date|date_format:"%d"%}
{%else%}
&nbsp;
{%/if%}
</td>
			</tr>
			<tr>
				<td class="item">貴社発注担当者</td>
				<td>{%$app.orderheader.dwo_order_person_name%}</td>
			</tr>
			<tr>
				<td class="item">サプライ二重梱包</td>
				<td>{%if $app.orderheader.double_package_type == "1" %}有{%else%}無{%/if%}</td>
			</tr>
			<tr>
				<td class="item">納品先 名称</td>
				<td>{%$app.orderheader.dest_name1%}{%$app.orderheader.dest_name2%}</td>
			</tr>
			<tr>
				<td class="item">納品先 郵便番号</td>
				<td>{%$app.orderheader.dest_post%}</td>
			<tr>
				<td class="item">納品先 住所1</td>
				<td>
{%foreach from=$app.kenList item=klist%}
{%if $klist.code == $app.orderheader.dest_pref_cd %}{%$klist.name%}{%/if%}
{%/foreach%}
{%$app.orderheader.dest_address1%}{%$app.orderheader.dest_address2%}
				</td>
			</tr>
			<tr>
				<td class="item">納品先 住所2</td>
				<td>{%$app.orderheader.dest_address3%}</td>
			</tr>
			<tr>
				<td class="item">納品先 担当者</td>
				<td>{%$app.orderheader.dest_contact_name1%}</td>
			</tr>
			<tr>
				<td class="item">納品先電話番号</td>
				<td>{%$app.orderheader.dest_tel%}</td>
			</tr>
			<tr>
				<td class="item">納品先FAX番号</td>
				<td>{%$app.orderheader.dest_fax%}</td>
			<tr>
				<td class="item">伝票添付</td>
				<td>{%if $app.orderheader.direct_delivery_type == "1" %}無{%else%}有{%/if%}</td>
			</tr>
			<tr>
				<td class="item">備考</td>
				<td>{%$app.orderheader.deliver_memo%}</td>
			</tr>
		</table>
		</td>
	</tr>

	<tr>
		<td colspan="2">
		<br /><table width="700px" border="1" cellspacing="0">
			<tr>
				<td class="item">貴社発注No.</td>
				<td class="item">商品コード</td>
				<td class="item">商品名称</td>
				<td class="item">提供価格</td>
				<td class="item">数量</td>
				<td class="item">金額</td>
			</tr>
{%foreach from=$app.orderdetailList item=detaillist %}
			<tr>
				<td>{%$detaillist.cust_order_num%}&nbsp;</td>
				<td>{%$detaillist.item_cd%}</td>
				<td>{%$detaillist.item_name_kanji%}</td>
				<td align="right">\&nbsp;{%$detaillist.item_price|number_format%}</td>
				<td width="30px" align="right">{%$detaillist.item_vol|number_format%}</td>
				<td align="right">\&nbsp;{%$detaillist.item_amt|number_format%}</td>
			</tr>
{%/foreach%}
		</table>
		</td>
	</tr>
	<tr>
		<td align="right" colspan="2">
		<table border="1" cellspacing="0">
			<tr>
				<td class="item" width="65px">合計</td>
				<td align="right">\&nbsp;{%$app.orderheader.total_amt|number_format%}</td>
			</tr>
		</table>
		</td>
	</tr>
</table>

<table border="0" width="95%">
	<tr>
		<td width="30%">&nbsp;</td>
		<td width="40%" align="center">
				<a href="javascript:printPreview();"><img src="../img/print.png" alt="注文書印刷" width="120px" height="50px"></a>
		</td>
		<td width="30%" align="right">
{%if $app.orderheader.delete_ok == 1%}
				<a href="javascript:delSubmit();"><img src="../img/delete.png" alt="削除" width="120px" height="50px"></a>
{%else%}
				&nbsp;
{%/if%}
		</td>
	</tr>
</table>

{%* お客様情報が登録されている場合のみ表示 *%}
{%if $app.orderheader.name1 != "" %}
<table border="0">
	<tr>
		<td>
			<br /><br /><table class="select" width="400px" border="1" cellspacing="0" frame="hsides" rules="rows">
				<tr>
					<td class="item" width="200px">登録名義</td>
					<td>{%$app.orderheader.name1%}{%$app.orderheader.name2%}</td>
				</tr>
				<tr>
					<td class="item">登録名義(フリガナ)</td>
					<td>{%$app.orderheader.name_kana1%}</td>
				</tr>
				<tr>
					<td class="item">代表取締役または代表者</td>
					<td>{%$app.orderheader.president_name1%}</td>
				</tr>
				<tr>
					<td class="item">代表取締役または代表者(フリガナ)</td>
					<td>{%$app.orderheader.president_name_kana1%}</td>
				</tr>
				<tr>
					<td class="item">担当者</td>
					<td>{%$app.orderheader.contact_name1%}</td>
				</tr>
				<tr>
					<td class="item">担当者(フリガナ)</td>
					<td>{%$app.orderheader.contact_name_kana1%}</td>
				</tr>
				<tr>
{%if $app.orderheader.state_type == "4"%}
					<td class="item">メールアドレス　　<input type="button" value="変更" style="font-size:10px;" onClick="document.frmMailChg.submit();"></td>
{%else%}
					<td class="item">メールアドレス</td>
{%/if%}
					<td>{%$app.orderheader.mail_address%}</td>
				</tr>
				<tr>
					<td class="item">ホームページURL</td>
					<td>{%$app.orderheader.url%}</td>
				</tr>
				<tr>
					<td class="item">郵便番号</td>
					<td>{%$app.orderheader.post%}</td>
				</tr>
				<tr>
					<td class="item">都道府県市区町村</td>
					<td>
{%foreach from=$app.kenList item=klist%}
{%if $klist.code == $app.orderheader.prefecture_cd %}{%$klist.name%}{%/if%}
{%/foreach%}
{%$app.orderheader.address1%}
					</td>
				</tr>
				<tr>
					<td class="item">丁番地</td>
					<td>{%$app.orderheader.address2%}</td>
				</tr>
				<tr>
					<td class="item">建物名</td>
					<td>{%$app.orderheader.address3%}</td>
				</tr>
				<tr>
					<td class="item">登録電話番号</td>
					<td>{%$app.orderheader.tel%}</td>
				</tr>
				<tr>
					<td class="item">連絡先電話番号</td>
					<td>{%$app.orderheader.communicate_tel%}</td>
				</tr>
				<tr>
					<td class="item">連絡先FAX番号</td>
					<td>{%$app.orderheader.fax%}</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
{%/if%}

{%else%}
<table border="0">
	<tr>
		<td>
{%foreach from=$errors item=error%}
          <font color=red><li>{%$error%}</font></li>
{%/foreach%}
		</td>
	</tr>
</table>
{%/if%}


<br /><a href="javascript:history.back();"><img src="../img/back.png" alt="戻る" width="120px" height="50px"></a>

{%include file="weborder/common/footer.tpl"%}
</div>
</center>
</body>
</html>
