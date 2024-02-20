<?php if (isset($component)) { $__componentOriginal91fdd17964e43374ae18c674f95cdaa3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal91fdd17964e43374ae18c674f95cdaa3 = $attributes; } ?>
<?php $component = App\View\Components\AdminLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('admin-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AdminLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

<head>
	<title>パスワード変更</title>
</head>

<style>
.tbl {
	font-size:85%;
	height: 100px;
}

.item {
	background-color : #efffef;
	padding-left : 3px;
	white-space : nowrap;
	}

.astar {
	color:red;
}


</style>

<center>

<?php echo e(html()->form('POST', '/admin/password/update')->open()); ?>


<table>
	<tr>
    <td nowrap align="center" bgcolor="#0000a0">
    	<FONT color="White">パスワード変更</FONT>
    </td>
	</tr>
	<tr>
		<td>
			<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<li style="list-style:none; color:red;"><?php echo e($error); ?></li>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</td>
	</tr>
	<tr>
		<td>
		<table class="tbl" border="1" cellspacing="0" frame="hsides" rules="rows">
			<tr>
				<td class="item">古いパスワード</td>
				<td>
					<?php echo e(html()->text('current-password')->attributes(['size' => '26', 'maxlength' => '64'])); ?>

					&nbsp;<span class="astar">*</span>ログイン時に入力したパスワードを入力して下さい
				</td>
			</tr>
			<tr>
				<td class="item">新しいパスワード</td>
				<td>
					<?php echo e(html()->text('new-password')->attributes(['size' => '26', 'maxlength' => '100'])); ?>

					&nbsp;<span class="astar">*</span>変更した新しいパスワードを入力してください。
				</td>
			</tr>
			<tr>
				<td class="item">新しいパスワード(確認)</td>
				<td>
					<?php echo e(html()->text('new-password_confirmation')->attributes(['size' => '26', 'maxlength' => '100'])); ?>

					&nbsp;<span class="astar">*</span>確認のためもう一度上記のパスワードを入れてください。
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
<br>

<?php if(session('status')): ?>
	<p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm text-blue-400 dark:text-blue-400" style="color: blue;"><?php echo e(session('status')); ?></p>
<?php endif; ?>
<?php echo e(html()->submit('更新')); ?>

<?php echo e(html()->form()->close()); ?>


</center>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal91fdd17964e43374ae18c674f95cdaa3)): ?>
<?php $attributes = $__attributesOriginal91fdd17964e43374ae18c674f95cdaa3; ?>
<?php unset($__attributesOriginal91fdd17964e43374ae18c674f95cdaa3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal91fdd17964e43374ae18c674f95cdaa3)): ?>
<?php $component = $__componentOriginal91fdd17964e43374ae18c674f95cdaa3; ?>
<?php unset($__componentOriginal91fdd17964e43374ae18c674f95cdaa3); ?>
<?php endif; ?>
<?php /**PATH /var/www/dwo2/resources/views/admin/password/edit.blade.php ENDPATH**/ ?>