<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

<title>納品先削除</title>

<script type="text/javascript">
<!--
	function DeliveryDelSubmit() {
		if (window.confirm("この納品先を削除してもよろしいですか？")) {
			document.frm.submit();
		}
	}
-->
</script>

<table width="550px">
	<tr>
		<td>
		<h4 class="select">▼納品先削除</h4>
		</td>
	</tr>
</table>

<?php if(!empty($deliveryData)): ?>
<?php echo e(html()->form('POST', '/top/delivery/delete')->attribute('name', 'frm')->style('margin:0px;')->open()); ?>

<?php echo e(html()->hidden('del_delivery_seq', $deliveryData->delivery_seq)); ?>

<?php echo e(html()->form()->close()); ?>

<?php endif; ?>

<table width="450px">
	<tr>
		<td class="search">
		▼納品先確認
		</td>
	</tr>
	<tr>
		<td align="center">
			<?php if(!empty($deliveryData)): ?>
			<br /><table class="select" border="1" cellspacing="0" frame="hsides" rules="rows">
				<tr>
					<td class="item">納品先コード</td>
					<td><?php echo e($deliveryData->delivery_cust_code); ?></td>
				</tr>
				<tr>
					<td class="item">納品先名称</td>
					<td><?php echo e($deliveryData->delivery_name); ?></td>
				</tr>
				<tr>
					<td class="item">納品先担当者</td>
					<td><?php echo e($deliveryData->delivery_name_of_charge); ?></td>
				</tr>
				<tr>
					<td class="item">納品先郵便番号</td>
					<td><?php echo e($deliveryData->delivery_zip); ?></td>
				</tr>
				<tr>
					<td class="item">納品先住所(都道府県/市区町村)</td>
					<td width="200px"><?php echo e($deliveryData->pref_view . $deliveryData->delivery_add1); ?></td>
				</tr>
				<tr>
					<td class="item">納品先住所(番地)</td>
					<td width="200px"><?php echo e($deliveryData->delivery_add2); ?></td>
				</tr>
				<tr>
					<td class="item">納品先住所(ビル･マンション)</td>
					<td><?php echo e($deliveryData->delivery_add3); ?></td>
				</tr>
				<tr>
					<td class="item">納品先電話番号</td>
					<td><?php echo e($deliveryData->delivery_tel); ?></td>
				</tr>
				<tr>
					<td class="item">納品先FAX番号</td>
					<td><?php echo e($deliveryData->delivery_fax); ?></td>
				</tr>
			</table>
			<?php endif; ?>
		</td>
	</tr>
	<tr>
		<td align="center">
			<div id="next">
				<a href="javascript:history.back();"><img src="<?php echo e(asset('assets/cust/img/back.png')); ?>" alt="戻る" width="120px" height="50px"></a>
				<a href="javascript:DeliveryDelSubmit();"><img src="<?php echo e(asset('assets/cust/img/delete.png')); ?>" alt="削除" width="120px" height="50px"></a>
			</div>
		</td>
	</tr>
</table>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /var/www/dwo2/resources/views/weborder/top/deliverydetail.blade.php ENDPATH**/ ?>