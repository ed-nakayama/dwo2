<?php
	$today = date('Y/m/d');
?>
<?php if(config('dwo.MSG_START_DATE') <= $today && config('dwo.MSG_END_DATE') >= $today): ?>
	<b>消費税について</b><br>
		　商品出荷時における法定税率にて課税させていただきます。<br><br>
<?php endif; ?><?php /**PATH /var/www/dwo2/resources/views/weborder/common/tax10_comment.blade.php ENDPATH**/ ?>