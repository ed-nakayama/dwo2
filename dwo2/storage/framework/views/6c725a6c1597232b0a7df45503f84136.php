<?php
	$today = date('Y/m/d');
?>
<?php if(config('dwo.MSG_START_DATE') <= $today && config('dwo.MSG_END_DATE') >= $today): ?>
消費税について
　商品出荷時における法定税率にて課税させていただきます。
<?php endif; ?><?php /**PATH /var/www/dwo2/resources/views/weborder/common/tax10_comment_mail.blade.php ENDPATH**/ ?>