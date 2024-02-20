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
	<title>得意先サブマスタ</title>
</head>




	<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<font color=red><li><?php echo e($error); ?></font></li>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



<?php echo e(html()->form('POST', '/admin/cust/search')->open()); ?>

<TABLE border="1">
  <TR>
     <TD colspan="8" nowrap align="center" bgcolor="#0000a0"><FONT color="White">得意先サブマスタ</FONT></TD>
  </TR>

  <TR bgcolor="#8080ff">
    <TH nowrap><FONT color="white">得意先コード</FONT></TH>
    <TH nowrap><FONT color="white">お客様番号</FONT></TH>
    <TH nowrap><FONT color="white">得意先名称</FONT></TH>
    <TH nowrap><FONT color="white">得意先名称カナ</FONT></TH>
    <TH nowrap><FONT color="white">TEL</FONT></TH>
    <TH nowrap><FONT color="white">Web利用(可)</FONT></TH>
    <TH nowrap><FONT color="white">削除</FONT></TH>
    <TH nowrap><FONT color="white">検索</FONT></TH>
  </TR>
  <TR>
    <TD nowrap>
		<?php echo e(html()->text('search_cust_code', $param['search_cust_code'])->attribute('size', '12')); ?>

    </TD>
    <TD nowrap>
		<?php echo e(html()->text('search_account_num', $param['search_account_num'])->attribute('size', '12')); ?>

    </TD>
    <TD nowrap>
		<?php echo e(html()->text('search_name', $param['search_name'])->attribute('size', '24')); ?>

    </TD>
    <TD nowrap>
		<?php echo e(html()->text('search_name_kana', $param['search_name_kana'] )->attribute('size', '24')); ?>

    </TD>
    <TD nowrap>
		<?php echo e(html()->text('search_tel', $param['search_tel'])->attribute('size', '20')); ?>

    </TD>
    <TD nowrap align="center">
		<?php echo e(html()->checkbox('search_web_flag',$param['search_web_flag'] )); ?>

    </TD>
    <TD nowrap align="center">
		<?php echo e(html()->checkbox('search_del_flag', $param['search_del_flag'])); ?>

    </TD>
    <TD nowrap align="center">
		<?php echo e(html()->submit('検索')); ?>

    </TD>
  </TR>
</TABLE>
<?php echo e(html()->form()->close()); ?>


<br /><br />


<?php if(isset($custList[0])): ?>
<table border="1" cellspacing="0" cellpadding="2">
	<tr bgcolor="#8080c0">
		<th nowrap align="center"><font color="white">得意先コード</font></th>
		<th nowrap align="center"><font color="white">お客様番号</font></th>
		<th nowrap align="center"><font color="white">得意先名称</font></th>
		<th nowrap align="center"><font color="white">得意先名称カナ</font></th>
		<th nowrap align="center"><font color="white">TEL</font></th>
		<th nowrap align="center"><font color="white">WEB利用</font></th>
		<th nowrap align="center"><font color="white">削除</font></th> 
		<th nowrap align="center"></th>
	</tr>
	<?php $__currentLoopData = $custList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cust): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php echo e(html()->form('POST', '/admin/cust/detail')->attribute('name', 'form' . $loop->index)->open()); ?>

		<?php echo e(html()->hidden('cust_code', $cust->profile_cust_code)); ?>


		<?php if(($loop->index % 2) == 0): ?>
			<tr bgcolor="#d1d1e9">
		<?php else: ?>
			<tr bgcolor="white">
		<?php endif; ?>
			<td align="left"><?php echo e($cust->profile_cust_code); ?></td>
			<td align="left"><?php echo e($cust->account_num); ?></td>
			<td align="left"><?php echo e($cust->name1 . $cust->name2); ?></td>
			<td align="left"><?php echo e($cust->search_name_kana); ?></td>
			<td align="left"><?php echo e($cust->tel); ?></td>
			<td align="center">
				<font color="red">
					<?php if(!empty($cust->profile_web_flag)): ?>
						可
					<?php else: ?>
						&nbsp;
					<?php endif; ?>
				</font>
			</td>
			<td align="center">
				<font color="red">
					<?php if(!empty($cust->profile_del)): ?>
						〇
					<?php else: ?>
						&nbsp;
					<?php endif; ?>
				</font>
			</td>
			<TD nowrap align="center">
				<a href="javascript:form<?php echo e($loop->index); ?>.submit()" }}">詳細</a>
			</TD>
		</tr>
		<?php echo e(html()->form()->close()); ?>

	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>

<center>
<table border="0">
	<tr>
		<td>
			<div class="pager">
				<?php echo e($custList->appends(request()->query())->links('vendor.pagination.admin')); ?>

			</div>
		</td>
	</tr>
</table>
</center>

<?php endif; ?>




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
<?php /**PATH /var/www/dwo2/resources/views/admin/cust/list.blade.php ENDPATH**/ ?>