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
	<title>商品サブマスタ</title>
</head>



<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <font color=red><li><?php echo e($error); ?></font></li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php echo e(html()->form('GET', '/admin/product/list/search')->open()); ?>


<TABLE border=1>
  <TR>
     <TD  colspan=6 nowrap align="center" bgcolor="#0000a0"><FONT color="White">商品サブマスタ</FONT></TD>
  </TR>

  <TR bgcolor="#8080ff">
    <TD nowrap align="center"><FONT color="white">商品コード</FONT></TD>
    <TD nowrap align="center"><FONT color="white">Web利用(可)</FONT></TD>
    <TD nowrap align="center"><FONT color="white">在庫状況</FONT></TD>
    <TD nowrap align="center"><FONT color="white">削除</FONT></TD>
    <TD nowrap align="center"><FONT color="white">新規</FONT></TD>
    <TD nowrap align="center"><FONT color="white">検索</FONT></TD>
  </TR>
  <TR>
    <TD nowrap align="center">
		<?php echo e(html()->text('prodCode', $prodCode)->attribute('size', '12')); ?>

    </TD>
    <TD nowrap align="center">
		<?php echo e(html()->checkbox('webOrder', $webOrder ,'1')); ?>

    </TD>
    <TD nowrap>
    <SELECT name="status">
      <OPTION value="">
		<?php $__currentLoopData = $productStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php echo e(html()->option($list->prod_status_name, $list->prod_status_id ,($list->prod_status_id == $status))); ?>

		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </SELECT>
    </TD>
    <TD nowrap align="center">
		<?php echo e(html()->checkbox('del', $del ,'1')); ?>

    </TD>
    <TD nowrap align="center">
		<?php echo e(html()->checkbox('newFlag', $newFlag ,'1')); ?>

    </TD>
    <TD nowrap align="center">
		<?php echo e(html()->submit('検索')); ?>

    </TD>
  </TR>
</TABLE>
<?php echo e(html()->form()->close()); ?>

    <BR>

<?php echo e(html()->form('POST', '/admin/product/list/store')->open()); ?>

<?php echo e(html()->hidden('prodCode', $prodCode)); ?>

<?php echo e(html()->hidden('webOrder', $webOrder)); ?>

<?php echo e(html()->hidden('status', $status)); ?>

<?php echo e(html()->hidden('del', $del)); ?>

<?php echo e(html()->hidden('newFlag', $newFlag)); ?>


<?php if(isset($prodList[0])): ?>
    <TABLE cellspacing="0" cellpadding="2" width="100%">
      <TR>
        <td nowrap colspan="2" align="center">
			<div class="pager">
				<?php echo e($prodList->appends(request()->query())->links('vendor.pagination.admin')); ?>

			</div>
		</td>
      </TR>
      <TR>
		<TH nowrap bgcolor="#8080c0" width="20"><FONT color="White">件数 <?php echo e(number_format($prodList->total())); ?></FONT></TH>
		<td></td>
      </TR>
    </TABLE>
<?php endif; ?>

<TABLE width="600" border="1" cellspacing="0" cellpadding="2">

	<TR bgcolor="#8080c0">
    	<TD nowrap align="center"><FONT color="white">商品コード</FONT></TD>
    	<TD nowrap align="center"><FONT color="white">商品名称</FONT></TD>
    	<TD nowrap align="center"><FONT color="white">通常製品参考価格</FONT></TD>
	    <TD nowrap align="center"><FONT color="white">販売開始日<br><font size=2>(YYYY/MM/DD)</FONT></FONT></TD>
	    <TD nowrap align="center"><FONT color="white">販売終了日<br><font size=2>(YYYY/MM/DD)</FONT></FONT></TD>
	    <TD nowrap align="center"><FONT color="white">在庫状況</FONT></TD>
	    <TD nowrap align="center"><FONT color="white">出荷可能日<br><font size=2>(YYYY/MM/DD)</FONT></FONT></TD>
	    <TD nowrap align="center"><FONT color="white">Web利用(可)</FONT></TD>
	    <TD nowrap align="center"><FONT color="white">可視</FONT></TD>
	    <TD nowrap align="center"><FONT color="white">削除</FONT></TD>
	    <TD nowrap align="center"><FONT color="white">仕切価格</FONT></TD>
    </TR>

