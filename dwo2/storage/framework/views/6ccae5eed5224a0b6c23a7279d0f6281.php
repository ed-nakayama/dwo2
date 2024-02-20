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
	<title>受注履歴照会</title>
</head>





<table width="500" border="0" cellspacing="5" cellpadding="0">

	<tr>
		<td nowrap align="center" valign="top">
			<table width="300">
				<tr>
					<td nowrap align="center" bgcolor="#0000a0">
						<font color="White">受注履歴照会</font>
					</td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td nowrap align="left" valign="top">
			<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<li style="list-style:none; color:red;"><?php echo e($error); ?></li>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</td>
	</tr>

	<tr>
		<td>

			<?php echo e(html()->form('POST', '/admin/order/search/history/search')->open()); ?>


				<table cellspacing="0" cellpadding="2">

					<tr>
						<td nowrap bgcolor="#8080ff">
							<font color="White"> 検 索 条 件 </font>
						</td>
					</tr>
				</table>

				<table width="300" border="1" cellspacing="0" cellpadding="2">

					<tr>
						<td nowrap bgcolor="#8080ff">
							<font color="white">受付No.</font>
						</td>
						<td nowrap width="100px">
							<?php echo e(html()->text('orderNum', $param['orderNum'] )->attribute('size', '12')); ?>

						</td>
						<td nowrap align="center" bgcolor="#8080ff">
							<font color="white">受付日(YYYYMMDD)</font>
						</td>
						<td nowrap align="left">
							<?php echo e(html()->text('orderStartDate', $param['orderStartDate'])->attribute('size', '12')); ?>～<?php echo e(html()->text('orderEndDate', $param['orderEndDate'])->attribute('size', '12')); ?>

						</td>
						<td bgcolor="#8080ff">
							<font color="White">ステータス</font>
						</td>
						<td>
							<select name="statusId[]" multiple size="5">
							<?php $__currentLoopData = $orderStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if(isset($param['statusId'])): ?>
									<?php echo e(html()->option($list->order_status_name, $list->order_status_id, in_array($list->order_status_id, $param['statusId']) )); ?>

								<?php else: ?>
									<?php echo e(html()->option($list->order_status_name, $list->order_status_id)); ?>

								<?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</td>
					</tr>

					<tr>
						<td nowrap bgcolor="#8080ff">
							<font color="White">顧客番号</font>
						</td>
						<td nowrap>
							<?php echo e(html()->text('custNum', $param['custNum'] )->attribute('size', '15')); ?>

						</td>
						<td nowrap bgcolor="#8080ff">
							<font color="White">顧客名</font>
						</td>
						<td nowrap colspan="3">
							<?php echo e(html()->text('custName', $param['custName'])->attribute('size', '80')); ?>

						</td>
					</tr>

					<tr>
						<td nowrap bgcolor="#8080ff">
							<font color="White">商品コード</font>
						</td>
						<td nowrap>
							<?php echo e(html()->text('itemCode', $param['itemCode'])->attribute('size', '15')); ?>

						</td>
						<td nowrap bgcolor="#8080ff">
							<font color="White">発注番号</font>
						</td>
						<td nowrap>
							<?php echo e(html()->text('custOrderNum', $param['custOrderNum'])->attribute('size', '15')); ?>

						</td>
						<td nowrap bgcolor="#8080ff">
							<font color="White">取引先形態</font>
						</td>
						<td nowrap>
							<select name="custClass">
								<?php echo e(html()->option('PAP'      , '1' , ($param['custClass'] == '1'))); ?>

								<?php echo e(html()->option('YBP'      , '2' , ($param['custClass'] == '2'))); ?>

								<?php echo e(html()->option('全て'     , '3' , ($param['custClass'] == '3' || empty($param['custClass'])))); ?>

							</select>
						</td>
					</tr>

					<tr>
						<td nowrap align="center" bgcolor="#8080ff">
							<font color="white">ユーザ削除</font>
						</td>
						<td nowrap align="center">
							<select name="custDel">
								<?php echo e(html()->option('削除なし', '1' ,($param['custDel'] == '1' || empty($param['custDel'])))); ?>

								<?php echo e(html()->option('削除あり', '2' ,($param['custDel'] == '2'))); ?>

								<?php echo e(html()->option('全て'    , '3' ,($param['custDel'] == '3'))); ?>

							</select>
						</td>
						<td nowrap align="center" bgcolor="#8080ff">
							<font color="white">オペレータ削除</font>
						</td>
						<td nowrap align="center" colspan="3">
							<select name="operatorDel">
								<?php echo e(html()->option('削除なし', '1' ,($param['operatorDel'] == '1' || empty($param['operatorDel'])))); ?>

								<?php echo e(html()->option('削除あり', '2' ,($param['operatorDel'] == '2'))); ?>

								<?php echo e(html()->option('全て'    , '3' ,($param['operatorDel'] == '3'))); ?>

							</select>
						</td>

					</tr>

					<tr>
						<td colspan="6" align="center">
							<?php echo e(html()->submit('検索')); ?>

						</td>
					</tr>

				</table>
			<?php echo e(html()->form()->close()); ?>


		</td>
	</tr>

	<br />

	<tr>
		<td>
		
			<table cellspacing="0" cellpadding="2">
				<tr>
					<td nowrap bgcolor="#8080c0">
						<font color="White">検 索 結 果</font>
					</td>
					<td nowrap></td>
					<td nowrap bgcolor="#8080c0">
						<font color="White">該当数 <?php echo e(number_format($dataCount)); ?></font>
					</td>
					<td nowrap></td>
					<td nowrap bgcolor="#8080c0">
						<font color="White">数量合計 <?php echo e(number_format($totalItemQuantity)); ?></font>
					</td>
				</tr>
			</table>

			<table width="600" border="1" cellspacing="0" cellpadding="2">

				<tr bgcolor="#8080c0">
					<td nowrap align="center" width="8%">
						<font color="White">受付No.</font>
					</td>
					<td nowrap align="center" width="8%">
						<font color="White">受付日</font>
					</td>
					<td nowrap align="center" width="10%">
						<font color="White">ステータス</font>
					</td>
					<td nowrap align="center" width="22%">
						<font color="White">顧客番号</font>
					</td>
					<td nowrap align="center" width="22%">
						<font color="White">顧客名</font>
					</td>
					<td nowrap align="center" width="22%">
						<font color="White">商品コード</font>
					</td>
					<td nowrap align="center" width="12%">
						<font color="White">数量</font>
					</td>
					<td nowrap align="center" width="22%">
						<font color="White">発注番号</font>
					</td>
					<td nowrap align="center" width="12%">
						<font color="White">取引先形態</font>
					</td>
					<td nowrap align="center" width="12%">
						<font color="White">詳細</font>
					</td>
					<td nowrap align="center" width="5%">
						<font color="White">ユーザ削除</font>
					</td>
					<td nowrap align="center" width="5%">
						<font color="White">オペレータ削除</font>
					</td>
					<td nowrap align="center" width="5%">
						<font color="White">バッチ更新日</font>
					</td>
				</tr>

				<?php $__currentLoopData = $dataList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

					<tr>
						<td nowrap align="right"><?php echo e($list->web_order_num); ?>&nbsp;</td>
						<td nowrap align="left"><?php echo e(str_replace('-','/' ,substr($list->order_date,0,10))); ?>&nbsp;</td>
						<td nowrap align="center">
							<?php $__currentLoopData = $orderStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($list->state_type == $stat->order_status_id): ?>
									<?php echo e($stat->order_status_name); ?>

								<?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</td>
						<td nowrap align="left"><?php echo e($list->cust_num); ?>&nbsp;</td>
						<td nowrap align="left"><?php echo e($list->name1 . $list->name2); ?>&nbsp;</td>
						<td nowrap align="left"><?php echo e($list->item_cd); ?>&nbsp;</td>
						<td nowrap align="right"><?php echo e($list->item_vol); ?>&nbsp;</td>
						<td nowrap align="right"><?php echo e($list->cust_order_num); ?>&nbsp;</td>
						<td nowrap align="center"><?php if($list->cust_class_medium == '01'): ?>PAP <?php elseif($list->cust_class_medium == '02'): ?>YBP <?php endif; ?>&nbsp;</td>
						<td nowrap align="center"><a href="/admin/order/list/detail?orderNum=<?php echo e($list->web_order_num); ?>">詳細</a>&nbsp;</td>

						<td nowrap align="center"><?php if($list->cust_del_type): ?>削除<?php endif; ?> &nbsp;</td>
						<td nowrap align="center"><?php if($list->operator_del_type): ?>削除<?php endif; ?> &nbsp;</td>
						<td nowrap align="center"><?php echo e(str_replace('-','/' ,$list->batch_update)); ?>&nbsp;</td>
					</tr>

				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

			</table>

			<table cellspacing="0" cellpadding="2">
				<tr>
					<td nowrap bgcolor="#8080c0">
						<font color="White">検 索 結 果</font>
					</td>
					<td nowrap></td>
					<td nowrap bgcolor="#8080c0">
						<font color="White">該当数 <?php echo e(number_format($dataCount)); ?></font>
					</td>
					<td nowrap></td>
					<td nowrap bgcolor="#8080c0">
						<font color="White">数量合計 <?php echo e(number_format($totalItemQuantity)); ?></font>
					</td>
				</tr>
			</table>

			<table align="center" border="0">
				<tr>
					<td>
						<div class="pager">
							<?php echo e($dataList->links('vendor.pagination.admin')); ?>

						</div>
					</td>
				</tr>
			</table>

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
<?php /**PATH /var/www/dwo2/resources/views/admin/order/searchHistory.blade.php ENDPATH**/ ?>