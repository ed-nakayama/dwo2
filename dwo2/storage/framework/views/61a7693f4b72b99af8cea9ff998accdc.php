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
	<title>受付編集</title>
</head>





<script type="text/javascript">
<!--

	function nextSearch(pg) {
		document.frm.page.value = pg;
		document.frm.view.value = "1";
		document.frm.submit();
	}

-->
</script>


<TABLE width="500" border="0" cellspacing="5" cellpadding="0">
  <TR>
    <TD nowrap align="left" valign="top">
     <CENTER>
     <TABLE width="300">
     <TR>
     <TD nowrap align="center" bgcolor="#0000a0"><FONT color="White">受付編集</FONT></TD></TR>
    </TABLE>
    </CENTER>
    <BR><BR>


	<?php echo e(html()->form('POST', '/admin/order/list2')->open()); ?>


    <TABLE cellspacing="0" cellpadding="2">
      <TR>
        <TD nowrap bgcolor="#8080ff"><FONT color="White"> 検 索 条 件 </FONT></TD>
      </TR>
    </TABLE>

			<TABLE width="300" border="1" cellspacing="0" cellpadding="2">
				<TR>
					<TD nowrap bgcolor="#8080ff"><FONT color="white">受付No.</FONT></TD>
					<TD nowrap>
						<?php echo e(html()->text('orderNum', $param['orderNum'])); ?>

					</TD>
					<TD nowrap colspan="2" align="center" bgcolor="#8080ff"><FONT color="white">受付日(YYYYMMDD)</FONT></TD>
					<TD nowrap colspan="2" align="left">
						<?php echo e(html()->text('orderStartDate',$param['orderStartDate'])->attributes(['size' => '10', 'maxlength' => '8'])); ?>～<?php echo e(html()->text('orderEndDate',$param['orderEndDate'])->attributes(['size' => '10', 'maxlength' => '8'])); ?>

					</TD>
					<TD nowrap bgcolor="#8080ff"><FONT color="White">得意先コード</FONT></TD>
					<TD nowrap>
						<?php echo e(html()->text('custNum', $param['custNum'])->attribute('size', '15')); ?>

					</TD>
				</TR>
				<TR>
					<TD nowrap bgcolor="#8080ff"><FONT color="White">得意先名称</FONT></TD>
					<TD nowrap colspan="2">
						<?php echo e(html()->text('custName', $param['custName'])->attribute('size', '40')); ?>

					</TD>
					<TD nowrap bgcolor="#8080ff"><FONT color="White">得意先名カナ</FONT></TD>
					<TD nowrap colspan="2">
						<?php echo e(html()->text('custNameKana', $param['custNameKana'])->attribute('size', '40')); ?>

					</TD>
					<TD nowrap bgcolor="#8080ff"><FONT color="White">得意先TEL</FONT></TD>
					<TD nowrap>
						<?php echo e(html()->text('searchTel', $param['searchTel'])->attribute('size', '15')); ?>

					</TD>
				</TR>
				<TR>
					<TD nowrap bgcolor="#8080ff"><FONT color="white">納品先形態</FONT></TD>
					<TD nowrap colspan="2">
						<SELECT name="deliveryType">
							<OPTION value="">
							<?php echo e(html()->option('貴社'      , '0' , ($param['deliveryType'] == "0"))); ?>

							<?php echo e(html()->option('別途納品先', '1' , ($param['deliveryType'] == "1"))); ?>

						</SELECT>
					<TD nowrap align="center" bgcolor="#8080ff"><FONT color="white">別途納品先名称</FONT></TD>
					<TD nowrap colspan="2" align="center">
						<?php echo e(html()->text('deliveryName', $param['deliveryName'])->attribute('size', '40')); ?>

					</TD>
					<TD nowrap align="center" bgcolor="#8080ff"><FONT color="white">注文担当者</FONT></TD>
					<TD nowrap align="left">
						<?php echo e(html()->text('nameOfCharge', $param['nameOfCharge'])->attribute('size', '15')); ?>

					</TD>
				</TR>
				<TR>
					<TD bgcolor="#8080ff"><FONT color="White">ステータス</FONT></TD>
					<TD>
						<SELECT name="statusId">
							<OPTION selected value="">　</option>
							<?php $__currentLoopData = $orderStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php echo e(html()->option($list->order_status_name, $list->order_status_id ,($param['statusId'] ==  $list->order_status_id))); ?>

							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</SELECT>
					</TD>
					<td  colspan="6"></td>
				</TR>
				<TR>
					<TD colspan="8" align="center">
						<?php echo e(html()->submit('検索')); ?>

					</TD>
				</TR>
			</TABLE>
			<?php echo e(html()->form()->close()); ?>


			<br>

    <TABLE cellspacing="0" cellpadding="2">
      <TR>
        <TD nowrap bgcolor="#8080c0"><FONT color="White">検 索 結 果</FONT></TD>
        <TD nowrap></TD>
        <TD nowrap bgcolor="#8080c0"><FONT color="White">該当数 <?php echo e(number_format($dataList->total())); ?></FONT></TD></TR>
    </TABLE>

			<TABLE width="600" border="1" cellspacing="0" cellpadding="2">
				<TR bgcolor="#8080c0">
					<th nowrap><FONT color="white">受注区分</FONT></th>
					<th nowrap><FONT color="White">受付No.</FONT></th>
					<th nowrap><FONT color="White">受付日</FONT></th>
					<th nowrap><FONT color="White">得意先コード</FONT></th>
					<th nowrap><FONT color="White">得意先名称</FONT></th>
					<th nowrap><FONT color="White">納品先名称</FONT></th>
					<th nowrap><FONT color="White">注文担当者</FONT></th>
					<th nowrap><FONT color="White">ステータス</FONT></th>
					<th nowrap><FONT color="White">編集</FONT></th>
				</TR>
<?php if(!empty($dataList[0]) ): ?>
				<?php $__currentLoopData = $dataList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<TR>
						<TD align="center" style="word-break: break-all;"><?php echo e($list->contents_type); ?></TD>
						<TD align="right" style="word-break: break-all;"><?php echo e($list->web_order_num); ?></TD>
						<TD align="left" style="word-break: break-all;"><?php echo e(str_replace("-", "/", substr($list->order_date,0,10) )); ?></TD>
						<TD align="left" style="word-break: break-all;"><?php echo e($list->cust_num); ?></TD>
						<TD align="left" style="word-break: break-all;"><?php echo e($list->search_name); ?></TD>
						<TD align="left" style="word-break: break-all;"><?php echo e($list->dest_name1); ?></TD>
						<TD align="left" style="word-break: break-all;"><?php echo e($list->dwo_order_person_name); ?></TD>
						<TD align="left" style="word-break: break-all;">
							<?php $__currentLoopData = $orderStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($list->state_type ==  $st->order_status_id): ?>
									<?php echo e($st->order_status_name); ?>

									<?php break; ?>
								<?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</TD>
						<TD align="center">
							<a href="/admin/order/list2/detail?order_num=<?php echo e($list->web_order_num); ?>">詳細</a>
						</TD>
					</TR>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
			</TABLE>
<center>
	<table border="0" width="100%">
				<tr>
					<td>
						<div class="pager">
							<?php echo e($dataList->appends(request()->query())->links('vendor.pagination.admin')); ?>

						</div>
					</td>
				</tr>
			</table>
</center>
		</TD>
	</TR>
</TABLE>



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
<?php /**PATH /var/www/dwo2/resources/views/admin/order/list2.blade.php ENDPATH**/ ?>