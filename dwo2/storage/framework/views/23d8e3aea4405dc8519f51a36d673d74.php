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

<title>商品選択</title>

 <?php $__env->slot('menu', null, []); ?> 
	<?php echo App\Http\Controllers\Weborder\MenuManager::setMenu('itemselect'); ?>

 <?php $__env->endSlot(); ?>

<script type="text/javascript">
<!--
	function keyStrSearch() {

		var emptycnt=0;
		for(ii=0; ii<5; ++ii){
			if (document.frm.elements['frm_prod_code[]'][ii].value=="") {
				emptycnt=emptycnt+1;
			}
		}
		if ((emptycnt==5) && (document.frm.frm_prod_name.value=="")) {
			alert("商品コード、または商品名を入力して下さい。");
			return;
		}

		document.frm.frm_bigcode.value = "";
		document.frm.frm_midcode.value = "";
		document.frm.frm_salesstop.value = "";
		document.frm.frm_search_exec.value = "on";
		document.frm.submit();
	}

	function groupSearch(salesstop, cat_name) {
		selbox = document.getElementsByName(cat_name);
		selary = selbox[0].value.split(",");

		document.frm.frm_bigcode.value = selary[0];
		document.frm.frm_midcode.value = selary[1];
		document.frm.frm_salesstop.value = salesstop;
		document.frm.frm_search_exec.value = "on";
		document.frm.submit();
	}
-->
</script>