<?php if(isset($prodList[0])): ?>
	<?php $__currentLoopData = $prodList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<TR>
			<TD nowrap>
				<font size=2><?php echo e($prod->item_cd); ?></font>
				<?php echo e(html()->hidden('codeList[]', $prod->item_cd)); ?>

			</TD>
	        <TD nowrap><font size=2><?php echo e($prod->item_name_kanji); ?></font></TD>
	        <td nowrap style="background-color:#fffacd;">
				<?php echo e(html()->text("samplePriceList[{$prod->item_cd}]", $prod->sample_price)->attribute('style', 'background-color:#fffacd; text-align:right;')); ?>

	        </td>
	        <TD nowrap>
				<?php echo e(html()->date("startDateList[{$prod->item_cd}]",$prod->product_sales_start_date)); ?>

	        </TD>
	        <TD nowrap>
				<?php echo e(html()->date("endDateList[{$prod->item_cd}]", $prod->product_sales_stop_date)); ?>

	        </TD>
	        <TD nowrap>
	        	<SELECT name="statusList[<?php echo e($prod->item_cd); ?>]">
			        <OPTION value="">
					<?php $__currentLoopData = $productStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php echo e(html()->option($list->prod_status_name, $list->prod_status_id ,($list->prod_status_id == $prod->product_status_id))); ?>

					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</option>
				</select>
	        </TD>
	        <TD nowrap>
				<?php echo e(html()->date("shipDateList[{$prod->item_cd}]", $prod->product_ship_date)); ?>

	        </TD>
	        <TD nowrap>
				<?php echo e(html()->checkbox("webOrderList[{$prod->item_cd}]", $prod->product_web_order_flag ,$prod->item_cd)); ?>

	        </TD>
	        <TD nowrap>
				<?php echo e(html()->checkbox("visiblePAPStdList[{$prod->item_cd}]", $prod->product_visible_pap_std ,$prod->item_cd)); ?><font size=2>PAP-M</font>
				<?php echo e(html()->checkbox("visiblePAPGoldList[{$prod->item_cd}]", $prod->product_visible_pap_gld ,$prod->item_cd)); ?><font size=2>PAP-G</font>
				<?php echo e(html()->checkbox("visibleYbpPapList[{$prod->item_cd}]", $prod->product_visible_ybp_pap ,$prod->item_cd)); ?><font size=2>パートナー</font>
				<?php echo e(html()->checkbox("visibleYBPList[{$prod->item_cd}]", $prod->product_visible_ybp ,$prod->item_cd)); ?><font size=2>通常製品</font>　
	        </TD>
	        <TD nowrap>
				<?php echo e(html()->checkbox("delList[{$prod->item_cd}]", $prod->product_del ,$prod->item_cd)); ?>

	        </TD>
	        <TD nowrap><a  class="link"  href="/admin/product/price?prodCode=<?php echo e($prod->item_cd); ?>&prodName=<?php echo e($prod->item_name_kanji); ?>"><font size=2>仕切価格</font></a></TD>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		<TR>
        	<TD nowrap colspan=10 align="center">
			<?php if(session('status') === 'success-store'): ?>
				<p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm text-blue-400 dark:text-blue-400" style="color: blue;">更新が完了しました。</p>
			<?php endif; ?>
				<?php echo e(html()->submit('更新')); ?>

        	</TD>
      	</TR>

   </TABLE>

    <TABLE cellspacing="0" cellpadding="2" width="100%">
      <TR>
        <TH nowrap bgcolor="#8080c0" width="20"><FONT color="White">件数 <?php echo e(number_format($prodList->total())); ?></FONT></TH>
		<td></td>
      </TR>
      <TR>
        <td nowrap colspan="2" align="center">
			<div class="pager">
				<?php echo e($prodList->appends(request()->query())->links('vendor.pagination.admin')); ?>

			</div>
		</td>
      </TR>
    </TABLE>


<?php endif; ?>

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
<?php /**PATH /var/www/dwo2/resources/views/admin/product/list.blade.php ENDPATH**/ ?>