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
	<title>受注編集詳細 (WEB受注)</title>
</head>



<script type="text/javascript">
<!--
	function calc(o_num) {
		var taxRate = document.getElementsByName('itemTaxRate[]')[o_num].value;
		var vol = document.getElementsByName('itemVol[]')[o_num].value;
		var price = document.getElementsByName('itemPrice[]')[o_num].value;
		var total = vol * price;

		document.getElementsByName('itemAmt[]')[o_num].value = total;
		document.getElementsByName('itemAmtDummy[]')[o_num].value = total;

		if (taxRate != "") {
			var tax = Math.floor(total * taxRate);

			document.getElementsByName('itemTax[]')[o_num].value = tax;
			document.getElementsByName('itemTaxDummy[]')[o_num].value = tax;
		}

		totalCalc();
	}


	function totalCalc() {
		var i;
		var j;
		var sum = 0;
		var taxSum = 0;
		var temp;

		for (i = 0; i < <?php echo e($detailViewList->count()); ?>; i++) {
			if (document.getElementsByName('itemDel[]')[i].checked == true) {
			} else {
				sum = eval(sum + "+" + document.getElementsByName('itemAmt[]')[i].value);
				if (document.getElementsByName('itemTax[]')[i].value != '') {
					taxSum = eval(taxSum + "+" + document.getElementsByName('itemTax[]')[i].value);
				}
			}
		}

		document.dtl.orderAmt.value = sum;
		document.dtl.orderAmtDummy.value = sum;

		if (taxSum == 0) {
			var taxRate = document.dtl.taxRate.value;
			document.dtl.tax.value = Math.floor(sum * taxRate);
			document.dtl.taxDummy.value = document.dtl.tax.value;
		} else {
			document.dtl.tax.value = taxSum;
			document.dtl.taxDummy.value = taxSum;
		}

		document.dtl.totalAmt.value = eval(sum + "+" + document.dtl.tax.value);
		document.dtl.totalAmtDummy.value = document.dtl.totalAmt.value;
	}



	function prod_search(num) {
		if (document.getElementsByName('itemCd[]')[num].value == "") {
			alert("商品コード号を入力してください。");
			document.getElementsByName('itemCd[]')[num].focus();
			return;
		}

		document.frmProd.num.value = num;
		document.frmProd.prodCode.value = document.getElementsByName('itemCd[]')[num].value;
		document.frmProd.custNum.value = "<?php echo e($headerView->cust_num); ?>";

		w = window.open("", "prodWin", "width=640,height=480,scrollbars=yes");
		if (w) {
			document.frmProd.submit();
		}
	}

	function setProd(p_num ,p_code ,p_name ,p_price) {
		document.getElementsByName('itemCd[]')[p_num].value = p_code;
		document.getElementsByName('itemName[]')[p_num].value = p_name;
		document.getElementsByName('itemPrice[]')[p_num].value = p_price;
		document.getElementsByName('itemPriceDummy[]')[p_num].value = p_price;

		calc(p_num);

	}


	function updateDtlX() {
		var res = confirm("更新してもいいですか？");
		// 選択結果で分岐
		if (res == true) {
			document.dtl.submit();
		}
	}


	function updateMailX() {
		var res = confirm("更新後、メール送信してもいいですか？");
		// 選択結果で分岐
		if (res == true) {
			document.dtl.updateMail.value = "1";
			document.dtl.submit();
		}
	}

-->
</script>

<?php echo e(html()->form('GET', '/admin/order/list2/search/prod')->attributes(['name'=> 'frmProd', 'target' => 'prodWin'])->open()); ?>

<?php echo e(html()->hidden('num')); ?>

<?php echo e(html()->hidden('prodCode')); ?>

<?php echo e(html()->hidden('custNum')); ?>

<?php echo e(html()->form()->close()); ?>



<?php echo e(html()->form('POST', '/admin/order/list2/store')->attribute('name', 'dtl')->open()); ?>

