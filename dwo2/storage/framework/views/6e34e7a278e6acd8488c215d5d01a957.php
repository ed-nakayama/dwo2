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

<title>メールアドレス追加設定<</title>


<?php echo e(html()->form('GET', '/top/extramail/change')->attribute('name', 'frm')->style('margin:0px;')->open()); ?>

<?php echo e(html()->form()->close()); ?>


<br /><table width="550px">
	<tr>
		<td>
		<h4>▼メールアドレス追加設定</h4>
		</td>
	</tr>
</table>

<table border="0" width="60%">
	<tr>
		<td align="left">
			購入確認などのメール送信先を追加設定することができます。（１件のみ可能）
		</td>
	<tr>
</table>
<br />
<table border="0" width="60%">
	<tr>
		<td nowrap>
			現在の追加メールアドレス：　
			<?php if(!empty(Auth::user()->profile_extra_mail)): ?>
				<?php echo e(Auth::user()->profile_extra_mail); ?>

			<?php else: ?>
				なし
			<?php endif; ?>
		</td>


	</tr>
	<tr>
		<td nowrap>
			現在の受信設定：　
			<?php if(!empty(Auth::user()->profile_extra_mail_flag)): ?>
				受信する
			<?php else: ?>
				受信しない
			<?php endif; ?>
		</td>
	<tr>
</table>

<br />
<a href="javascript:window.close();"><img src="<?php echo e(asset('assets/cust/img/close.png')); ?>"></a>
　<a href="#" onClick="javascript:document.frm.submit();"><img src="<?php echo e(asset('assets/cust/img/reset.png')); ?>" alt="修正" width="120px" height="50px"></a>

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
<?php /**PATH /var/www/dwo2/resources/views/weborder/top/extramail.blade.php ENDPATH**/ ?>