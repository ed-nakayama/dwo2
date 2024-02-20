<html>
<head>
<meta http-equiv="Content-Type"content="text/html;charset=shift_jis">
<link rel="stylesheet"type="text/css"href="../css/common.css">
<title>webオーダー履歴</title>

<script type="text/javascript">
<!--
	function dtlSearch(o_num) {
		document.frmDtl.frm_order_num.value = o_num;
		document.frmDtl.submit();
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

<br /><table width="550px">
	<tr>
		<td>
		<h4>▼注文確認</h4>
		</td>
	</tr>
</table>

<form name="frmDtl" action="{%$script%}" method="post" style="margin:0px;">
	<input type="hidden" name="action_weborderTopHistorydetail" value="true">
	<input type="hidden" name="frm_order_num" value="">
</form>

<form name="frm" action="{%$script%}" method="post" style="margin:0px;">
	<input type="hidden" name="action_weborderTopHistorysearch" value="true">

<table border="0" width="500px">
	<tr>
		<td height="130px">
■ステータスについて■<br />
ステータスとは、現在の処理状況について説明しております。<br />
<br />
・承認待ち （「ご購入のお客様」のご承認待ち）　　&lt;ご注文の削除が可能です&gt;<br />
・受付中 （ご注文後、弊社営業日の15時までのステータス）　&lt;ご注文の削除が可能です&gt;<br />
		</td>
	</tr>
	<tr>
		<td class="search">
		▼検索条件
		</td>
	</tr>

{%if count($errors) > 0%}
	<tr>
		<td>
{%foreach from=$errors item=error%}
          <font color=red><li>{%$error%}</font></li>
{%/foreach%}
		</td>
	</tr>
{%/if%}

	<tr>
		<td align="center" height="200px">
			<br /><table class="new" border="1" cellspacing="0" frame="hsides" rules="rows">
				<tr>
					<td class="item">受付No.</td>
					<td>
						<input type="text" name="frm_web_order_num" value="{%$form.frm_web_order_num%}" maxlength="10" style="ime-mode: disabled;">
					</td>
				</tr>
				<tr>
					<td class="item">納品先形態</td>
					<td>
					&nbsp;<select name="frm_direct_delivery_type">
						<option class="gray" value="">選択して下さい</option>
						<option value="0" {%if $form.frm_direct_delivery_type == "0"%}selected{%/if%}>貴社</option>
						<option value="1" {%if $form.frm_direct_delivery_type == "1"%}selected{%/if%}>別途納品先</option>
					</td>
				</tr>
				<tr>
					<td class="item">別途納品先名称</td>
					<td>
						<input type="text" size="50" name="frm_dest_name1" value="{%$form.frm_dest_name1%}" maxlength="50">
					</td>
				</tr>
				<tr>
					<td class="item">貴社担当者</td>
					<td>
						<input type="text" name="frm_dwo_order_person_name" value="{%$form.frm_dwo_order_person_name%}" maxlength="100">
					</td>
				</tr>
				<tr>
					<td class="item">商品コード</td>
					<td><input type="text" name="frm_item_cd" value="{%$form.frm_item_cd%}" maxlength="15" style="ime-mode: disabled;"></td>
				</tr>
				<tr>
					<td class="item">
					ステータス
					</td>
					<td>
					&nbsp;<select name="frm_state_type">
						<option class="gray" value="">選択して下さい</option>

{%foreach from=$app.stList item=stlist %}
						<option value="{%$stlist.id%}" {%if $form.frm_state_type == $stlist.id%}selected{%/if%}>{%$stlist.nm%}</option>
{%/foreach %}
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center">
		<br /><a href="javascript:document.frm.submit();"><img src="../img/search.png" alt="検索" width="120px" height="50px"></a>
		</td>
	</tr>
</table>

</form>

<table border="0" cellspacing="0">
	<tr>
		<td colspan="2" height="100px">
		<span id="essential">※</span>
		納品先の検索は、納品先形態で貴社か貴社以外(別途納品先)に分けて行って下さい。<br />
		なお、別途納品先を指定した場合は、納品先名称のあいまい検索が可能です。<br />
		</td>
	</tr>
	<tr>
		<td class="search">
		▼検索結果
		</td>
		<td class="search" align="right">
		該当数&nbsp;{%$app.orderListCount%}
		</td>
	</tr>
	<tr>
		<td colspan="2" height="100px">
{%if $app.orderListCount <= 0%}
注文データが見つかりませんでした。
{%else%}
			<table border="1" cellspacing="0">
				<tr>
					<td class="item">受付No.</td>
					<td class="item">受付日</td>
					<td class="item" width="150px">納品先名称</td>
					<td class="item">貴社担当者</td>
					<td class="item">ステータス</td>
					<td class="item" align="center">詳細</td>
				</tr>
{%foreach from=$app.orderList item=orderlist %}
				<tr>
					<td>{%$orderlist.web_order_num%}</td>
					<td>{%$orderlist.dwo_last_update%}</td>
					<td align="center">{%$orderlist.dest_name1%}{%$orderlist.dest_name2%}</td>
					<td>{%$orderlist.dwo_order_person_name%}&nbsp;</td>
					<td align="center">{%$orderlist.state_type_str%}</td>
					<td>
						<input type="button" value="詳細" onClick="dtlSearch('{%$orderlist.web_order_num%}');">
					</td>
				</tr>
{%/foreach%}
			</table>
{%/if%}
		</td>
	</tr>
	<tr>
		<td align="center" colspan="2">
			<a href="?action_weborderTopHome=t"><img src="../img/back.png" alt="戻る" width="120px" height="50px"></a>
		</td>
	</tr>
</table>



{%include file="weborder/common/footer.tpl"%}

</div>
</center>
</body>
</html>