<?php echo e(html()->hidden('orderNum' ,$headerView->web_order_num)); ?>

<?php echo e(html()->hidden('contentsType' ,$headerView->contents_type)); ?>


<DIV align="left">
<TABLE>
<TR>
	<TD nowrap align="center" bgcolor="#0000a0"><FONT color="White">受注編集詳細 (WEB受注)</FONT></TD>
</TR>
<TR>
	<TD nowrap align="center">　</TD>
</TR>
<TR>
    <TD nowrap align="center">
    <DIV align="left">

      <TABLE width="350" border="1" cellspacing="0" cellpadding="2">
	<TR>
		<TD width="40%" nowrap align="left" bgcolor="#8080c0"><FONT color="white">現在のステータス</FONT></TD>
		<TD nowrap>
			<SELECT name="stateType">
				<OPTION selected value=""></option>
				<?php $__currentLoopData = $orderStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php echo e(html()->option($st->order_status_name, $st->order_status_id ,($headerView->state_type == $st->order_status_id))); ?>

				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>}
			</SELECT>
		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">得意先 名称</FONT></TD>
		<TD nowrap><?php echo e($headerView->search_name); ?></TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">受付No.</FONT></TD>
		<TD nowrap><?php echo e($headerView->web_order_num); ?></TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">受付日</FONT></TD>
		<TD nowrap>
			<?php echo e(html()->text('orderDate', $headerView->order_date)->attributes(['size' => '10', 'maxlength' => '8'])); ?>

		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">出荷日</FONT></TD>
		<TD nowrap>
			<?php echo e(html()->text('shippingDate', $headerView->shipping_date)->attributes(['size' => '10', 'maxlength' => '8'])); ?>

		</TD>
	</TR>
	<TR>
		<TD nowrap align="light" bgcolor="#8080c0"><FONT color="White">発注担当者</FONT></TD>
		<TD nowrap>
			<?php echo e(html()->text('orderPersonName', $headerView->dwo_order_person_name)->attributes(['size' => '15', 'maxlength' => '15'])); ?>　様
		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">サプライ二重梱包</FONT></TD>
		<TD nowrap>
			<?php echo e(html()->checkbox('doublePackageType', $headerView->double_package_type ,'1')); ?>

		</TD>
	</TR>
	
<?php if($headerView->state_type != '1'): ?>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">着日指定</FONT></TD>
		<TD nowrap>
			<?php echo e(html()->checkbox('deliveryDateType', $headerView->delivery_date_type ,'1')); ?>

		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">着日</FONT></TD>
		<TD nowrap>
			<?php echo e(html()->text('deliveryDate', $headerView->delivery_date)->attributes(['size' => '10', 'maxlength' => '8'])); ?>

		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">AM指定</FONT></TD>
		<TD nowrap>
			<?php echo e(html()->checkbox('deliveryTimeType', $headerView->delivery_time_type ,'1')); ?>

		</TD>
	</TR>
<?php else: ?>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">着日指定</FONT></TD>
		<TD nowrap>
			<?php echo e(html()->hidden('deliveryDateType' ,$headerView->delivery_date_type)); ?>

			 <?php if($headerView->delivery_date_type == '1'): ?>あり<?php else: ?>なし<?php endif; ?>
		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">着日</FONT></TD>
		<TD nowrap>
			<?php echo e(html()->hidden('deliveryDate' ,$headerView->delivery_date)); ?>

			<?php echo e($headerView->delivery_date); ?>

		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">AM指定</FONT></TD>
		<TD nowrap>
			<?php echo e(html()->hidden('deliveryTimeType' ,$headerView->delivery_time_type)); ?>

			<?php if($headerView->delivery_time_type == '1'): ?>あり<?php else: ?>なし<?php endif; ?>
		</TD>
	</TR>
<?php endif; ?>

