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
	function printPreview() {
		document.frmPrt.submit();
	}

	function printPreviewUpgrade() {
		document.frmPrtUpgrade.submit();
	}

	function delSubmit() {
		if (window.confirm("この注文を削除してもよろしいですか？")) {
			document.frm.submit();
		}
	}
-->
</script>


<?php echo e(html()->form('POST', '/order/printview')->attributes(['name' => 'frmPrt', 'target' => '_blank'])->open()); ?>

<?php echo e(html()->hidden('orderNum', $orderheader->web_order_num)); ?>

<?php echo e(html()->form()->close()); ?>


<?php echo e(html()->form('POST', '/order/upgradeprint')->attributes(['name' => 'frmPrtUpgrade', 'target' => '_blank'])->open()); ?>

<?php echo e(html()->hidden('orderNum', $orderheader->web_order_num)); ?>

<?php echo e(html()->form()->close()); ?>


<?php echo e(html()->form('POST', '/top/history/delete')->attribute('name', 'frm')->open()); ?>

<?php echo e(html()->hidden('del_order_num', $orderheader->web_order_num)); ?>

<?php echo e(html()->hidden('frm_from_date', $frm_from_date)); ?>

<?php echo e(html()->hidden('frm_to_date', $frm_to_date)); ?>

<?php echo e(html()->hidden('frm_web_order_num', $frm_web_order_num)); ?>

<?php echo e(html()->hidden('frm_item_cd', $frm_item_cd)); ?>

<?php echo e(html()->hidden('frm_dwo_order_person_name', $frm_dwo_order_person_name)); ?>

<?php echo e(html()->hidden('frm_direct_delivery_type', $frm_direct_delivery_type)); ?>

<?php echo e(html()->hidden('frm_dest_name1', $frm_dest_name1)); ?>

<?php echo e(html()->hidden('frm_state_type', $frm_state_type)); ?>

<?php echo e(html()->form()->close()); ?>


<?php echo e(html()->form('GET', '/top/history/mail/change')->attribute('name', 'frmmailchg')->open()); ?>

<?php echo e(html()->hidden('chg_order_num', $orderheader->web_order_num)); ?>

<?php echo e(html()->hidden('old_mail_addr', $orderheader->license_mail_address)); ?>

<?php echo e(html()->form()->close()); ?>


<br /><table width="550px">
	<tr>
		<td>
		<h4>▼注文履歴 詳細</h4>
		</td>
	</tr>
</table>

