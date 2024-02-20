<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\GuestLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

<table border="0">
	<tr>
		<td width="550px" height="75px" align="center" valign="bottom">
		<img src="<?php echo e(asset('assets/cust/img/welcome.png')); ?>" alt="弥生webオーダーへようこそ" width="500px" height="50px">
		</td>
	</tr>
</table>

<form method="POST" name="frm" action="<?php echo e(route('login')); ?>">
<?php echo csrf_field(); ?>

<table align="center" border="0" >

	<tr>
		<td><h4>▼ログインID、パスワードを入力してください。</h4></td>
	</tr>
	<?php $__errorArgs = ['profile_cust_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
		<tr>
			<td align="center"><li style="list-style:none; color:red;"><?php echo e($message); ?></li></td>
		<tr>
	<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
	<?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
		<tr>
			<td align="center"><li style="list-style:none; color:red;"><?php echo e($message); ?></li></td>
		<tr>
	<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
	<?php $__errorArgs = ['no_match_user'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
		<tr>
			<td align="center"><li style="list-style:none; color:red;"><?php echo e($message); ?></li></td>
		</tr>
	<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
	<?php $__errorArgs = ['out_of_support'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
		<tr>
			<td align="center"><li style="list-style:none; color:red;"><?php echo e($message); ?></li></td>
		</tr>
	<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
	<?php $__errorArgs = ['no_order_user'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
		<tr>
			<td align="center"><li style="list-style:none; color:red;"><?php echo e($message); ?></li></td>
		</tr>
	<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
	<?php $__errorArgs = ['over_limit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
		<tr>
			<td align="center"><li style="list-style:none; color:red;"><?php echo e($message); ?></li></td>
		</tr>
		<tr>
			<td align="center">
			<p class="words"><span id="essential">申し訳ございませんが、お受付できません。<br />
			<?php echo e(config('dwo.DWO_COMP_NAME')); ?> <?php echo e(config('dwo.DWO_UNIT_NAME')); ?>までお問合せください。<br />
			お問合せ先：<?php echo e(config('dwo.DWO_TEL')); ?></p></span>
			</td>
		</tr>
	<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
	<?php $__errorArgs = ['tran_status_error'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
		<tr>
			<td align="center">
			<table border="0" cellpadding="0" cellspacing="0">
				<tr><td align="left"><p class="words"><span id="essential">申し訳ございませんが、お受付できません。</p></span></td></tr>
				<tr><td align="left"><p class="words"><span id="essential">後ほど弥生㈱より、ご登録のご連絡先宛に</p></span></td></tr>
				<tr><td align="left"><p class="words"><span id="essential">連絡させていただきます。</p></span></td></tr>
			</table>
			</td>
		</tr>
	<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>


	<tr>
		<td>
		<table border="0">
			<tr>
				<td>
					<table class="new"  border="1" cellspacing="0" frame="hsides" rules="rows">
						<tr>
							<td class="item" width="100">ログインID</td>
							<td>
								<input id="profile_cust_code" type="text" name="profile_cust_code"  size="20" maxlength="9"  value="<?php echo e(old('profile_cust_code')); ?>"   style="ime-mode: disabled;" required="required" autofocus="autofocus" autocomplete="username"  tabindex="1">
							</td>
							<td>&nbsp;&nbsp;<a href="/information#forgetid" target="_blank">IDを忘れてしまったら</a></td>
						</tr>
						<tr>
							<td class="item">パスワード</td>
							<td>
								<input id="password" type="password" name="password" size="15" maxlength="20" value=""  style="ime-mode: disabled;" required="required"  tabindex="2">
							</td>
							<td>&nbsp;&nbsp;<a href="/information#forgetpassword" target="_blank">パスワードを忘れてしまったら</a></td>

						</tr>
					</table>
				</td>
			</tr>
			<tr>



			</tr>
			<tr>
				<td align="center"><font size="2">弥生会員専用ページのログインID・PWとは異なります</font></td>
			</tr>



		</table>
		</td>
	</tr>
	<tr>
		<td align="center">
			<a href="javascript:document.frm.submit();"  tabindex="5"><img src="<?php echo e(asset('assets/cust/img/login.png')); ?>" alt="ログイン" width="120px" height="50px"></a> 
		</td>
	</tr>

	<tr>
		<td valign="bottom">
			<br /><br />
			<table border="0">
				<tr>
					<td>
					■&nbsp;<a href="/information#weborder" target="_blank">弥生Webオーダーについて</a><br />
					</td>
				</tr>
				<tr>
					<td>
					■&nbsp;<a href="/information#order" target="_blank">ご注文と出荷について</a><br />
					</td>
				</tr>
				<tr>
					<td>
					■&nbsp;<a href="/information#payment" target="_blank">お支払いについて</a><br />
					</td>
				</tr>
				<tr>
					<td>
					■&nbsp;<a href="/information#return" target="_blank">商品のご返品・交換について</a><br />
					</td>
				</tr>
				<tr>
					<td>
					■&nbsp;<a href="/information#inquiry" target="_blank">ご注文に関するお問い合わせについて</a><br />
					</td>
				</tr>
				<tr>
					<td>
					■&nbsp;<a href="/information#password" target="_blank">パスワードについて</a><br />
					</td>
				</tr>
				<tr>
					<td>
					■&nbsp;<a href="https://www.yayoi-kk.co.jp/company/sitepolicy/" target="_blank">サイトポリシー</a><br />
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="50px">
		<p class="mail">
		上記内容以外にご不明な点等ございましたら、<a href="mailto:<?php echo e(config('dwo.DWO_ORDER_CENTER_MAIL')); ?>"><?php echo e(config('dwo.DWO_ORDER_CENTER_MAIL')); ?></a> にお問い合わせ下さい。</p><p class="top">
		</td>
	</tr>
</table>

</form>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php /**PATH /var/www/dwo2/resources/views/auth/login.blade.php ENDPATH**/ ?>