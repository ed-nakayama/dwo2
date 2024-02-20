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
	<title>お知らせ</title>
</head>




    <?php if(session('flash_message')): ?>
		<FONT color="red"><?php echo e(session('flash_message')); ?></font><br>
	<?php endif; ?>

	<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<li style="list-style:none; color:red;"><?php echo e($error); ?></li>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<table border=0>
<tr><td>
<?php echo e(html()->form('POST', '/admin/info/store')->open()); ?>

<TABLE border=1>
  <TR>
     <TD nowrap align="center" bgcolor="#0000a0"><FONT color="White">お知らせマスタ（YBP用）</FONT></TD>
  </TR>
  <TR>
    <TD>
		<?php echo e(html()->textarea('infoMsg' ,$info->msg)->attributes(['cols' => '48', 'rows' => '20'])); ?>

    </TD>
  </TR>
  <TR>
    <TD align="center">
		<?php echo e(html()->submit('　更新　')->attribute('name', 'update')->value('update')); ?>

    </TD>
  </TR>
</TABLE>
<?php echo e(html()->form()->close()); ?>

</td>

</tr>
</table>



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
<?php /**PATH /var/www/dwo2/resources/views/admin/info.blade.php ENDPATH**/ ?>