<div id="menu_userinfo">
<table border="0">
	<tr>
		<td class="userinfo" rowspan="3" valign="top">
			<?php echo $__env->make('weborder/common/userinfo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</td>
		<td>
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td valign="top">
						<p class="sidebar">買い物かご</p>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<iframe src="/common/shoppingcart" marginheight="4" marginwidth="2" width="385px"height="100px"frameborder="0"></iframe>
					</td>
				<tr>
			</table>
		</td>
	</tr>
</table>
</div>

<br /><table width="700px">
	<tr>
		<td>
		<h4>▼商品選択</h4>
		</td>
	</tr>
</table>

<?php echo e(html()->form('POST', '/item/detail')->attribute('name' , 'frm')->open()); ?>

<?php echo e(html()->hidden('frm_bigcode')); ?>

<?php echo e(html()->hidden('frm_midcode')); ?>

<?php echo e(html()->hidden('frm_salesstop')); ?>

<?php echo e(html()->hidden('frm_search_exec')); ?>


<table border="0" width="530px">
	<tr>
		<td class="search">
		▼商品を検索する
		</td>
	</tr>
	<tr>
		<td>
			<span id="essential">※</span>商品を検索する場合は最大5商品まで選択可能です。<br />
			<span id="essential">※</span>商品コード検索は，半角大文字で正しく入力しないと該当商品が表示されません。<br />
			<span id="essential">※</span>商品名の検索は「弥生会計」等のあいまい検索が可能です。
		</td>
	</tr>
	<tr>
		<td align="center">
			<table border="0">
				<tr>
					<td>
						<table class="item_search" border="1" cellspacing="0" frame="hsides" rules="none">
							<tr>
								<td class="item">商品コード検索</td>
								<td>&nbsp;&nbsp;
									<?php echo e(html()->text('frm_prod_code[]')->attributes(['size' => '10', 'maxlength' => '15'])); ?>&nbsp;
									<?php echo e(html()->text('frm_prod_code[]')->attributes(['size' => '10', 'maxlength' => '15'])); ?>&nbsp;
									<?php echo e(html()->text('frm_prod_code[]')->attributes(['size' => '10', 'maxlength' => '15'])); ?>&nbsp;
									<?php echo e(html()->text('frm_prod_code[]')->attributes(['size' => '10', 'maxlength' => '15'])); ?>&nbsp;
									<?php echo e(html()->text('frm_prod_code[]')->attributes(['size' => '10', 'maxlength' => '15'])); ?>&nbsp;
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table class="item_search" border="1" cellspacing="0" frame="hsides" rules="none">
							<tr>
								<td class="item" width="77px">商品名検索</td>
								<td>&nbsp;&nbsp;&nbsp;
									<?php echo e(html()->text('frm_prod_name')->attributes(['size' => '40', 'maxlength' => '50'])); ?>

								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td align="center">
					<br /><a href="javascript:keyStrSearch();"><img src="<?php echo e(asset('assets/cust/img/search.png')); ?>"></a>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<?php echo e(html()->form()->close()); ?>



<table width="530px">
	<tr>
		<td class="search">
			▼商品を選択して下さい
		</td>
	</tr>
	<tr>
		<td>
			<span id="essential">※</span>グループ名を選択した後、詳細へをクリックして下さい。<br />
			&nbsp;&nbsp;&nbsp;該当する商品とサプライ用品の一覧が表示されます。<br />
			<span id="essential">※</span>小ロットサプライは、システムの都合上Webオーダーではご注文できません。<br/>&nbsp;&nbsp;&nbsp;お手数ですがカスタマーセンター<?php if($orderinfo->cust_kbn == "OR" || $orderinfo->cust_kbn == "YBP"): ?>（0120-500-980）<?php else: ?>（0120-714-841）<?php endif; ?>へお問い合わせください。<br/>
		</td>
	</tr>
	<tr>
		<td align="center">
			<table class="select" border="0">
				<tr>
					<td colspan="2">
					▼&nbsp;販売中の<?php if($orderinfo->cust_kbn == "OR" || $orderinfo->cust_kbn == "YBP"): ?>弥生製品および<?php endif; ?>関連サプライ&nbsp;▼
					</td>
				</tr>

				<?php
					$f_found=false;
				?>
				<?php $__currentLoopData = $bigCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $big): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php if($big->big_category_old_product == '0'): ?>
					<tr>
						<td>
							<select name="category_<?php echo e($loop->index); ?>" style="width:400px">
								<option value="<?php echo e($big->big_category_code); ?>,">-- <?php echo e($big->big_category_name); ?> --

								<?php $__currentLoopData = $middleCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php if($mid->middle_big_category_code == $big->big_category_code): ?>
										<option value="<?php echo e($mid->big_category_code); ?>,<?php echo e($mid->middle_category_code); ?>"><?php echo e($mid->middle_category_name); ?>

									<?php endif; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</td>
						<td>&nbsp;&nbsp;
							<input type="button" value="詳細へ" onClick="groupSearch(0, 'category_<?php echo e($loop->index); ?>');" />
						</td>
					</tr>
					<?php
						$f_found=true;
					?>
					<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

				<?php if($f_found==false): ?>
					<tr>
						<td><font color="red">該当データがありません</font></td>
					</tr>
				<?php endif; ?>

				<tr>
					<td colspan="2"><br />▼&nbsp;過去に販売した弥生製品の関連サプライ&nbsp;▼</td>
				</tr>

				<?php
					$n_found=false;
				?>
				<?php $__currentLoopData = $bigCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $big): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php if($big->big_category_old_product == '1'): ?>
					<tr>
						<td>
							<select name="category_<?php echo e($loop->index); ?>" style="width:400px">
								<option value="<?php echo e($big->big_category_code); ?>,">-- <?php echo e($big->big_category_name); ?> --

								<?php $__currentLoopData = $middleCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php if($mid->middle_big_category_code == $big->big_category_code): ?>
										<option value="<?php echo e($mid->big_category_code); ?>,<?php echo e($mid->middle_category_code); ?>"><?php echo e($mid->middle_category_name); ?>

									<?php endif; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</td>
						<td>&nbsp;&nbsp;
							<input type="button" value="詳細へ" onClick="groupSearch(0, 'category_<?php echo e($loop->index); ?>');" />
						</td>
					</tr>
					<?php
						$n_found=true;
					?>
					<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

				<?php if($n_found==false): ?>
					<tr>
						<td><font color="red">該当データがありません</font></td>
					</tr>
				<?php endif; ?>

			</table>
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
<?php /**PATH /var/www/dwo2/resources/views/weborder/item/select.blade.php ENDPATH**/ ?>