<?php if (isset($component)) { $__componentOriginal016817b303def9c4a4470d2856743183 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal016817b303def9c4a4470d2856743183 = $attributes; } ?>
<?php $component = App\View\Components\AdminGuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('admin_guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AdminGuestLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

<table width="500" border="0" cellspacing="3" cellpadding="0">
	<tr>
		<td nowrap colspan="2" align="center" valign="top">
			<?php echo e(html()->form('POST', route('admin.login'))->open()); ?>

			<table cellspacing="0" cellpadding="2">
				<tr>
					<td nowrap align="center" height="18" bgcolor="#8080ff"><font color="white"><b>　管理者用 ログイン　</b></font></td>
				</tr>
			</table>
			<table>
				<tr>
					<td>
						<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<li style="list-style:none; color:red;"><?php echo e($error); ?></li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</td>
				</tr>
				<tr>
					<td nowrap align="center">オペレータID</td>
				</tr>
				<tr>
					<td nowrap align="center">
						<?php echo e(html()->text('operator_id')->attributes(['size' => '15', 'maxlength' => '15'])); ?>

					</td>
				</tr>
				<tr>
					<td nowrap align="center">パスワード </td>
				</tr>
				<tr>
					<td nowrap align="center">
						<?php echo e(html()->password('password')->attributes(['size' => '15', 'maxlength' => '15'])); ?>

					</td>
				</tr>

				<tr>
					<td nowrap align="center">
						<a href="<?php echo e(route('admin.password.request')); ?>">パスワードを忘れてしまったら</a>
					</td>
				</tr>
				<tr>
					<td nowrap align="center">
					<br>
						<?php echo e(html()->submit('ログイン')); ?>

					</td>
				</tr>
			</table>
			<?php echo e(html()->form()->close()); ?>

		</td>
	</tr>
</table>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal016817b303def9c4a4470d2856743183)): ?>
<?php $attributes = $__attributesOriginal016817b303def9c4a4470d2856743183; ?>
<?php unset($__attributesOriginal016817b303def9c4a4470d2856743183); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal016817b303def9c4a4470d2856743183)): ?>
<?php $component = $__componentOriginal016817b303def9c4a4470d2856743183; ?>
<?php unset($__componentOriginal016817b303def9c4a4470d2856743183); ?>
<?php endif; ?>
<?php /**PATH /var/www/dwo2/resources/views/admin/auth/login.blade.php ENDPATH**/ ?>