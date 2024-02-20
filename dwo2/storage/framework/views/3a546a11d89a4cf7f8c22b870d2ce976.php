<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

<title>webオーダー履歴</title>

<script type="text/javascript">
<!--
	function dtlSearch(o_num) {
		document.frmDtl.frm_order_num.value = o_num;
		document.frmDtl.submit();
	}

	function nextSearch(pg) {
		document.frm.page.value = pg;
		document.frm.submit();
	}

-->
</script>

<br>
<table width="550px">
	<tr>
		<td>
		<h4>▼注文履歴</h4>
		</td>
	</tr>
</table>

<?php echo e(html()->form('POST', '/top/history/detail')->attribute('name', 'frmDtl')->style('margin:0px;')->open()); ?>

<?php echo e(html()->hidden('frm_order_num')); ?>

<?php echo e(html()->hidden('frm_from_date',             $frm_from_date)); ?>

<?php echo e(html()->hidden('frm_to_date',               $frm_to_date)); ?>

<?php echo e(html()->hidden('frm_web_order_num',         $frm_web_order_num)); ?>

<?php echo e(html()->hidden('frm_item_cd',               $frm_item_cd)); ?>

<?php echo e(html()->hidden('frm_dwo_order_person_name', $frm_dwo_order_person_name)); ?>

<?php echo e(html()->hidden('frm_direct_delivery_type',  $frm_direct_delivery_type)); ?>

<?php echo e(html()->hidden('frm_dest_name1',            $frm_dest_name1)); ?>

<?php echo e(html()->hidden('frm_state_type',            $frm_state_type)); ?>

<?php echo e(html()->form()->close()); ?>


<?php echo e(html()->form('POST', '/top/history/search')->attribute('name', 'frm')->open()); ?>


<table border="0" width="560px">
	<tr>
		<td height="130px">
■ステータスとは■<br />
現在の処理状況を指しています。<br />
<br />
<table border="0">
<tr>
<td>【受付中】とは</td><td>：　ご注文確定後、弊社営業日15時までの状態　&lt;ご注文の削除が可能です&gt;</td>
</tr>
<tr>
<td>【出荷手配済】とは</td><td>：　ご注文確定後、弊社営業日15時を過ぎて出荷手配が完了した状態</td>
</tr>
<tr>
<td>【予約受付中】とは</td><td>：　ご予約を承っている状態　&lt;ご注文の削除が可能です&gt</td>
</tr>
</table>
		</td>
	</tr>
	<tr>
		<td class="search">
		▼検索条件
		</td>
	</tr>
	<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<tr>
			<td>
				<li style="list-style:none; color:red;"><?php echo e($error); ?></li>
			</td>
		</tr>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<tr>
		<td align="center" height="200px">
			<br /><table class="new" border="1" cellspacing="0" frame="hsides" rules="rows">
				<tr>
					<td class="item">受付日(YYYY-MM-DD)</td>
					<td>
						<?php echo e(html()->text('frm_from_date', $frm_from_date)->attribute('maxlength', '10')); ?>

						～
						<?php echo e(html()->text('frm_to_date', $frm_to_date)->attribute('maxlength', '10')); ?>

					</td>
				</tr>
				<tr>
					<td class="item">受付No.</td>
					<td>
						<?php echo e(html()->text('frm_web_order_num', $frm_web_order_num)->attribute('maxlength', '10')); ?>

					</td>
				</tr>
				<tr>
					<td class="item">商品コード</td>
					<td>
						<?php echo e(html()->text('frm_item_cd', $frm_item_cd)->attribute('maxlength', '15')); ?>

					</td>
				</tr>
				<tr>
					<td class="item">貴社担当者</td>
					<td>
						<?php echo e(html()->text('frm_dwo_order_person_name', $frm_dwo_order_person_name)->attribute('maxlength', '100')); ?>

					</td>
				</tr>
				<tr>
					<td class="item">納品先形態</td>
					<td>
					&nbsp;<select name="frm_direct_delivery_type">
						<?php echo e(html()->option('選択して下さい')); ?>

						<?php echo e(html()->option('貴社'      , '0' , ($frm_direct_delivery_type == "0"))); ?>

						<?php echo e(html()->option('別途納品先', '1' , ($frm_direct_delivery_type == "1"))); ?>

					</td>
				</tr>
				<tr>
					<td class="item">別途納品先名称</td>
					<td>
						<?php echo e(html()->text('frm_dest_name1', $frm_dest_name1)->attributes(['size' => '50' ,'maxlength', '50'])); ?>

					</td>
				</tr>
				<tr>
					<td class="item">
					ステータス
					</td>
					<td>
					&nbsp;
						<select name="frm_state_type">
							<option class="gray" value="">選択して下さい</option>
							<?php $__currentLoopData = $orderStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if(in_array($list->order_status_id, [0, 1, 4, 8, 9]) ): ?>
								<?php echo e(html()->option($list->order_status_name, $list->order_status_id ,($frm_state_type ==  $list->order_status_id))); ?>

								<?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center">
		<br /><a href="javascript:document.frm.submit();"><img src="<?php echo e(asset('assets/cust/img/search.png')); ?>" alt="検索" width="120px" height="50px"></a>
		</td>
	</tr>
