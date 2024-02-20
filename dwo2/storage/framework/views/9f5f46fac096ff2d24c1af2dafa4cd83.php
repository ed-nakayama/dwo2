<?php if (isset($component)) { $__componentOriginal9a0980f954f010cbb20c85c4e38c1c9e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a0980f954f010cbb20c85c4e38c1c9e = $attributes; } ?>
<?php $component = App\View\Components\AdminNormalLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('admin_normal-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AdminNormalLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           商品検索
        </h2>
     <?php $__env->endSlot(); ?>



<script type="text/javascript">
<!--
	function setParent(p_num ,p_code ,p_name ,p_price) {
		window.opener.setProd(p_num ,p_code ,p_name ,p_price);
		window.close();
	}
-->
</script>
<h5>商品検索</h5>
<?php echo e($custNum); ?>　<?php echo e($agentView->name1 . $agentView->name2); ?><br>

<table border="0" cellpadding="0" cellspacing="2">
	<tr>
		<td>
			<p class="sidebar">検索条件</p>
		</td>
	<tr>
</table>
<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<li style="list-style:none; color:red;"><?php echo e($error); ?></li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php echo e(html()->form('GET', '/admin/order/list2/search/prod')->attributes(['name' => 'frm', 'style' => 'margin:0px;'])->open()); ?>


<table border=1 cellpadding=2 cellspacing=0>
	<tr>
		<td class="item">商品コード</td>
		<td class="item">検索</td>
	</tr>
	<tr>
		<td>
			<?php echo e(html()->hidden('num', $num)); ?>

			<?php echo e(html()->hidden('custNum', $custNum)); ?>

			<?php echo e(html()->text('prodCode', $prodCode)->attribute('size', '20')); ?>

		</td>
		<td>
			<input type="submit" value="検索">
		</td>
	</tr>
</table>

<?php echo e(html()->form()->close()); ?>


<br>

<table border="0" cellpadding="0" cellspacing="2">
	<tr>
		<td>
			<p class="sidebar">検索結果</p>
		</td>
	<tr>
</table>

<?php if(!empty($prodList) ): ?>
<table border=1 cellpadding=2 cellspacing=0 width="90%">
	<tr>
		<td class="item">商品コード</td>
		<td class="item">商品名</td>
		<td class="item">定価</td>
		<td class="item">仕切り率(%)</td>
		<td class="item">提供価格</td>
		<td class="item" width="10%">&nbsp;</td>
	</tr>
<?php $__currentLoopData = $prodList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<tr>
		<td style="word-break: break-all;"><?php echo e($list->product_code); ?></td>
		<td style="word-break: break-all;"><?php echo e($list->item_name_kanji); ?></td>
		<td style="word-break: break-all;" align="right"><?php echo e(number_format($list->sales_price)); ?></td>
		<td style="word-break: break-all;" align="right"><?php echo e($list->discount_rate); ?></td>
		<td style="word-break: break-all;" align="right"><?php echo e(number_format($list->price_invoice_price)); ?></td>
		<td style="word-break: break-all;" align="center">
			<input type="button" value="設定" onClick="setParent('<?php echo e($num); ?>','<?php echo e($list->product_code); ?>','<?php echo e($list->item_name_kanji); ?>','<?php echo e($list->price_invoice_price); ?>');">
		</td>
	</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
<?php else: ?>
該当するデータは見つかりませんでした。
<?php endif; ?>



 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9a0980f954f010cbb20c85c4e38c1c9e)): ?>
<?php $attributes = $__attributesOriginal9a0980f954f010cbb20c85c4e38c1c9e; ?>
<?php unset($__attributesOriginal9a0980f954f010cbb20c85c4e38c1c9e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9a0980f954f010cbb20c85c4e38c1c9e)): ?>
<?php $component = $__componentOriginal9a0980f954f010cbb20c85c4e38c1c9e; ?>
<?php unset($__componentOriginal9a0980f954f010cbb20c85c4e38c1c9e); ?>
<?php endif; ?>
<?php /**PATH /var/www/dwo2/resources/views/admin/order/searchProd.blade.php ENDPATH**/ ?>