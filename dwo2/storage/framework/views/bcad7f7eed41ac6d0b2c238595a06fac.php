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


<?php echo e(html()->form('POST', '/top/history/mail/confirm')->attribute('name', 'frm')->open()); ?>

	<input type="hidden" name="chg_order_num" value="<?php echo e($chg_order_num); ?>">
	<input type="hidden" name="old_mail_addr" value="<?php echo e($old_mail_addr); ?>">

<br /><table width="550px">
	<tr>
		<td>
		<h4>▼メールアドレス変更</h4>
		</td>
	</tr>
</table>

<?php $__errorArgs = ['chg_order_num'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
	<li style="list-style:none; color:red;"><?php echo e($message); ?></li>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
<?php $__errorArgs = ['new_mail_addr'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
	<li style="list-style:none; color:red;"><?php echo e($message); ?></li>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
<br>

<table border="0" width="60%">
	<tr>
		<td nowrap>現在のメールアドレス：　<?php echo e($old_mail_addr); ?></td>
		<td>&nbsp;</td>
	<tr>
	<tr>
		<td align="center" colspan="2">
		<br /><table class="select" border="1" cellspacing="0" frame="hsides" rules="rows" width="100%">
			<tr>
				<td class="item" width="200px">メールアドレス<span id="essential">*</span><span id="gray">[半角]</span></td>
				<td><input type="text" size="40" maxlength="80" name="new_mail_addr" value="<?php echo e(old('new_mail_addr')); ?>" style="ime-mode: disabled;"></td>
			</tr>
			<tr>
				<td class="item" valign="bottom">メールアドレス確認<span id="essential">*</span><span id="gray">[半角]</span><br /><div id="essential">※確認の為、もう一度入力して下さい</div></td>
				<td><input type="text" size="40" maxlength="80" name="new_mail_addr_confirmation" value="<?php echo e(old('new_mail_addr_confirmation')); ?>" style="ime-mode: disabled;"></td>
			</tr>
		</table>
		</td>
	</tr>
</table>

<?php echo e(html()->form()->close()); ?>


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
<?php /**PATH /var/www/dwo2/resources/views/weborder/top/historymailchg.blade.php ENDPATH**/ ?>