<?php if($headerView->state_type == '0' || $headerView->state_type == '5' || $headerView->state_type == '8' || $headerView->state_type == '9'): ?>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 名称</FONT></TD>
		<TD nowrap>
			<?php echo e(html()->text('destName1', $headerView->dest_name1)->attribute('size', '50')); ?>

		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 郵便番号</FONT></TD>
		<TD nowrap>
			<?php echo e(html()->text('destPost', $headerView->dest_post)); ?>

		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 都道府県</FONT></TD>
		<TD nowrap>
			<SELECT name="destPrefCd">
				<?php echo e(html()->option('')); ?>

				<?php $__currentLoopData = $prefList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pref): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php echo e(html()->option($pref->pref_name, $pref->pref_cd ,($headerView->dest_pref_cd == $pref->pref_cd))); ?>

				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</SELECT>
		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 住所1</FONT></TD>
		<TD nowrap>
			<?php echo e(html()->text('destAddress1', $headerView->dest_address1)->attribute('size', '50')); ?>

		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 住所2</FONT></TD>
		<TD nowrap>
			<?php echo e(html()->text('destAddress2', $headerView->dest_address2)->attribute('size', '50')); ?>

		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 住所3</FONT></TD>
		<TD nowrap>
			<?php echo e(html()->text('destAddress3', $headerView->dest_address3)->attribute('size', '50')); ?>

		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 担当者</FONT></TD>
		<TD nowrap>
			<?php echo e(html()->text('destContactName1', $headerView->dest_contact_name1)); ?>

		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 電話番号</FONT></TD>
		<TD nowrap>
			<?php echo e(html()->text('destTel', $headerView->dest_tel)); ?>

		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 FAX番号</FONT></TD>
		<TD nowrap>
			<?php echo e(html()->text('destFax',$headerView->dest_fax)); ?>

		</TD>
	</TR>
<?php else: ?>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 名称</FONT></TD>
		<TD nowrap>
			<?php echo e(html()->hidden('destName1', $headerView->dest_name1)); ?>

			<?php echo e($headerView->dest_name1); ?>

		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 郵便番号</FONT></TD>
		<TD nowrap>
			<?php echo e(html()->hidden('destPost', $headerView->dest_post)); ?>

			<?php echo e($headerView->dest_post); ?>

		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 都道府県</FONT></TD>
		<TD nowrap>
			<?php echo e(html()->hidden('destPrefCd', $headerView->dest_pref_cd)); ?>

			<?php $__currentLoopData = $prefList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pref): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if($headerView->dest_pref_cd == $pref->pref_cd): ?>
					<?php echo e($pref->pref_name); ?>

				<?php break; ?>;
				<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 住所1</FONT></TD>
		<TD nowrap>
			<?php echo e(html()->hidden('destAddress1', $headerView->dest_address1)); ?>

			<?php echo e($headerView->dest_address1); ?>

		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 住所2</FONT></TD>
		<TD nowrap>
			<?php echo e(html()->hidden('destAddress2', $headerView->dest_address2)); ?>

			<?php echo e($headerView->dest_address2); ?>

		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 住所3</FONT></TD>
		<TD nowrap>
			<?php echo e(html()->hidden('destAddress3', $headerView->dest_address3)); ?>

			<?php echo e($headerView->dest_address3); ?>

		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 担当者</FONT></TD>
		<TD nowrap>
			<?php echo e(html()->hidden('destContactName1', $headerView->dest_contact_name1)); ?>

			<?php echo e($headerView->dest_contact_name1); ?>

		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 電話番号</FONT></TD>
		<TD nowrap>
			<?php echo e(html()->hidden('destTel', $headerView->dest_tel)); ?>

			<?php echo e($headerView->dest_tel); ?>

			</TD>
		</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">納品先 FAX番号</FONT></TD>
		<TD nowrap>
			<?php echo e(html()->hidden('destFax', $headerView->dest_fax)); ?>

			<?php echo e($headerView->dest_fax); ?>

		</TD>
	</TR>
