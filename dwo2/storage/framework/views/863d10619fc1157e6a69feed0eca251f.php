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

<title>パスワード修正</title>


<table width="550px">
	<tr>
		<td>
		<h4 class="select">▼パスワード修正</h4>
		</td>
	</tr>
</table>

<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<li style="list-style:none; color:red;"><?php echo e($error); ?></li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php echo e(html()->form('POST', '/top/passedit/do')->attribute('name', 'frm')->style('margin:0px;')->open()); ?>

<table>
	<tr>
		<td>
			<?php if($alertMsg == "on"): ?>
				<span id="essential">初回ログインまたは、前回のご利用から３ヶ月以上経過しております。<br />
				安全の為パスワードを変更してください。</span><br /><br />
			<?php endif; ?>
			パスワード（半角英数字記号8～64文字、英字の大文字小文字は区別されます。）<br />
		</td>
	</tr>
	<tr>
		<td>
		<table class="select" border="1" cellspacing="0" frame="hsides" rules="rows">
			<tr>
				<td class="item">古いパスワード</td>
				<td>
					<?php echo e(html()->text('current-password')->attributes(['size' => '26', 'maxlength' => '64'])); ?>

					&nbsp;<span id="essential">*</span>ログイン時に入力したパスワードを入力して下さい
				</td>
			</tr>
			<tr>
				<td class="item">新しいパスワード</td>
				<td>
					<?php echo e(html()->text('new-password')->attributes(['size' => '26', 'maxlength' => '100'])); ?>

					&nbsp;<span id="essential">*</span>変更した新しいパスワードを入力してください。
				</td>
			</tr>
			<tr>
				<td class="item">新しいパスワード(確認)</td>
				<td>
					<?php echo e(html()->text('new-password_confirmation')->attributes(['size' => '26', 'maxlength' => '100'])); ?>

					&nbsp;<span id="essential">*</span>確認のためもう一度上記のパスワードを入れてください。
				</td>
			</tr>
		</table><br />
		</td>
	</tr>
	<tr>
		<td>
			
			<?php if(session('update_password_success')): ?>
				<div class="alert alert-success" style="color:#0000ff;">
					<?php echo e(session('update_password_success')); ?>

				</div>
			<?php endif; ?>
		</td>
	</tr>
	<tr>
		<td align="center">
			<div id="next">
				<a href="javascript:window.close();"><img src="<?php echo e(asset('assets/cust/img/close.png')); ?>"></a>
				<a href="javascript:document.frm.submit();"><img src="<?php echo e(asset('assets/cust/img/reset.png')); ?>" alt="修正" width="120px" height="50px"></a>
			</div>
		</td>
	</tr>
</table>

<?php echo e(html()->form()->close()); ?>


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
<?php /**PATH /var/www/dwo2/resources/views/weborder/top/passedit.blade.php ENDPATH**/ ?>