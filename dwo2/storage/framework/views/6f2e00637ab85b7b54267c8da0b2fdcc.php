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

<title>貴社登録情報</title>

<table width="550px">
	<tr>
		<td>
		<h4 class="select">▼貴社登録情報</h4>
		</td>
	</tr>
</table>

<table class="select">
	<tr>
		<td>
		現在の貴社ご登録情報です。<br />
		ご登録のE-Mailアドレスへ、ご注文受付完了のメールを配信いたします。<br /><br />
		<span id="essential">※</span>住所等の変更がある場合には、
		<?php if(session('agentView')->cust_class_code == "YBP"): ?>
			<a href="http://partner.yayoi-kk.co.jp/ishop/" target="_blank">こちらへ</a>
		<?php elseif(session('agentView')->cust_class_code == "OR"): ?>
			<a href="http://partner.yayoi-kk.co.jp/ishop/" target="_blank">こちらへ</a>
		<?php else: ?>
			<a href="https://www.yayoi-kk.co.jp/pap/login/login.jsp" target="_blank">こちらへ</a>
		<?php endif; ?>
		<br />
		&nbsp;&nbsp;&nbsp;弥生会員専用ページにログイン（※）してご変更下さい。<br />
		&nbsp;&nbsp;&nbsp;（※）WebオーダーへログインするID・PWとは異なります
		</td>
	</tr>
	<tr>
		<td align="center">
		<br />
		<table width="350px" border="1" cellspacing="0" frame="hsides" rules="rows">
			<tr>
				<td class="item" width="35%">貴社コード</td>
				<td><?php echo e(session('agentView')->cust_num); ?></td>
			</tr>
			<tr>
				<td class="item">貴社名</td>
				<td><?php echo e(session('agentView')->name1 .  session('agentView')->name2); ?></td>
			</tr>
			<tr>
				<td class="item">郵便番号</td>
				<td><?php echo e(session('agentView')->post); ?></td>
			</tr>
			<tr>
				<td class="item">住所 1</td>
				<td><?php echo e(session('agentView')->pref .  session('agentView')->address1); ?></td>
			</tr>
			<tr>
				<td class="item">住所 2</td>
				<td><?php echo e(session('agentView')->address2); ?></td>
			</tr>
			<tr>
				<td class="item">住所 3</td>
				<td><?php echo e(session('agentView')->address3); ?></td>
			</tr>
			<tr>
				<td class="item">部署名</td>
				<td><?php echo e(session('agentView')->contact_department); ?></td>
			</tr>
			<tr>
				<td class="item">役職</td>
				<td><?php echo e(session('agentView')->contact_title); ?></td>
			</tr>
			<tr>
				<td class="item">ご担当者</td>
				<td><?php echo e(session('agentView')->contact_name1); ?>&nbsp;様</td>
			</tr>
			<tr>
				<td class="item">電話番号</td>
				<td><?php echo e(session('agentView')->tel); ?></td>
			</tr>
			<tr>
				<td class="item">FAX番号</td>
				<td><?php echo e(session('agentView')->fax); ?></td>
			</tr>
			<tr>
				<td class="item">E-Mail</td>
				<td><?php echo e(session('agentView')->mail_address); ?></td>
			<tr>
				<td class="item">E-Mail送信</td>
				<td><?php if(Auth::user()->profile_mail_flag == "1"): ?>可<?php else: ?>不可<?php endif; ?></td>
			</tr>
			<tr>
				<td class="item">請求締日</td>
				<td>毎月
					<?php if( session('agentView')->close_date1 == "99"): ?>末<?php else: ?><?php echo e(session('agentView')->close_date1); ?>日<?php endif; ?>締
				</td>
			</tr>
			<tr>
				<td class="item">お支払い条件</td>
				<td>
					<?php if( session('agentView')->pay_cycle1 == "0"): ?>
						当月
					<?php elseif( session('agentView')->pay_cycle1 == "1"): ?>
						翌月
					<?php elseif( session('agentView')->pay_cycle1 == "2"): ?>
						翌々月
					<?php endif; ?>
					<?php if( session('agentView')->pay_date1 == "99"): ?>末<?php else: ?><?php echo e(session('agentView')->pay_date1); ?>日<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td class="item">更新日</td>
				<td><?php echo e(Auth::user()->profile_update->format('Y/m/d')); ?></td>
			</tr>
		</table><br />
		</td>
	</tr>
	<tr>
		<td align="center">
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
<?php /**PATH /var/www/dwo2/resources/views/weborder/top/custinfo.blade.php ENDPATH**/ ?>