<table border="0">
	<?php if($orderheader->delete_ok == 1): ?>
	<tr>
		<td width="60px"></td>
		<td align="left">
			<span id="essential">※</span>「削除」をクリックすると、ご注文がキャンセルされます。<br />
		</td>
	<tr>
	<?php endif; ?>
	<tr>
		<td align="center" colspan="2">
		<br /><table class="select" border="1" cellspacing="0" frame="hsides" rules="rows">
			<tr>
				<td class="item" width="150px">
				現在のステータス</td>
				<td width="250px">
					<?php $__currentLoopData = $orderStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php if($orderheader->state_type == $stat->order_status_id): ?>
							<?php echo e($stat->order_status_name); ?>

						<?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</td>
			</tr>
			<tr>
				<td class="item">受付No.</td>
				<td><?php echo e($orderheader->web_order_num); ?></td>
			</tr>
			<tr>
				<td class="item">受付日</td>
				<td><?php echo e($orderheader->dwo_last_update); ?></td>
			</tr>
			<tr>
				<td class="item">出荷予定日</td>
				<td>
					<?php if(!empty($orderheader->shipping_date) ): ?>
						<?php echo e($orderheader->shipping_date2); ?></td>
					<?php else: ?>
						&nbsp;
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td class="item">貴社発注担当者</td>
				<td><?php echo e($orderheader->dwo_order_person_name); ?></td>
			</tr>
			<tr>
				<td class="item">サプライ二重梱包</td>
				<td><?php if($orderheader->double_package_type == "1"): ?>有<?php else: ?>無<?php endif; ?></td>
			</tr>
			<tr>
				<td class="item">納品先 名称</td>
				<td><?php echo e($orderheader->dest_name1); ?><?php echo e($orderheader->dest_name2); ?></td>
			</tr>
			<tr>
				<td class="item">納品先 郵便番号</td>
				<td><?php echo e($orderheader->dest_post); ?></td>
			<tr>
				<td class="item">納品先 住所1</td>
				<td>
				<?php $__currentLoopData = $prefList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $klist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php if($klist->pref_cd == $orderheader->dest_pref_cd): ?><?php echo e($klist->pref_name); ?><?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php echo e($orderheader->dest_address1); ?><?php echo e($orderheader->dest_address2); ?>

				</td>
			</tr>
			<tr>
				<td class="item">納品先 住所2</td>
				<td><?php echo e($orderheader->dest_address3); ?></td>
			</tr>
			<tr>
				<td class="item">納品先 担当者</td>
				<td><?php echo e($orderheader->dest_contact_name1); ?></td>
			</tr>
			<tr>
				<td class="item">納品先電話番号</td>
				<td><?php echo e($orderheader->dest_tel); ?></td>
			</tr>
			<tr>
				<td class="item">納品先fax番号</td>
				<td><?php echo e($orderheader->dest_fax); ?></td>
			<tr>
				<td class="item">伝票添付</td>
				<td><?php if($orderheader->direct_delivery_type == "1"): ?>無<?php else: ?>有<?php endif; ?></td>
			</tr>
			<tr>
				<td class="item">備考</td>
				<td><?php echo e($orderheader->deliver_memo); ?></td>
			</tr>
		</table>
		</td>
	</tr>
</table>

