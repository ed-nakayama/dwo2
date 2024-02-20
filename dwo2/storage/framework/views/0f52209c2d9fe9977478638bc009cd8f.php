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
	<title>受付状況確認</title>
</head>




<TABLE width="500" border="0" cellspacing="5" cellpadding="0">
  <TR>
    <TD nowrap align="left" valign="top">
     <CENTER>
     <TABLE width="300">
     <TR>
     <TD nowrap align="center" bgcolor="#0000a0"><FONT color="White">受付状況確認</FONT></TD></TR>
    </TABLE>
    </CENTER>
    <BR><BR>


			<?php echo e(html()->form('POST', '/admin/order/list/search')->open()); ?>


			<TABLE cellspacing="0" cellpadding="2">
				<TR>
					<TD bgcolor="#8080ff"><FONT color="White"> 検 索 条 件 </FONT></TD>
				</TR>
			</TABLE>

			<TABLE width="300" border="1" cellspacing="0" cellpadding="2">
				<TR>
					<TD nowrap bgcolor="#8080ff"><FONT color="white">受付No.</FONT></TD>
					<TD nowrap>
						<?php echo e(html()->text('orderNum', $param['orderNum'])->attribute('size', '12')); ?>

					</TD>
					<TD nowrap colspan="2" align="center" bgcolor="#8080ff"><FONT color="white">受付日(YYYYMMDD)</FONT></TD>
					<TD nowrap colspan="2" align="left">
						<?php echo e(html()->text('orderStartDate',$param['orderStartDate'])->attributes(['size' => '10', 'maxlength' => '8'])); ?>～<?php echo e(html()->text('orderEndDate',$param['orderEndDate'])->attributes(['size' => '10', 'maxlength' => '8'])); ?>

					</TD>
					<TD nowrap bgcolor="#8080ff"><FONT color="White">得意先コード</FONT></TD>
					<TD nowrap>
						<?php echo e(html()->text('custNum', $param['custNum'] )->attribute('size', '15')); ?>

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
						<?php echo e(html()->text('custTel', $param['custTel'])->attribute('size', '15')); ?>

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
					<TD nowrap align="center" bgcolor="#8080ff"><FONT color="white">取込完了</FONT></TD>
					<TD nowrap align="center">
						<?php echo e(html()->checkbox('inputType', $param['inputType'] ,'1')); ?>

					</TD>
					<TD nowrap align="center" bgcolor="#8080ff"><FONT color="white">ユーザ削除</FONT></TD>
					<TD nowrap align="center">
						<select name="custDel">
							<?php echo e(html()->option('削除なし', '1' ,($param['custDel'] == '1'))); ?>

							<?php echo e(html()->option('削除あり', '2' ,($param['custDel'] == '2'))); ?>

							<?php echo e(html()->option('全て'    , '3' ,($param['custDel'] == '3'))); ?>

						</select>
					</TD>
					<TD align="center" bgcolor="#8080ff"><FONT color="white">オペレータ削除</FONT></TD>
					<TD align="center">
						<select name="operatorDel">
							<?php echo e(html()->option('削除なし', '1' ,($param['operatorDel'] == '1'))); ?>

							<?php echo e(html()->option('削除あり', '2' ,($param['operatorDel'] == '2'))); ?>

							<?php echo e(html()->option('全て'    , '3' ,($param['operatorDel'] == '3'))); ?>

						</select>
					</TD>
				</TR>
				<TR>
					<TD colspan="2" align="center" bgcolor="#8080ff"><FONT color="white">取込日(YYYYMMDD)</FONT></TD>
					<TD colspan="8" align="left">
						<?php echo e(html()->text('inputStartDate', $param['inputStartDate'])->attribute('size', '12')); ?>～<?php echo e(html()->text('inputEndDate', $param['inputEndDate'])->attribute('size', '12')); ?>

					</TD>
				</TR>
				<TR>
					<TD colspan="8" align="center">
						<?php echo e(html()->submit('検索')->attribute('name', 'view')->value('view')); ?>

					</TD>
				</TR>
			</TABLE>

			<table>
				<tr>
					<td>
						<?php echo e(html()->submit('一括印刷')->attribute('name', 'print')->value('print')); ?>

					</td>
				</tr>
			</table>
			<?php echo e(html()->form()->close()); ?>


			<BR>


			<TABLE cellspacing="0" cellpadding="2">
			<TR>
				<TD nowrap bgcolor="#8080c0"><FONT color="White">検 索 結 果</FONT></TD>
				<TD nowrap></TD>
				<TD nowrap bgcolor="#8080c0"><FONT color="White">該当数 <?php echo e(number_format($dataList->total())); ?></FONT></TD></TR>
			</TABLE>

			<TABLE width="600" border="1" cellspacing="0" cellpadding="2">
				<TR bgcolor="#8080c0">
					<TH><FONT color="White">受付No.</FONT></TH>
					<TH><FONT color="White">受付日</FONT></TH>
					<TH><FONT color="White">得意先コード</FONT></TH>
					<TH><FONT color="White">得意先名称</FONT></TH>
					<TH><FONT color="White">納品先名称</FONT></TH>
					<TH><FONT color="White">注文担当者</FONT></TH>
					<TH><FONT color="White">ステータス</FONT></TH>
					<TH><FONT color="White">取込エラー</FONT></TH>
					<TH><FONT color="White">取込完了</FONT></TH>
					<TH><FONT color="White">ユーザ削除</FONT></TH>
					<TH><FONT color="White">オペレータ削除</FONT></TH>
					<TH><FONT color="White">取込日</FONT></TH>
					<TH><FONT color="White">最終更新日</FONT></TH>
					<TH><FONT color="White">バッチ更新日</FONT></TH>
					<TH><FONT color="White">詳細</FONT></TH>
				</TR>
