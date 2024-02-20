<html>
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

<title>追加メール変更</title>

<?php echo e(html()->form('POST', '/top/extramail/confirm')->attribute('name', 'frm')->style('margin:0px;')->open()); ?>

<?php echo e(html()->hidden('old_mail', Auth::user()->profile_extra_mail)); ?>

<?php echo e(html()->hidden('old_mail_flg', Auth::user()->profile_extra_mail_flag)); ?>


<br /><table width="550px">
	<tr>
		<td>
		<h4>▼追加メール変更</h4>
		</td>
	</tr>
</table>

<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<li style="list-style:none; color:red;"><?php echo e($error); ?></li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	<tr>
	<tr>
		<td>
			現在の受信設定：　
			<?php if(!empty(Auth::user()->profile_extra_mail_flag)): ?>
				受信する
			<?php else: ?>
				受信しない
			<?php endif; ?>
		</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	<tr>
	<tr>
		<td align="center" colspan="2">
		<br /><table class="select" border="1" cellspacing="0" frame="hsides" rules="rows" width="100%">
			<tr>
				<td class="item" width="200px">メールアドレス<span id="essential">*</span><span id="gray">[半角]</span></td>
				<td>
					<?php echo e(html()->text('mail')->attributes(['size' => '40', 'maxlength' => '80'])); ?>

				</td>
			</tr>
			<tr>
				<td class="item" valign="bottom">メールアドレス確認<span id="essential">*</span><span id="gray">[半角]</span><br /><div id="essential">※確認の為、もう一度入力して下さい</div></td>
				<td>
					<?php echo e(html()->text('mail_confirmation')->attributes(['size' => '40', 'maxlength' => '80'])); ?>

				</td>
			</tr>
			<tr>
				<td class="item" >受信設定</td>
				<td>
					<input type="radio" id="t1" name="mail_flg" value="1" checked /><label for="t1">受信する</label>
					<input type="radio" id="t2" name="mail_flg" value="0" /><label for="t2">受信しない</label>
				</td>
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
<?php /**PATH /var/www/dwo2/resources/views/weborder/top/extramailchg.blade.php ENDPATH**/ ?>