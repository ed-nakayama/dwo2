<?php $__env->startSection('content'); ?>

<center>
<div id="main">

<?php $__currentLoopData = $orderHeaderList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderheader): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($loop->index > 0): ?>
	<div style="page-break-after: always"></div>
<?php endif; ?>

<table style="width:100%;">
	<tr>
		<td nowrap align="center" style="font-size:20px;font-weight:bold;">
			<b>注　文　確　認　書</b>
		</td>
	</tr>
	<tr>
		<td nowrap align="right">
			受付No. <?php echo e($orderheader->web_order_num); ?><br />
			受付日：<?php echo e(substr($orderheader->dwo_last_update,0,4)); ?>年<?php echo e(substr($orderheader->dwo_last_update,5,2)); ?>月<?php echo e(substr($orderheader->dwo_last_update,8,2)); ?>日<br />
		</td>
	</tr>
	<tr>
		<td nowrap>
			<?php echo e($orderheader->name1 .  $orderheader->name2); ?>&nbsp;&nbsp;
			<?php if(!empty($orderheader->dwo_order_person_name) ): ?>
				<?php echo e($orderheader->dwo_order_person_name); ?>&nbsp;&nbsp;様
			<?php else: ?>
				御中
			<?php endif; ?>
		</td>
	</tr>
	<tr>
		<td>
			<table style="margin: 0 0 0 auto;">
				<tr>
					<td>
						<table class="tbl-bill">
						<tr>
							<td nowrap align="center"><?php echo e(config('dwo.DWO_COMP_NAME')); ?>　<?php echo e(config('dwo.DWO_UNIT_NAME')); ?></td>
						</tr>
						<tr>
							<td nowrap>&nbsp;〒<?php echo e(config('dwo.DWO_ZIP')); ?></td>
						</tr>
						<tr>
							<td nowrap><?php echo e(config('dwo.DWO_ADDRESS')); ?></td>
						</tr>
						<tr>
							<td nowrap align="center">TEL:<?php echo e(config('dwo.DWO_TEL')); ?>　FAX:<?php echo e(config('dwo.DWO_FAX')); ?></td>
						</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center">
			<br /><b><u>合計金額￥<?php echo e(number_format($orderheader->total_amt)); ?></u></b>
		</td>
	</tr>
</table>
<br />

<table style="width:100%;">
	<tr>
		<td align="center">
			<table class="tbl-billdt">
    			<tr>
					<th>貴社発注No.</th>
					<th>商品コード</th>
					<th>商品名称</th>
					<th>数量</th>
					<th>単価</th>
					<th>金額</th>
					<th>消費税</th>
					<th>消費税率</th>
				</tr>

				<?php $__currentLoopData = $orderheader->orderDetailList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detaillist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td align="center"><?php echo e($detaillist->order_line_num); ?></td>
					<td align="center"><?php echo e($detaillist->item_cd); ?></td>
					<td><?php echo e($detaillist->item_name_kanji); ?></td>
					<td align="right"><?php echo e(number_format($detaillist->item_vol)); ?></td>
					<td align="right"><?php echo e(number_format($detaillist->item_price)); ?></td>
					<td align="right"><?php echo e(number_format($detaillist->item_amt)); ?></td>
					<td align="right"><?php echo e(number_format($detaillist->tax)); ?></td>
					<td align="right"><?php if(!empty($detaillist->tax_rate)): ?><?php echo e($detaillist->tax_rate * 100); ?><?php endif; ?>％</td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table class="tbl-billtotal">
				<tr>
					<th>税抜額</th>
					<td align="right">￥&nbsp;<?php echo e(number_format($orderheader->order_amt)); ?></td>
				</tr>
				<tr>
					<th>消費税</th>
					<td align="right">￥&nbsp;<?php echo e(number_format($orderheader->tax)); ?></td>
				</tr>
				<tr>
					<th>合計</th>
					<td align="right">￥&nbsp;<?php echo e(number_format($orderheader->total_amt)); ?></td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<table class="tbl-bill-else">
	<tr>
		<td colspan="3">
