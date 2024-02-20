<html>
<head>
<title>shoppingcart</title>
<link rel="stylesheet"type=" text/css" href="<?php echo e(asset('assets/cust/css/common.css')); ?>">
</head>
<body>
<?php if(!empty($basketList)): ?>
	<table border="0" cellspacing="0" width="100%">
	<tr>
		<td align="center">
		<table border="1" cellspacing="0" width="95%">
			<tr align="center">
				<td class="item" width="20%" nowrap>商品コード</td>
				<td class="item" width="50%">商品名称</td>
				<td class="item" width="10%" nowrap>数量</td>
				<td class="item" width="20%" nowrap>提供価格</td>
			</tr>

			<?php $__currentLoopData = $basketList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $basketlist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><?php echo e($basketlist['product_code']); ?></td>
				<td><?php echo e($basketlist['item_name_kanji']); ?></td>
				<td align="center"><?php echo e(number_format($basketlist['count'])); ?></td>
				<td align="right">\&nbsp;<?php echo e(number_format($basketlist['count'] * $basketlist['price_invoice_price'])); ?></td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

			<tr>
				<td class="item" colspan="3">合計(税抜)</td>
				<td align="right">\&nbsp;<?php echo e(number_format($basketSubTotal)); ?></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td align="right">（別途消費税）</td>
	</tr>
	</table>

<?php else: ?>
		<table border="0" cellspacing="0">
			<tr>
				<td>
買い物かごに，ご注文される商品が見つかりません。<br>
[商品選択]メニューをクリックし，ご注文される商品を<br>選択して下さい。
				</td>
			</tr>
		</table>

<?php endif; ?>

</body>
</html><?php /**PATH /var/www/dwo2/resources/views/weborder/common/shoppingcart.blade.php ENDPATH**/ ?>