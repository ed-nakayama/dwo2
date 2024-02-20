<?php if(config('dwo.TAX_MSG_FLAG') == '1'  && !empty($rderheader->careful_flag) ): ?>
	<b>消費税について</b><br>
	<?php if($orderheader->contents_type == '54' || $orderheader->contents_type == '55'): ?>
		　あんしん保守サポートのアップグレードはお申込み日の翌月1日時点における法定税率にて課税させていただきます。<br>
		　詳しくは<a href="{%$smarty.const.UPGRADE_TAX_URL%}" target="_blank">こちら</a>をご参照ください。<br><br>
	<?php else: ?>
		　サプライ用品、弥生製品（ソフトウェア）は商品出荷時における法定税率にて課税させていただきます。<br>
		<?php if($orderheader->careful_flag == '1'): ?>
			<?php if($orderheader->contents_type == '80' || $orderheader->contents_type == '82'): ?>
				　あんしん保守サポートは有償サポート開始日における法定税率にて課税させていただきます。<br>
				　ご購入のお客様（ユーザー登録のお客様）の「ご承認」が遅れた場合、上記とは異なる税額でご請求する場合がございます。<br>
				　詳しくは<a href="<?php echo e(config('dwo.PRODUCT_TAX_URL')); ?>" target="_blank">こちら</a>をご参照ください。<br>
			<?php endif; ?>
		<?php endif; ?>
		<br>
	<?php endif; ?>
<?php endif; ?><?php /**PATH /var/www/dwo2/resources/views/weborder/common/tax_comment_offsite.blade.php ENDPATH**/ ?>