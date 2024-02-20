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
	<title>受注ステータスマスタ</title>
</head>



<TABLE width="500" border="0" cellspacing="5" cellpadding="0">
  <TR>
    <TD nowrap align="left" valign="top">
    
    <CENTER>
    <TABLE width="300">
    <TR>
    <TD nowrap align="center" bgcolor="#0000a0"><FONT color="White">受注ステータス マスタ</FONT></TD></TR>
    </TABLE>
    </CENTER>
    <BR>

	<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<li style="list-style:none; color:red;"><?php echo e($error); ?></li>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

	<?php echo e(html()->form('POST', '/admin/order/status/regist')->open()); ?>

    <TABLE width="300" border="1" cellspacing="0" cellpadding="2">
      <TR bgcolor="#0099d2">
        <TH nowrap><FONT color="White">ID</FONT></TH>
        <TH nowrap><FONT color="White">名称</FONT></TH>
      </TR>
      <TR>
        <TD nowrap align="right">
			<?php echo e(html()->text('new_id', '')->attributes(['size' => '10' , 'maxlength' => '3'])); ?>

        </TD>
        <TD nowrap>
			<?php echo e(html()->text('new_name', '')->attributes(['size' => '50' , 'maxlength' => '40'])); ?>

        </TD>
      </TR>
      <tr>
        <TD nowrap colspan=2 align="center">
			<?php if(session('status') === 'success-regist'): ?>
				<p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm text-blue-400 dark:text-blue-400" style="color: blue;">新規登録が完了しました。</p>
			<?php endif; ?>

			<?php echo e(html()->submit('新規登録')); ?>

        </TD>
      </tr>
    </TABLE>
	<?php echo e(html()->form()->close()); ?>



    <BR>
    <TABLE cellspacing="0" cellpadding="2">
      <TR>
        <TH nowrap bgcolor="#8080c0"><FONT color="White">件数 <?php echo e($dataList->count()); ?></FONT></TH>
        <TH nowrap></TH>
        <TH nowrap></TH>
      </TR>
    </TABLE>

	<?php echo e(html()->form('POST', '/admin/order/status/store')->open()); ?>

    <TABLE width="600" border="1" cellspacing="0" cellpadding="2">
      <TR bgcolor="#8080c0">
        <TH nowrap><FONT color="White">ID</FONT></TH>
        <TH nowrap><FONT color="White">名称</FONT></TH>
        <TH nowrap><FONT color="White">表示順</FONT></TH>
        <TH nowrap><FONT color="White">更新者ID</FONT></TH>
        <TH nowrap><FONT color="White">更新日</FONT></TH>
        <TH nowrap><FONT color="White">削除</FONT></TH>
      </TR>
<?php $__currentLoopData = $dataList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <TR>
        <TD nowrap align="right">
        	<?php echo e($list->order_status_id); ?>

			<?php echo e(html()->hidden('idList[]', $list->order_status_id)); ?>

        </TD>
        <TD nowrap>
			<?php echo e(html()->text("nameList[{$list->order_status_id}]", $list->order_status_name)->attributes(['size' => '50' , 'maxlength' => '40'])); ?>

        </TD>
        <TD nowrap>
			<?php echo e(html()->text("sortList[{$list->order_status_id}]", $list->order_sort_num)->attributes(['size' => '4' , 'maxlength' => '3'])); ?>

        </TD>
        <TD nowrap><?php echo e($list->order_status_modified_id); ?></TD>
        <TD nowrap><?php echo e(substr(str_replace("-", "/", $list->order_status_update),0 ,10)); ?></TD>
        <TD align="center">
 			<?php echo e(html()->checkbox("delList[{$list->order_status_id}]", $list->order_status_del ,$list->order_status_id)); ?>

       </TD>
      </TR>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <TR>
        <TD nowrap colspan=6 align="center">
			<?php if(session('status') === 'success-store'): ?>
				<p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm text-blue-400 dark:text-blue-400" style="color: blue;">更新が完了しました。</p>
			<?php endif; ?>

			<?php echo e(html()->submit('更新')); ?>

        </TD>
      </TR>
   </TABLE>
	<?php echo e(html()->form()->close()); ?>


</TD>
</TR></TABLE>



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
<?php /**PATH /var/www/dwo2/resources/views/admin/order/status.blade.php ENDPATH**/ ?>