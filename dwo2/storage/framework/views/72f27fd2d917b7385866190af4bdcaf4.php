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

<title>メール受信設定変更確認</title>


<?php echo e(html()->form('POST', '/top/mailreceiving/do')->attribute('name', 'frm')->style('margin:0px;')->open()); ?>

<?php echo e(html()->hidden('mail_flg', $mail_flg)); ?>

<?php echo e(html()->hidden('extra_mail_flg', $extra_mail_flg)); ?>

<?php echo e(html()->form()->close()); ?>


<br /><table width="550px">
	<tr>
		<td>
		<h4>▼メール受信設定変更確認</h4>
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
			<?php if(!empty($mail_flg)): ?>
				受信する
			<?php else: ?>
				受信しない
			<?php endif; ?>
		</td>
	<tr>
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
			<?php if(!empty($extra_mail_flg)): ?>
				受信する
			<?php else: ?>
				受信しない
			<?php endif; ?>
		</td>
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
<?php /**PATH /var/www/dwo2/resources/views/weborder/top/mailReceivingConfirm.blade.php ENDPATH**/ ?>