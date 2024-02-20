{%if TAX_MSG_FLAG == 1 %}
	<b>消費税について</b><br>
	{%if $session.orderinfo.upgrade_order == TRUE %}
		　あんしん保守サポートのアップグレードはお申込み日の翌月1日時点における法定税率にて課税させていただきます。<br>
		　詳しくは<a href="{%$smarty.const.UPGRADE_TAX_URL%}" target="_blank">こちら</a>をご参照ください。<br><br>
	{%else%}
		　サプライ用品、弥生製品（ソフトウェア）は商品出荷時における法定税率にて課税させていただきます。<br>
		{%if $session.agentAry.custGroup2 == '430' || $session.agentAry.custGroup2 == '436' || $session.agentAry.custGroup2 == '454' || $session.agentAry.custGroup2 == '458'  || $session.agentAry.custGroup2 == '460' || $session.agentAry.custGroup2 == '464' %}
			{%if $session.orderinfo.pap_order == TRUE %}
				　あんしん保守サポートは有償サポート開始日における法定税率にて課税させていただきます。<br>
				　ご購入のお客様（ユーザー登録のお客様）の「ご承認」が遅れた場合、ご注文入力時とは異なる税額でご請求する場合がございます。<br>
				　詳しくは<a href="{%$smarty.const.PRODUCT_TAX_URL%}" target="_blank">こちら</a>をご参照ください。<br>
			{%/if%}
		{%/if%}
		<br>
	{%/if%}
{%/if%}