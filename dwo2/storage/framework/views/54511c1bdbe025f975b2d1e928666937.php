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
	<title>承認バッチ設定</title>
</head>



    <?php if(session('flash_message')): ?>
		<FONT color="red"><?php echo e(session('flash_message')); ?></font>
	<?php endif; ?>


<?php echo e(html()->form('POST', '/admin/batch/conf/store')->open()); ?>


<h4>【承認期限切れ注文取り消し処理】</h4>
　注文日から<?php echo e(html()->text('cancelDay', $batch->batch_acceptance_cancel_day)->attributes(['size' => '5', 'maxlength' => '3'])); ?>日
　バッチ<?php echo e(html()->checkbox('cancelEnable', $batch->batch_acceptance_cancel_enable, '1')->disabled()); ?>

　<?php echo e(html()->submit('実行')->value('submit')->attribute('name', 'exec_cancel')); ?>


<h4>【承認督促メール送信】</h4>
　注文日から<?php echo e(html()->text('demandDay', $batch->batch_acceptance_demand_day)->attributes(['size' => '5', 'maxlength' => '3'])); ?>日
　バッチ<?php echo e(html()->checkbox('demandEnable', $batch->batch_acceptance_demand_enable, '1')->disabled()); ?>

　<?php echo e(html()->submit('実行')->value('submit')->attribute('name', 'exec_demand')); ?>


<h4>【アップグレード承認期限切れ注文取り消し処理】</h4>
　月末最終営業日から<?php echo e(html()->text('upgradeCancelDay', $batch->batch_upgrade_cancel_day)->attributes(['size' => '5', 'maxlength' => '3'])); ?>日前
　バッチ<?php echo e(html()->checkbox('upgradeCancelEnable', $batch->batch_upgrade_cancel_enable, '1')->disabled()); ?>

　<?php echo e(html()->submit('実行')->value('submit')->attribute('name', 'exec_upgradeCancel')); ?>


<h4>【アップグレード承認督促メール送信】</h4>
　月末最終営業日から<?php echo e(html()->text('upgradeDemandDay', $batch->batch_upgrade_demand_day)->attributes(['size' => '5', 'maxlength' => '3'])); ?>日前
　バッチ<?php echo e(html()->checkbox('upgradeDemandEnable', $batch->batch_upgrade_demand_enable, '1')->disabled()); ?>

　<?php echo e(html()->submit('実行')->value('submit')->attribute('name', 'exec_upgradeDemand')); ?>


<h4>【締め処理】</h4>
　<?php echo e(html()->submit('実行')->value('submit')->attribute('name', 'exec_closing')); ?>



<hr/>

<center><?php echo e(html()->submit('更新')->value('submit')->attribute('name', 'update')); ?></center>

<?php echo e(html()->form()->close()); ?>




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
<?php /**PATH /var/www/dwo2/resources/views/admin/batch/conf.blade.php ENDPATH**/ ?>