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

<title>メール受信設定変更<</title>


<?php echo e(html()->form('POST', '/top/mailreceiving/confirm')->attribute('name', 'frm')->style('margin:0px;')->open()); ?>


<br /><table width="550px">
	<tr>
		<td>
		<h4>▼メール受信設定変更</h4>
		</td>
	</tr>
</table>

<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<li style="list-style:none; color:red;"><?php echo e($error); ?></li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<table border="0" width="60%">
	<tr>
		<td align="left">
			購入確認などのメールを受信するかどうか設定します。
		</td>
	<tr>
</table>
<br />
<table border="0" width="60%">
	<tr>
		<td nowrap>
			登録メールアドレス：　
			<?php if(!empty(session('agentView')->mail_address)): ?>
				<?php echo e(session('agentView')->mail_address); ?>

			<?php else: ?>
				なし
			<?php endif; ?>
		</td>
	</tr>
	<tr>
		<td nowrap>
			登録メールアドレスの受信設定：　
			<input type="radio" id="m1" name="mail_flg" value="1" <?php if(Auth::user()->profile_mail_flag == 1): ?> checked <?php endif; ?> /><label for="m1">受信する</label>
			<input type="radio" id="m2" name="mail_flg" value="0" <?php if(Auth::user()->profile_mail_flag == 0): ?> checked <?php endif; ?> /><label for="m2">受信しない</label>
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td nowrap>
			追加メールアドレス：　
			<?php if(!empty(Auth::user()->profile_extra_mail)): ?>
				<?php echo e(Auth::user()->profile_extra_mail); ?>

			<?php else: ?>
				なし
			<?php endif; ?>
		</td>
	</tr>
	<tr>
		<td nowrap>
			追加メールアドレスの受信設定：　
			<input type="radio" id="em1" name="extra_mail_flg" value="1" <?php if(Auth::user()->profile_extra_mail_flag == 1): ?> checked <?php endif; ?> /><label for="em1">受信する</label>
			<input type="radio" id="em2" name="extra_mail_flg" value="0" <?php if(Auth::user()->profile_extra_mail_flag == 0): ?> checked <?php endif; ?>/><label for="em2">受信しない</label>
		</td>
	<tr>
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
<?php /**PATH /var/www/dwo2/resources/views/weborder/top/mailReceivingMod.blade.php ENDPATH**/ ?>