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

<style>
ul {
  list-style: none;
}
</style>

<div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
	<?php echo e(__('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.')); ?>

</div>

<br>

<!-- Session Status -->
<font color="blue">
	<?php if (isset($component)) { $__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.auth-session-status','data' => ['class' => 'mb-4','status' => session('status')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('auth-session-status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mb-4','status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(session('status'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5)): ?>
<?php $attributes = $__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5; ?>
<?php unset($__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5)): ?>
<?php $component = $__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5; ?>
<?php unset($__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5); ?>
<?php endif; ?>
</font>
<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<li style="list-style:none; color:red;"><?php echo e($error); ?></li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php echo e(html()->form('POST', route('admin.password.email'))->open()); ?>

	<table>
		<tr>
			<td>オペレータID</td>
			<td>
				<?php echo e(html()->text('operator_id')->attribute('maxlength', '20')); ?>

			</td>
		</tr>

		<tr>
			<td>メールアドレス</td>
			<td>
				<?php echo e(html()->text('email')->attribute('maxlength', '80')); ?>

			</td>
		</tr>
	</table>
	
<br>
<?php echo e(html()->submit(__('Email Password Reset Link'))); ?>


<?php echo e(html()->form()->close()); ?>


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
<?php /**PATH /var/www/dwo2/resources/views/admin/auth/forgot-password.blade.php ENDPATH**/ ?>