<?php endif; ?>

	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">直送(伝票添付なし)</FONT></TD>
		<TD nowrap>
			<?php echo e(html()->checkbox('directDeliveryType', $headerView->direct_delivery_type ,'1')); ?>

		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="white">備考</FONT></TD>
		<TD nowrap></TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">ユーザ削除</FONT></TD>
		<TD nowrap>
			<?php echo e(html()->checkbox('custDelType', $headerView->cust_del_type ,'1')); ?>

		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#8080c0"><FONT color="White">オペレータ削除</FONT></TD>
		<TD nowrap>
			<?php echo e(html()->checkbox('operatorDelType', $headerView->operator_del_type ,'1')); ?>

		</TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#008080"><FONT color="White">[摘要項目]PAP事業所コード</FONT></TD>
		<TD nowrap><?php echo e($secondaryCustNum); ?></TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#008080"><FONT color="White">[摘要項目]PAP事業所名</FONT></TD>
		<TD nowrap><?php echo e($secondaryCustName); ?></TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#008080"><FONT color="White">[摘要項目]登録ユーザー名</FONT></TD>
		<TD nowrap><?php echo e($headerView->reg_name1); ?></TD>
	</TR>
	<TR>
		<TD nowrap align="left" bgcolor="#008080"><FONT color="White">[摘要項目]メモ</FONT></TD>
		<TD nowrap><?php echo e($headerView->deliver_memo); ?></TD>
	</TR>
