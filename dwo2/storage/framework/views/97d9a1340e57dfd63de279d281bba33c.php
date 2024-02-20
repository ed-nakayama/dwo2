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

<title>メニュー</title>

 <?php $__env->slot('menu', null, []); ?> 
	<?php echo App\Http\Controllers\Weborder\MenuManager::setMenu('home'); ?>

 <?php $__env->endSlot(); ?>

<?php if(session('agentView')->cust_class_code != "OR" && session('agentView')->cust_class_code != "YBP" ): ?>
 <?php $__env->slot('manual', null, []); ?> 
 <?php $__env->endSlot(); ?>
<?php endif; ?>



<div id="menu_userinfo">
<table border="0"  width="100%">
	<tr>
		<td class="userinfo" rowspan="3" valign="top">
			<?php echo $__env->make('weborder/common/userinfo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td height="50px">
						<p class="submenu">
							<a href="/top/condition" target="information">お取引条件</a>
							<a href="/top/history" target="information">注文履歴</a>
							<a href="/top/registrationinfo" target="information">ご登録情報</a>
							<?php if($orderinfo->pap_order == 1): ?>
								<a href="/top/ordermethod">ご注文の流れ</a>
							<?php endif; ?>
						</p>
					</td>
				</tr>
				<tr>
					<td>
						<iframe src="/top/condition" height="150" width="380" marginwidth="0px" frameborder="0" name="information"></iframe>
					</td>
				</tr>
				<tr>
					<td align="center"></td>
				</tr>
			</table>
		</td>
		<td>
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<p class="sidebar" style="width:347px">お知らせ</p>
					</td>
				</tr>
				<tr>
					<td>
						<iframe src="/common/information" width="360px" height="540px" frameborder="0"></iframe>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</div>

<div class="next">

<script type="text/javascript"><!--
function on_submit() {
	location.href = "/item/select";
 }
 // --></script>

	<a href="javascript:on_submit();">
	<img src="<?php echo e(asset('assets/cust/img/confirmation.png')); ?>" alt="商品選択" width="120px" height="50px"></a>
</div>
<p class="top_attention">
	<span id="essential">※</span>小ロットサプライは、システムの都合上Webオーダーではご注文できません。<br/>&nbsp;&nbsp;&nbsp;お手数ですがカスタマーセンター<?php if($orderinfo->cust_kbn == "OR" || $orderinfo->cust_kbn == "YBP"): ?>（0120-500-980）<?php else: ?>（0120-714-841）<?php endif; ?>へお問い合わせください。<br/>
</p>



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
<?php /**PATH /var/www/dwo2/resources/views/weborder/top/home.blade.php ENDPATH**/ ?>