<table border="0" cellpadding="0" cellspacing="0" width="100%"> 
	<tr>
		<td colspan="2">
			<br />
			<table border="0" cellpadding="0" cellspacing="0"> 
			<?php if($orderheader->reti_state_type == '2'): ?>
			<tr>
				<td>
					<table width="700px" border="0" cellspacing="0">
					<tr>
						<td>
						</td>
					</tr>
					</table>
				</td>
				<td>　</td>
				<td>
					<table border="1" cellspacing="0">
					<tr>
						<td nowrap width="120px" bgcolor="#cccccc">左記のうち、返品</td>
					</tr>
					</table>
				</td>
			</tr>
			<?php endif; ?>
			<tr>
				<td>
					<table width="800px" border="1" cellspacing="0">
					<tr>
						<td nowrap class="item">貴社発注No.</td>
						<td nowrap width="80px" class="item">商品コード</td>
						<td nowrap width="300px" class="item">商品名称</td>
						<td nowrap width="60px" class="item">提供価格</td>
						<td nowrap width="30px" class="item">数量</td>
						<td nowrap width="60px" class="item">金額</td>
						<td nowrap width="60px" class="item">消費税</td>
						<td nowrap width="60px" class="item">消費税率</td>
					</tr>
					</table>
				</td>
				<?php if($orderheader->reti_state_type == '2'): ?>
				<td>　</td>
				<td>
					<table border="1" cellspacing="0">
					<tr>
						<td nowrap width="60px" bgcolor="#cccccc">返品数量</td>
						<td nowrap width="60px" bgcolor="#cccccc">返品金額</td>
					</tr>
					</table>
				</td>
				<?php endif; ?>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">
		<table border="0" cellpadding="0" cellspacing="0"> 
			<?php $__currentLoopData = $orderdetailList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detaillist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td>
					<table width="800px" border="1" cellspacing="0">
					<tr>
						<td nowrap><?php echo e($detaillist->cust_order_num); ?>&nbsp;</td>
						<td nowrap width="80px"><?php echo e($detaillist->item_cd); ?></td>
						<td nowrap width="300px"><?php echo e($detaillist->item_name_kanji); ?><?php if($orderheader->contents_type=="54" || $orderheader->contents_type=="55"): ?><br>サポートプランアップグレード<?php endif; ?></td>
						<td nowrap width="60px" align="right">\&nbsp;<?php echo e(number_format($detaillist->item_price)); ?></td>
						<td nowrap width="30px" align="right"><?php echo e(number_format($detaillist->item_vol)); ?></td>
						<td nowrap width="60px" align="right">\&nbsp;<?php echo e(number_format($detaillist->item_amt)); ?></td>
						<td nowrap width="60px" align="right">\&nbsp;<?php echo e(number_format($detaillist->tax)); ?></td>
						<td nowrap width="60px" align="right"><?php if(!empty($detaillist->tax_rate)): ?><?php echo e($detaillist->tax_rate * 100); ?>%<?php endif; ?></td>
					</tr>
					</table>
				</td>
				<?php if($orderheader->reti_state_type == '2'): ?>
				<td>　</td>
				<td valign="top">
					<table border="1" cellspacing="0">
					<tr>
						<td  valign="top" nowrap width="60px" align="right"><font color="red">&nbsp; <?php if($detaillist->reti_vol == ""): ?>0 <?php else: ?><?php echo e(number_format($detaillist->reti_vol)); ?><?php endif; ?></font></td>
						<td  valign="top" nowrap width="60px" align="right"><font color="red">\&nbsp; <?php if($detaillist->reti_price == ""): ?>0 <?php else: ?><?php echo e(number_format($detaillist->reti_price)); ?><?php endif; ?></font></td>
					</tr>
					</table>
				</td>
				<?php endif; ?>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</table>
		</td>
	</tr>
	<tr>
		<td align="right" colspan="2">　</td>
	</tr>
	<tr>
		<td colspan="2">
			<table border="0" cellpadding="0" cellspacing="0"> 
			<tr>
				<td>
					<table width="800px" border="0" cellspacing="0" cellpadding=0>
					<tr>
						<td nowrap width="550px">　</td>
						<td align="right">
							<table border="1" cellspacing="0">
							<tr>
								<td nowrap width="60px" class="item">税抜額</td>
								<td nowrap width="60px" align="right">\&nbsp;<?php echo e(number_format($orderheader->order_amt)); ?></td>
							</tr>
							<tr>
								<td nowrap width="60px" class="item">消費税</td>
								<td nowrap width="60px" align="right">\&nbsp;<?php echo e(number_format($orderheader->tax)); ?></td>
							</tr>
							<tr>
								<td nowrap width="60px" class="item">合計</td>
								<td nowrap width="60px" align="right">\&nbsp;<?php echo e(number_format($orderheader->total_amt)); ?></td>
							</tr>
							</table>
						</td>
					</tr>
					</table>
				<td>　</td>

				<?php if($orderheader->reti_state_type == '2'): ?>
				<td>
					<table border="1" cellspacing="0" cellpadding=0>
					<tr>
						<td nowrap width="60px" bgcolor="#cccccc">返品合計</td>
						<td nowrap width="60px" align="right"><font color="red">\&nbsp;<?php echo e(number_format($orderheader->distri_reti_total_amt)); ?></font></td>
					</tr>
					</table>
				</td>
				<?php endif; ?>
			</tr>
		</table>
		</td>
	</tr>