</TABLE>
</DIV>
<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <font color=red><li><?php echo e($error); ?></font></li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<TABLE border="0">
	<tr>
		<td align="right">受注内容区分:<?php echo e($headerView->contents_type); ?>　　明細行数：<?php echo e($detailViewList->count()); ?></td>
	</tr>
	<tr>
		<td>
			<TABLE width="600" border="1" cellspacing="0" cellpadding="2">
				<TR bgcolor="#8080c0">
					<TH nowrap align="center"><FONT color="White">No.</FONT></TH>
					<TH nowrap align="center"><FONT color="White">貴社発注No.</FONT></TH>
					<TH nowrap align="center"><FONT color="White">商品コード</FONT></TH>
					<TH nowrap align="center"><FONT color="White">商品名称</FONT></TH>
					<TH nowrap align="center"><FONT color="White">ご提供価格</FONT></TH>
					<TH nowrap align="center"><FONT color="White">数量</FONT></TH>
					<TH nowrap align="center"><FONT color="White">金額</FONT></TH>
					<TH nowrap align="center"><FONT color="White">消費税率</FONT></TH>
					<TH nowrap align="center"><FONT color="White">消費税</FONT></TH>
					<?php if($headerView->contents_type  == '40' || $headerView->contents_type  == '81' || $headerView->contents_type  == '82'): ?>
						<TH nowrap align="center"><FONT color="White">削除</FONT></TH>
					<?php endif; ?>
				</tr>

				<?php $__currentLoopData = $detailViewList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php if($headerView->contents_type  == '40' || $headerView->contents_type  == '81' || $headerView->contents_type  == '82'): ?>
						<TR>
							<?php echo e(html()->hidden('orderLineNum[]', $list->order_line_num)); ?>

							<TD nowrap align="right"><?php echo e($list->order_line_num); ?></TD>
							<TD nowrap align="center">
								<?php echo e(html()->text('custOrderNum[]', $list->cust_order_num)->attribute('size', '20')); ?>

							</TD>
							<TD nowrap align="center"><INPUT type="text" size="20" name="itemCd[]" value="<?php echo e($list->item_cd); ?>">
								<?php echo e(html()->submit('検索')->attribute('onclick', "prod_search($loop->index)")); ?>

							</TD>
							<TD nowrap align="left">
								<?php echo e(html()->text('itemName[]', $list->item_name_kanji)->attribute('size', '40')); ?>

							</TD>
							<TD nowrap align="right">
								<?php echo e(html()->hidden('itemPrice[]', $list->item_price)); ?>

								<?php echo e(html()->text('itemPriceDummy[]', $list->item_price)->attribute('size', '10')->disabled()); ?>

							</TD>
							<TD nowrap align="right"><INPUT size="10" type="text" onChange="calc(<?php echo e($loop->index); ?>)" name="itemVol[]" value="<?php echo e($list->item_vol); ?>"></TD>
							<TD nowrap align="right">
								<?php echo e(html()->hidden('itemAmt[]', $list->item_amt)); ?>

								<?php echo e(html()->text('itemAmtDummy[]', $list->item_amt)->attribute('size', '10')->disabled()); ?>

							</TD>
							<TD nowrap align="right">
								<?php echo e(html()->hidden('itemTaxRate[]', $list->tax_rate)); ?>

								<?php echo e(html()->text('itemTaxRateDummy[]', number_format($list->tax_rate,2))->attribute('size', '10')->disabled()); ?>

							</TD>
							<TD nowrap align="right">
								<?php echo e(html()->hidden('itemTax[]', $list->tax)); ?>

								<?php echo e(html()->text('itemTaxDummy[]', $list->tax)->attribute('size', '10')->disabled()); ?>

							</TD>
							<TD nowrap align="center">
								<?php echo e(html()->checkbox('itemDel[]', false, $list->order_line_num)->attribute('onClick', 'totalCalc();')); ?>

							</TD>
						</TR>
					<?php else: ?>
						<TR>
							<INPUT type="hidden" name="orderLineNum[]" value="<?php echo e($list->order_line_num); ?>">
							<TD nowrap align="right"><?php echo e($list->order_line_num); ?></TD>
			 				<TD nowrap align="center">
								<?php echo e(html()->hidden('custOrderNum[]', $list->cust_order_num)); ?>

								<?php echo e($list->cust_order_num); ?>

							</TD>
							 <TD nowrap align="center">
								<?php echo e(html()->hidden('itemCd[]', $list->item_cd)); ?>

								<?php echo e($list->item_cd); ?>

							</TD>
							<TD nowrap align="left"><?php echo e($list->item_name_kanji); ?></TD>
							<TD nowrap align="right">
								<?php echo e(html()->hidden('itemPrice[]', $list->item_price)); ?>

								<?php echo e(number_format($list->item_price)); ?>

							</TD>
							<TD nowrap align="right">
								<?php echo e(html()->hidden('itemVol[]', $list->item_vol)); ?>

								<?php echo e($list->item_vol); ?>

							</TD>
							<TD nowrap align="right">
								<?php echo e(html()->hidden('itemAmt[]', $list->item_amt)); ?>

								<?php echo e(number_format($list->item_amt)); ?>

							</TD>
							<TD nowrap align="right">
								<?php echo e(html()->hidden('itemTaxRate[]', $list->tax_rate)); ?>

								<?php echo e(number_format($list->tax_rate, 2)); ?>

							</TD>
							<TD nowrap align="right">
								<?php echo e(html()->hidden('itemTax[]', $list->tax)); ?>

								<?php echo e(number_format($list->tax)); ?>

							</TD>
						</TR>
					<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

			</TABLE>
		</td>
	</tr>
<tr>
	<td>
		<DIV align="right">
		<TABLE  align="right" border="1" cellspacing="0" cellpadding="2">