</table>

<?php echo e(html()->form()->close()); ?>


<table border="0" cellspacing="0">
	<tr>
		<td colspan="2" height="100px">
		<span id="essential">※</span>
		納品先の検索は、納品先形態で貴社か貴社以外(別途納品先)に分けて行って下さい。<br />
		なお、別途納品先を指定した場合は、納品先名称のあいまい検索が可能です。<br />
		</td>
	</tr>
	<tr>
		<td class="search">
		▼検索結果
		</td>
		<td class="search" align="right">
		該当数&nbsp;<?php if(empty($orderList[0])): ?>0 <?php else: ?><?php echo e($orderList->total()); ?><?php endif; ?>
		</td>
	</tr>
	<tr>
		<td colspan="2" height="100px">
<?php if(empty($orderList[0])): ?>
<?php elseif($orderList->total() == 0): ?>
			注文データが見つかりませんでした。
<?php else: ?>
			<table border="1" cellspacing="0">
				<tr>
					<td class="item">返品/キャンセル</td>
					<td class="item">受付No.</td>
					<td class="item">受付日</td>
					<td class="item" width="150px">納品先名称</td>
					<td class="item">貴社担当者</td>
					<td class="item">ステータス</td>
					<td class="item" align="center">詳細</td>
				</tr>
				<?php $__currentLoopData = $orderList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td align="center"><font color="red">　<?php if($order->reti_state_type == '2'): ?>返品<?php endif; ?> <?php if($order->cc_header_del_type == '1'): ?>キャンセル<?php endif; ?></font></td>
					<td><?php echo e($order->web_order_num); ?></td>
					<td><?php echo e($order->dwo_last_update); ?></td>
					<?php if(empty($order->dest_name1)): ?>
						<td align="center">－－－－－</td>
					<?php else: ?>
						<td align="center"><?php echo e($order->dest_name1); ?><?php echo e($order->dest_name2); ?></td>
					<?php endif; ?>
					<td><?php echo e($order->dwo_order_person_name); ?>&nbsp;</td>
					<td align="center">
						<?php $__currentLoopData = $orderStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php if($order->state_type == $stat->order_status_id): ?>
								<?php echo e($stat->order_status_name); ?>

							<?php endif; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</td>
					<td>
						<?php echo e(html()->submit('詳細')->attribute('onClick', "dtlSearch($order->web_order_num);")); ?>

					</td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</table>
<?php endif; ?>
		</td>
	</tr>
	<?php if(isset($orderList[0])): ?>
	<TABLE cellspacing="0" cellpadding="2" align="center">
		<TR>
			<th nowrap>
				<div class="pager">
					<?php echo e($orderList->appends(request()->query())->links('vendor.pagination.user')); ?>

				</div>
			</th>
		</TR>
	</TABLE>
	<?php endif; ?>
	<tr>
		<td align="center" colspan="2">
			<a href="javascript:window.close();"><img src="<?php echo e(asset('assets/cust/img/close.png')); ?>"></a>
		</td>
	</tr>
</table>



 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /var/www/dwo2/resources/views/weborder/top/history2search.blade.php ENDPATH**/ ?>