</table>
<br>
<table border="0" width="95%">
	<tr>
		<td width="30%">&nbsp;</td>
		<td width="40%" align="center">
		<?php if($orderheader->delete_ok == 1 ): ?>
			<?php if($orderheader->contents_type == "54" || $orderheader->contents_type == "55"): ?>
				<a href="javascript:printPreviewUpgrade();"><img src="<?php echo e(asset('assets/cust/img/print.png')); ?>" alt="注文書印刷" width="120px" height="50px"></a>
			<?php else: ?>
				<a href="javascript:printPreview();"><img src="<?php echo e(asset('assets/cust/img/print.png')); ?>" alt="注文書印刷" width="120px" height="50px"></a>
			<?php endif; ?>
		<?php else: ?>
				&nbsp;
		<?php endif; ?>
		</td>
		<td width="30%" align="right">
		<?php if($orderheader->delete_ok == 1): ?>
			<a href="javascript:delSubmit();"><img src="<?php echo e(asset('assets/cust/img/delete.png')); ?>" alt="削除" width="120px" height="50px"></a>
		<?php else: ?>
			&nbsp;
		<?php endif; ?>
		</td>
	</tr>
</table>


<?php if( !empty($orderheader->name1)): ?>
<table border="0">
	<tr>
		<td>
			<br /><br /><table class="select" width="400px" border="1" cellspacing="0" frame="hsides" rules="rows">
				<tr>
					<td class="item" width="200px">登録名義</td>
					<td><?php echo e($orderheader->name1); ?><?php echo e($orderheader->name2); ?></td>
				</tr>
				<tr>
					<td class="item">登録名義(フリガナ)</td>
					<td><?php echo e($orderheader->name_kana1); ?></td>
				</tr>
				<tr>
					<td class="item">代表取締役または代表者</td>
					<td><?php echo e($orderheader->president_name1); ?></td>
				</tr>
				<tr>
					<td class="item">代表取締役または代表者(フリガナ)</td>
					<td><?php echo e($orderheader->president_name_kana1); ?></td>
				</tr>
				<tr>
					<td class="item">担当者</td>
					<td><?php echo e($orderheader->contact_name1); ?></td>
				</tr>
				<tr>
					<td class="item">担当者(フリガナ)</td>
					<td><?php echo e($orderheader->contact_name_kana1); ?></td>
				</tr>
				<tr>
				<?php if($orderheader->state_type == "4"): ?>
					<td class="item">メールアドレス　　
						<?php echo e(html()->submit('変更')->style('font-size:10px;')->attribute('onclick' , 'document.frmmailchg.submit();')); ?>

					</td>
				<?php else: ?>
					<td class="item">メールアドレス</td>
				<?php endif; ?>
					<td><?php echo e($orderheader->license_mail_address); ?></td>
				</tr>
				<tr>
					<td class="item">ホームページurl</td>
					<td><?php echo e($orderheader->url); ?></td>
				</tr>
				<tr>
					<td class="item">郵便番号</td>
					<td><?php echo e($orderheader->post); ?></td>
				</tr>
				<tr>
					<td class="item">都道府県市区町村</td>
					<td>
					<?php $__currentLoopData = $prefList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $klist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php if($klist->pref_cd == $orderheader->prefecture_cd): ?><?php echo e($klist->pref_name); ?><?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php echo e($orderheader->address1); ?>

					</td>
				</tr>
				<tr>
					<td class="item">丁番地</td>
					<td><?php echo e($orderheader->address2); ?></td>
				</tr>
				<tr>
					<td class="item">建物名</td>
					<td><?php echo e($orderheader->address3); ?></td>
				</tr>
				<tr>
					<td class="item">登録電話番号</td>
					<td><?php echo e($orderheader->tel); ?></td>
				</tr>
				<tr>
					<td class="item">連絡先電話番号</td>
					<td><?php echo e($orderheader->communicate_tel); ?></td>
				</tr>
				<tr>
					<td class="item">連絡先fax番号</td>
					<td><?php echo e($orderheader->fax); ?></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<?php endif; ?>


<br /><a href="javascript:history.back();"><img src="<?php echo e(asset('assets/cust/img/back.png')); ?>" width="120px" height="50px"></a>　<a href="javascript:window.close();"><img src="<?php echo e(asset('assets/cust/img/close.png')); ?>"></a>


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
<?php /**PATH /var/www/dwo2/resources/views/weborder/top/history2detail.blade.php ENDPATH**/ ?>