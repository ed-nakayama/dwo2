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

<title>納品先選択</title>


<script type="text/javascript">
<!--
	function viewDeliveryDetail(seq_num) {
		document.frmSeq.frm_delivery_seq.value = seq_num;
		document.frmSeq.submit();
	}
-->
</script>

<table width="550px">
	<tr>
		<td>
		<h4 class="select">▼納品先選択</h4>
		</td>
	</tr>
</table>

<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<li style="list-style:none; color:red;"><?php echo e($error); ?></li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php echo e(html()->form('POST', '/top/delivery/detail')->attribute('name', 'frmSeq')->style('margin:0px;')->open()); ?>

<?php echo e(html()->hidden('frm_delivery_seq', '')); ?>

<?php echo e(html()->form()->close()); ?>


<?php echo e(html()->form('POST', '/top/delivery')->attribute('name', 'frm')->style('margin:0px;')->open()); ?>


<table border="0" width="500px">
		<td class="search">
		▼検索条件
		</td>
	</tr>
	<tr>
		<td align="center">
			<br /><table class="new" border="1" cellspacing="0" frame="hsides" rules="rows">
				<tr>
					<td class="item">納品先コード</td>
					<td>
						<?php echo e(html()->text('frm_delivery_seq', $frm_delivery_seq)->attribute('maxlength', '10')); ?>

					</td>
				</tr>
				<tr>
					<td class="item">納品先名称</td>
					<td>
						<?php echo e(html()->text('frm_delivery_name', $frm_delivery_name)->attributes(['size' => '50', 'maxlength' => '50'])); ?>

					</td>
				</tr>
				<tr>
					<td class="item">電話番号</td>
					<td>
						<?php echo e(html()->text('frm_delivery_tel', $frm_delivery_tel)->attribute('maxlength', '13')); ?>

					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center"><br />
			<a href="javascript:document.frm.submit();"><img src="<?php echo e(asset('assets/cust/img/search.png')); ?>" alt="検索" width="120px" height="50px"></a>
		</td>
	</tr>
</table>
<?php echo e(html()->form()->close()); ?>


<br>
<table border="0" cellspacing="0">
	<tr>
		<td class="search">
		▼検索結果
		</td>
		<td class="search" align="right">
		該当数&nbsp;<?php echo e($OtherListCount); ?>

		</td>
	</tr>
<?php if($OtherListCount > 0): ?>
	<tr>
		<td colspan="2" height="100px">
		<table border="1" cellspacing="0">
				<tr>
					<td class="item" align="center">納品先コード</td>
					<td class="item" width="200px">納品先名称</td>
					<td class="item" width="70px" align="center">電話番号</td>
					<td class="item" width="85px" align="center">担当者</td>
					<td class="item" align="center">詳細</td>
				</tr>
				<?php $__currentLoopData = $OtherList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $otherlist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($otherlist->delivery_seq); ?></td>
					<td><?php echo e($otherlist->delivery_name); ?></td>
					<td align="center"><?php echo e($otherlist->delivery_tel); ?></td>
					<td align="center">&nbsp;<?php echo e($otherlist->delivery_name_of_charge); ?></td>
					<td>
						<?php echo e(html()->submit('詳細')->attribute('onClick', "viewDeliveryDetail($otherlist->delivery_seq);")); ?>

					</td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</table>
		</td>
	</tr>
<?php else: ?>
	<tr>
		<td colspan="2" height="100px" width="490px">
			該当納品先はありません。<br><br>
		</td>
	</tr>
<?php endif; ?>
	<tr>
		<td align="center" colspan="2">
			<br>
			<a href="javascript:window.close();"><img src="<?php echo e(asset('assets/cust/img/close.png')); ?>"></a>
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
<?php /**PATH /var/www/dwo2/resources/views/weborder/top/deliveryselect.blade.php ENDPATH**/ ?>