<?php echo $__env->make('weborder/common/tax10_comment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</td>
	</tr>

	<tr>
		<th>■納品先■</th>
	</tr>
	<tr>
		<td>
			<?php echo e($orderheader->dest_name1); ?><?php echo e($orderheader->dest_name2); ?>

			&nbsp;<?php echo e($orderheader->dest_contact_name1); ?>

			&nbsp;様
		</td>
	</tr>
	<tr>
		<td>
			〒<?php echo e($orderheader->dest_post); ?>　
			<?php $__currentLoopData = $prefList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $klist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if($klist->pref_cd == $orderheader->dest_pref_cd): ?><?php echo e($klist->pref_name); ?> <?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php echo e($orderheader->dest_address1); ?><?php echo e($orderheader->dest_address2); ?><?php echo e($orderheader->dest_address3); ?>

		</td>
	</tr>
	<tr>
		<td style="padding-bottom:10px;">
			TEL：<?php echo e($orderheader->dest_tel); ?>

		</td>
	</tr>

<?php if($orderheader->contents_type == '40'): ?>
	<tr>
		<th>■出荷予定日■</th>
	</tr>
<?php else: ?>
	<tr>
		<th>■出荷予定日（即日お客様にご承諾いただいた場合）■</th>
	</tr>
<?php endif; ?>
	<tr>
		<td style="padding-bottom:10px;">
			<?php if(!empty($orderheader->shipping_date)): ?>
				<?php echo e(substr($orderheader->shipping_date,0,4)); ?>年
				<?php echo e(substr($orderheader->shipping_date,4,2)); ?>月
				<?php echo e(substr($orderheader->shipping_date,6,2)); ?>日
			<?php endif; ?>
		</td>
	</tr>

	<tr>
		<th>■サプライ二重梱包■</th>
	</tr>
	<tr>
		<td style="padding-bottom:10px;">
			<?php if($orderheader->double_package_type == '1'): ?>有<?php else: ?>無<?php endif; ?>
		</td>
	</tr>

	<tr>
		<th>■伝票添付■</th>
	</tr>
	<tr>
		<td style="padding-bottom:10px;">
			<?php if($orderheader->direct_delivery_type == '1'): ?>無<?php else: ?>有<?php endif; ?>
		</td>
	</tr>

	<tr>
		<th>■備考■</th>
	</tr>
	<tr>
		<td style="padding-bottom:10px;">
			<?php echo e($orderheader->deliver_memo); ?>

		</td>
	</tr>

	<tr>
		<th>■運賃■</th>
	</tr>
	<tr>
		<td style="padding-bottom:10px;">
			当社負担
		</td>
	</tr>

	<tr>
		<th>■お支払条件■</th>
	</tr>
	<tr>
		<td style="padding-bottom:10px;">
			<?php if($orderheader->close_date1 == '99'): ?>末<?php else: ?><?php echo e($orderheader->close_date1); ?>日<?php endif; ?>締
			&nbsp;&nbsp;
			<?php if($orderheader->pay_cycle1 == '0'): ?>
				当月
			<?php elseif($orderheader->pay_cycle1 == '1'): ?>
				翌月
			<?php elseif($orderheader->pay_cycle1 == '2'): ?>
				翌々月
			<?php endif; ?>
			<?php if($orderheader->pay_date1 == '99'): ?>末<?php else: ?><?php echo e($orderheader->pay_date1); ?>日<?php endif; ?>お支払
		</td>
	</tr>
</table>

<table style="width:100%;">
	<tr><td align="center">毎度ありがとうございます。<br />ご注文確かに承りました。</td></tr>
</table>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
</center>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.pdf', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/dwo2/resources/views/pdf_templates/pdf_bill.blade.php ENDPATH**/ ?>