<?php if($headerView->contents_type == '40' || $headerView->contents_type == '81' || $headerView->contents_type == '82'): ?>
		<TR>
			<TD nowrap align="center" bgcolor="#8080c0"><FONT color="white">合計</FONT></TD>
			<TD align="right" bgcolor="white">
				<?php echo e(html()->hidden('orderAmt', $headerView->order_amt)); ?>

				<?php echo e(html()->text('orderAmtDummy', $headerView->order_amt)->attribute('size', '15')->disabled()); ?>

			</TD>
		</TR>
		<TR>
			<TD nowrap align="center" bgcolor="#8080c0"><FONT color="white">消費税率</FONT></TD>
			<TD align="right"bgcolor="white">
				<?php echo e(html()->hidden('taxRate', $headerView->tax_rate)); ?>

				<?php echo e(html()->text('taxRateDummy', number_format($headerView->tax_rate, 2))->attribute('size', '15')->disabled()); ?>

			</TD>
		</TR>
		<TR>
			<TD nowrap align="center" bgcolor="#8080c0"><FONT color="white">消費税</FONT></TD>
			<TD align="right"bgcolor="white">
				<?php echo e(html()->hidden('tax', $headerView->tax)); ?>

				<?php echo e(html()->text('taxDummy', $headerView->tax)->attribute('size', '15')->disabled()); ?>

			</TD>
		</TR>
		<TR>
			<TD nowrap align="center" bgcolor="#8080c0"><FONT color="white">総合計金額</FONT></TD>
			<TD align="right"bgcolor="white">
				<?php echo e(html()->hidden('totalAmt', $headerView->total_amt)); ?>

				<?php echo e(html()->text('totalAmtDummy', $headerView->total_amt)->attribute('size', '15')->disabled()); ?>

			</TD>
		</TR>
<?php else: ?>
		<TR>
			<TD nowrap align="center" bgcolor="#8080c0"><FONT color="white">合計</FONT></TD>
			<TD align="right"bgcolor="white">
				<?php echo e(html()->hidden('orderAmt', $headerView->order_amt)); ?>

				<?php echo e(number_format($headerView->order_amt)); ?>

			</TD>
		</TR>

		<TR>
			<TD nowrap align="center" bgcolor="#8080c0"><FONT color="white">消費税</FONT></TD>
			<TD align="right"bgcolor="white">
				<?php echo e(html()->hidden('tax', $headerView->tax)); ?>

				<?php echo e(number_format($headerView->tax)); ?>

			</TD>
		</TR>
		<TR>
			<TD nowrap align="center" bgcolor="#8080c0"><FONT color="white">総合計金額</FONT></TD>
			<TD align="right"bgcolor="white">
				<?php echo e(html()->hidden('totalAmt', $headerView->total_amt)); ?>

				<?php echo e(number_format($headerView->total_amt)); ?>

			</TD>
		</TR>
<?php endif; ?>
		</TABLE>
		</DIV>
	</td>
</tr>
<tr>
	<td align="center">
		<?php if(session('status') === 'success-store'): ?>
			<p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm text-blue-400 dark:text-blue-400" style="color: blue;">更新が完了しました。</p>
		<?php endif; ?>
	</td>
</tr>
<tr>
	<td align="center">
		<?php echo e(html()->hidden('updateMail')); ?>

		<?php echo e(html()->submit('　更新　')->attributes(['name' => 'updDtl', 'onclick' => "updateDtlX();return false;"])); ?>

		<?php echo e(html()->submit('更新後メール送信')->attributes(['name' => 'updMail', 'onclick' => "updateMailX();return false;"])); ?>

	</td>
</tr>
<?php echo e(html()->form()->close()); ?>

<tr>
	<td align="center">
		<BR>
	<?php if($headerView->contents_type == "54" || $headerView->contents_type == "55"): ?>
		<?php echo e(html()->form('POST', '/admin/order/list/detail/upgradeprint')->attributes(['name' => 'frmPrt', 'target' => '_blank'])->open()); ?>

	<?php else: ?>
		<?php echo e(html()->form('POST', '/admin/order/list/detail/printview')->attributes(['name' => 'frmPrt', 'target' => '_blank'])->open()); ?>

	<?php endif; ?>
		<?php echo e(html()->hidden('orderNum', $headerView->web_order_num)); ?>

		<?php echo e(html()->submit('注文確認書 発行')); ?>

		<?php echo e(html()->form()->close()); ?>

	</td>
</tr>
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
<?php /**PATH /var/www/dwo2/resources/views/admin/order/detail2.blade.php ENDPATH**/ ?>