<html>
<head>
<meta http-equiv="Content-Type"content="text/html;charset=utf-8">
<link rel="stylesheet"type="text/css"href="../css/common.css">
<title>注文確認書</title>
</head>
<body>
<center>
<div id="main">

<br />
<table border="1" cellspacing="0" frame="border" rules="none" width="600">
  <tr>
    <td nowrap align="center">
		<b>注　文　確　認　書</b>
		</td>
	</tr>
	<tr>
    <td nowrap align="right" bgcolor="white">
		受付No. <?php echo e($orderheader->web_order_num); ?><br />
		受付日：<?php echo e(substr($orderheader->dwo_last_update,0,4)); ?>年<?php echo e(substr($orderheader->dwo_last_update,5,2)); ?>月<?php echo e(substr($orderheader->dwo_last_update,8,2)); ?>日<br />
		</td>
	</tr>
	<tr>
		<td nowrap align="left" bgcolor="white">
			<?php echo e($agentView->name1 . $agentView->name2); ?>&nbsp;&nbsp;
			<?php if(!empty($orderheader->dwo_order_person_name) ): ?>
				<?php echo e($orderheader->dwo_order_person_name); ?>&nbsp;&nbsp;様
			<?php else: ?>
				御中
			<?php endif; ?>
			<br /><br />
		</td>
	</tr>
	<tr>
		<td>
			<table border="0">
				<tr>
					<td width="280px"></td>
			    <td>
					<table border="0">
						<tr>
							<td align="center">弥生株式会社　受注管理課</td>
						</tr>
						<tr>
							<td>&nbsp;〒101-0021</td>
						</tr>
							<td align="center">東京都千代田区外神田4丁目14番1号　秋葉原UDX21階</td>
						<tr>
							<td align="center">TEL:03-5207-8730　FAX:03-5207-8731</td>
						</tr>
					</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center">
		<br /><br /><b><u>合計金額￥<?php echo e(number_format($orderheader->total_amt)); ?></u></b><br /><br />
		</td>
	</tr>
</table>

<br /><br />

<table>
	<tr>
		<td align="center">
			<table width="600" border="1" cellspacing="0" cellpadding="2">
				<tr>
					<td class="item" align="center">貴社発注No.</td>
					<td class="item" align="center">商品コード</td>
					<td class="item" align="center">商品名称</td>
					<td class="item" align="center">数量</td>
					<td class="item" align="center">単価</td>
					<td class="item" align="center">金額</td>
					<td class="item" align="center">消費税率</td>
				</tr>

				<?php $__currentLoopData = $orderdetailList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detaillist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($detaillist->cust_order_num); ?>&nbsp;</td>
						<td align="center"><?php echo e($detaillist->item_cd); ?></td>
						<td align="center"><?php echo e($detaillist->item_name_kanji); ?><br>サポートプランアップグレード</td>
						<td align="center"><?php echo e(number_format($detaillist->item_vol)); ?></td>
						<td align="right"><?php echo e(number_format($detaillist->item_price)); ?></td>
						<td align="right"><?php echo e(number_format($detaillist->item_amt)); ?></td>
						<td align="right"><?php if(!empty($detaillist->tax_rate)): ?><?php echo e($detaillist->tax_rate * 100); ?><?php endif; ?></td>
					</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</table>
		</td>
	</tr>
	<tr>
		<td align="right">
			<table width="150" border="1" cellspacing="0" cellpadding="2">
				<tr>
					<td class="item" align="center">消費税</td>
					<td align="right">￥&nbsp;<?php echo e(number_format($orderheader->tax)); ?></td>
				</tr>
				<tr>
					<td class="item" nowrap align="center">合計</td>
					<td align="right">￥&nbsp;<?php echo e(number_format($orderheader->total_amt)); ?></td>
				</tr>
			</table><br />
		</td>
	</tr>
</table>

<table border="0" cellspacing="0" frame="border" rules="none" width="600">
	<tr>
		<td colspan="3">
			<?php echo $__env->make('weborder/common/tax_comment_offsite', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</td>
	</tr>
	<tr><td colspan="3" align="left">■備考■</td>
	</tr>
	<tr>
		<td colspan="3" align="left">
			&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo e($orderheader->deliver_memo); ?>

		</td>
	</tr>
	<tr><td>&nbsp;</td>
	</tr>
	
	<tr><td colspan="3" align="left">■お支払条件■</td>
	</tr>
	<tr>
		<td colspan="3" align="left">
			&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if($agentView->close_date1 == '99'): ?>末<?php else: ?><?php echo e($agentView->close_date1); ?>日<?php endif; ?>締
			&nbsp;&nbsp;
			<?php if($agentView->pay_cycle1 == '0'): ?>
				当月
			<?php elseif($agentView->pay_cycle1 == '1'): ?>
				翌月
			<?php elseif($agentView->pay_cycle1 == '2'): ?>
				翌々月
			<?php endif; ?>
			<?php if($agentView->pay_date1 == '99'): ?>末<?php else: ?><?php echo e($agentView->pay_date1); ?>日<?php endif; ?>お支払
		</td>
	</tr>
	<tr><td>&nbsp;</td>
	</tr>

</table>

<table border="0" cellspacing="0" frame="border" rules="none" width="600">
	<tr>
		<td align="center">毎度ありがとうございます。<br />ご注文確かに承りました。</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td align="center">
			<a href="javascript:window.close();"><img src="<?php echo e(asset('assets/cust/img/close.png')); ?>"></a>
		</td>
	</tr>
</table>

</div>
</center>
</body>
</html><?php /**PATH /var/www/dwo2/resources/views/weborder/order/upgradeprint.blade.php ENDPATH**/ ?>