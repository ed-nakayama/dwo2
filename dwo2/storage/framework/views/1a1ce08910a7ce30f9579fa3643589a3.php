<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\GuestLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

<title>お客様情報承認</title>

<script type="text/javascript">
 
// 自windowを閉じる
function winClose() {
  open('about:blank', '_self').close();    //一度再表示してからClose
}
 
</script>

<?php if($order_acceptance_flag == "1"): ?>
以下の注文はすでに承認済みです。このままウインドウを閉じてください。
<?php elseif($order_acceptance_flag == "2"): ?>
以下の注文はすでに否認済みです。このままウインドウを閉じてください。
<?php elseif($order_acceptance_flag == "3"): ?>
以下の注文はすでに期限切れです。このままウインドウを閉じてください。
<?php elseif($order_acceptance_flag == "99"): ?>
以下の注文はすでに削除されています。このままウインドウを閉じてください。
<?php endif; ?>

<br/><br/>
受付No.<?php echo e(session()->get('acceptance')['order_acceptance_header_no']); ?>




<table border=1>
	<tr>
		<td bgcolor="#8080c0">商品コード</td>
		<td bgcolor="#8080c0">商品名称</td>
		<td bgcolor="#8080c0">数量</td>
	</tr>
	<?php $__currentLoopData = session()->get('weborderdetailList'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detaillist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<tr>
			<td align="center"><?php echo e($detaillist['item_cd']); ?></td>
			<td><?php echo e($detaillist['item_name_kanji']); ?></td>
			<td align="center"><?php echo e($detaillist['item_vol']); ?></td>
		</tr>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>

<br/>
<?php echo e(html()->button('閉じる')->attribute('onClick', 'winClose();')); ?>


 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php /**PATH /var/www/dwo2/resources/views/weborder/recognize/already.blade.php ENDPATH**/ ?>