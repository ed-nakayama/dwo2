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

<title>webオーダー履歴</title>

<script type="text/javascript">
<!--
-->
</script>

<?php echo e(html()->form('POST', '/top/history/mail/do')->attribute('name', 'frm')->open()); ?>

	<input type="hidden" name="chg_order_num" value="<?php echo e($chg_order_num); ?>">
	<input type="hidden" name="old_mail_addr" value="<?php echo e($old_mail_addr); ?>">
	<input type="hidden" name="new_mail_addr" value="<?php echo e($new_mail_addr); ?>">
<?php echo e(html()->form()->close()); ?>


<br /><table width="550px">
	<tr>
		<td>
		<h4>▼メールアドレス変更確認</h4>
		</td>
	</tr>
</table>

<table border="0" width="60%">
	<tr>
		<td align="left"><span id="essential">
		以下の内容でよろしければ「次へ」ボタンをクリックして下さい。<br /><br /></span>
		</td>
	<tr>
</table>

<table border="0" width="60%">
	<tr>
		<td nowrap>現在のメールアドレス：　<?php echo e($old_mail_addr); ?></td>
		<td>&nbsp;</td>
	<tr>
	<tr>
		<td nowrap>変更後のメールアドレス：　<?php echo e($new_mail_addr); ?></td>
		<td>&nbsp;</td>
	<tr>
</table>

<br /><a href="javascript:history.back();"><img src="<?php echo e(asset('assets/cust/img/back.png')); ?>" alt="戻る" width="120px" height="50px"></a>
　<a href="#" onClick="javascript:document.frm.submit();"><img src="<?php echo e(asset('assets/cust/img/next.png')); ?>" alt="次へ" width="120px" height="50px"></a>

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
<?php /**PATH /var/www/dwo2/resources/views/weborder/top/historymailconfirm.blade.php ENDPATH**/ ?>