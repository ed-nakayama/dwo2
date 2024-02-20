{if TAX_MSG_FLAG == 1 && $weborderheader.careful_flag != "" }
消費税について
{if $weborderheader.contents_type == "54" || $weborderheader.contents_type == "55" }
　あんしん保守サポートのアップグレードはお申込み日の翌月1日時点における法定税率にて課税させていただきます。
　詳しくは {$smarty.const.UPGRADE_TAX_URL} をご参照ください。
{else}
　サプライ用品、弥生製品（ソフトウェア）は商品出荷時における法定税率にて課税させていただきます。
{if $weborderheader.careful_flag == 1 }
{if $weborderheader.contents_type == "80" || $weborderheader.contents_type == "82" }
　あんしん保守サポートは有償サポート開始日における法定税率にて課税させていただきます。
　ご購入のお客様（ユーザー登録のお客様）の「ご承認」が遅れた場合、上記とは異なる税額でご請求する場合がございます。
　詳しくは {$smarty.const.PRODUCT_TAX_URL} をご参照ください。
{/if}
{/if}
{/if}
{/if}