<?php if(!empty($dataList[0])): ?>
<?php $__currentLoopData = $dataList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

				<TR>
					<TD align="right"><?php echo e($list->web_order_num); ?></TD>
					<TD><?php echo e($list->order_date); ?></TD>
					<TD style="word-break: break-all;"><?php echo e($list->cust_num); ?></TD>
					<TD style="word-break: break-all;"><?php echo e($list->search_name); ?></TD>
					<TD style="word-break: break-all;"><?php echo e($list->dest_name1); ?></TD>
					<TD style="word-break: break-all;"><?php echo e($list->dwo_order_person_name); ?></TD>
					<TD style="word-break: break-all;">
						<?php $__currentLoopData = $orderStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php if($list->state_type ==  $st->order_status_id): ?>
								<?php echo e($st->order_status_name); ?>

								<?php break; ?>
							<?php endif; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</TD>
					<TD style="word-break: break-all;" align="center"><?php if($list->error_type == '1'): ?> <font color="RED">あり</font><?php else: ?> &nbsp; <?php endif; ?></TD>
					<TD style="word-break: break-all;" align="center"><?php if($list->input_type == '1'): ?> <font color="RED">取込完了</font><?php else: ?> &nbsp; <?php endif; ?></TD>
					<TD style="word-break: break-all;" align="center"><?php if($list->cust_del_type == '1'): ?> 削除 <?php else: ?> &nbsp; <?php endif; ?></TD>
					<TD style="word-break: break-all;" align="center"><?php if($list->operator_del_type == '1'): ?> 削除 <?php else: ?> &nbsp; <?php endif; ?></TD>
					<TD align="center"><?php echo e($list->input_timestamp); ?></TD>
					<TD style="word-break: break-word;" align="center"><?php echo e($list->dwo_last_update); ?></TD>
					<TD style="word-break: break-word;" align="center"><?php echo e($list->dwo_ship_status_update); ?></TD>
					<TD align="center">
						<a href="/admin/order/list/detail?orderNum=<?php echo e($list->web_order_num); ?>">詳細</a>
					</TD>
				</TR>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
			</TABLE>

			<table align="center" border="0">
				<tr>
					<td>
						<div class="pager">
							<?php echo e($dataList->links('vendor.pagination.admin')); ?>

						</div>
					</td>
				</tr>
			</table>

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
<?php /**PATH /var/www/dwo2/resources/views/admin/order/list.blade.php ENDPATH**/ ?>