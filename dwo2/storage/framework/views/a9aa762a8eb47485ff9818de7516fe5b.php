<html>
<head>
<meta http-equiv="Content-Type"content="text/html;charset=utf-8">
<title>お取引条件</title>
<link rel="stylesheet"type=" text/css" href="<?php echo e(asset('assets/cust/css/common.css')); ?>">
</head>
<body>
<table border="0">
	<tr>
		<td colspan="2">
		<p class="sidebar">お取引条件</p></td>
	</tr>
	<tr>
		<td colspan="2"><p>
		ご利用ありがとうございます。<br />
		<?php if(!empty($lastupdate)): ?>
			前回のご利用日時は <?php echo e(substr( $lastupdate ,0,4)); ?>年
								<?php echo e(substr( $lastupdate ,5,2)); ?>月
								<?php echo e(substr( $lastupdate ,8,2)); ?>日
								<?php echo e(substr( $lastupdate ,11,2)); ?>時
								<?php echo e(substr( $lastupdate ,14,2)); ?>分 です。
		<?php else: ?>
			<br>
		<?php endif; ?>
		</p></td>
	</tr>
	<tr>
		<td colspan="2" height="60px">
			<table class="select" border="1"cellspacing="0"frame="hsides"rules="rows">
				<tr>
					<td class="item">締め日</td>
					<td width="80px">毎月
						<?php if(session('agentView')->close_date1 == '99'): ?>末<?php else: ?><?php echo e(session('agentView')->close_date1); ?>日<?php endif; ?>締
					</td>
					<td class="item">お支払期日</td>
					<td width="115px">
						<?php if(session('agentView')->pay_cycle1 == '0'): ?>
							当月
						<?php elseif(session('agentView')->pay_cycle1 == '1'): ?>
							翌月
						<?php elseif(session('agentView')->pay_cycle1 == '2'): ?>
							翌々月
						<?php endif; ?>
						<?php if(session('agentView')->pay_date1 == "99"): ?>末<?php else: ?><?php echo e(session('agentView')->pay_date1); ?>日<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td class="item">お取引残高</td>
					<td></td>
					<td></td>
					<td width="80px">
						\&nbsp;
						<?php if(config('dwo.CREDIT_LIMIT_ERROR_FLG') == -1): ?>
							--
						<?php else: ?>
							<?php echo e(number_format($creditinfo->zan)); ?>

						<?php endif; ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html><?php /**PATH /var/www/dwo2/resources/views/weborder/top/condition.blade.php ENDPATH**/ ?>