<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/cust/css/common.css')); ?>">
<title>弥生Webオーダーについて</title>
</head>
<body>
<center>
<div id="main2">
<div id="leftside">

<a name="weborder"><h4 class="help2">弥生Webオーダーについて</h4></a>
<pre>
弥生Webオーダーは、弥生株式会社が運営するご注文受付システムです。
弥生Webオーダーでご注文いただいた商品は、弊社が定める出荷サイクルに基づき、商品出荷を行います。
【取引基本契約】で定めるお支払い条件に基づきお支払いいただきますようお願いいたします。
</pre>

<a name="order"><h4 class="help2">ご注文と出荷について</h4></a>
<pre>
弊社営業日15：00までにご注文いただきますと、翌営業日の出荷となります。当日出荷はできません。
また弥生Webオーダーでご注文いただいた際には【弥生Webオーダー】よりお知らせメールを配信いたします。

発送する際の運送会社は佐川急便株式会社です。
ソフトウェアとサプライ用品を同時にご注文された場合、別々に梱包してお届となりますのであらかじめご了承ください。
また、ご注文いただいた商品には、納品書を添付しております。
ただし、商品をお客様先へ直送される場合には、納品書はパートナー会員宛てに郵送いたします。

■弥生Webオーダーでご注文いただける商品
１．弥生シリーズ ソフトウェア（通常製品）
２．弥生純正サプライ用品
</pre>

<a name="payment"><h4 class="help2">お支払いについて</h4></a>
<pre>
パートナー会員宛てに合計請求書を発行いたします。【取引基本契約】で定めるお支払い条件に基づきお支払いください。
お支払いは銀行振込のみとなっており振込用紙は用意しておりませんので、ご了承ください。
パートナー会員のお支払条件は、ログイン後の「ご登録情報」メニューの「貴社登録情報」にてご確認いただけます。
代金のお支払いが期日までに確認できない場合は、弥生Webオーダーのご利用及び商品の出荷ができなくなりますので、
ご注意ください。都度請求やエンドユーザー様への直接請求はできません。
</pre>

<a name="return"><h4 class="help2">商品のご返品・交換について</h4></a>
<pre>
ご注文いただいた商品の返品はお受け付けしておりません。
ただし、下記事由の場合は<?php echo e(config('dwo.DWO_COMP_NAME')); ?> <?php echo e(config('dwo.DWO_UNIT_NAME')); ?>までご連絡ください。（TEL:<?php echo e(config('dwo.DWO_TEL')); ?>）

    * 商品が破損していた
    * 注文した商品と違う商品が届いた
</pre>

<a name="inquiry"><h4 class="help2">ご注文に関するお問い合わせについて</h4></a>
<pre>
<?php echo e(config('dwo.DWO_COMP_NAME')); ?> <?php echo e(config('dwo.DWO_UNIT_NAME')); ?>にてお受け付けしております。

■ご注文に関するお問い合せ先
<?php echo e(config('dwo.DWO_COMP_NAME')); ?> <?php echo e(config('dwo.DWO_UNIT_NAME')); ?>

〒<?php echo e(config('dwo.DWO_ZIP')); ?>

<?php echo e(config('dwo.DWO_ADDRESS')); ?>

メールアドレス：<?php echo e(config('dwo.DWO_ORDER_CENTER_MAIL')); ?>

TEL:<?php echo e(config('dwo.DWO_TEL')); ?>　FAX:<?php echo e(config('dwo.DWO_FAX')); ?>

</pre>

<a name="password"><h4 class="help2">パスワードについて</h4></a>
<pre>
弥生Webオーダーにアクセスする為には、｢ログインID｣ ｢パスワード｣を入力して、｢ログイン｣ボタンを押してください。
パスワードは定期的に変更いただくことをお勧めいたします。
</pre>
<a name="forgetid"><h4 class="help2">IDを忘れてしまったら</h4></a>
<pre>
IDをお忘れの場合は、以下に弊社ご登録電話番号・E-Mail情報をご入力の上、送信ボタンを押してください。
ご登録のE-mailアドレスへメールにてお知らせいたします。
</pre>

<div style="color:blue;">
	<?php if (isset($component)) { $__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.auth-session-status','data' => ['class' => 'mb-4','status' => session('id_status')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('auth-session-status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mb-4','status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(session('id_status'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5)): ?>
<?php $attributes = $__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5; ?>
<?php unset($__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5)): ?>
<?php $component = $__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5; ?>
<?php unset($__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5); ?>
<?php endif; ?>
</div>
<?php $__errorArgs = ['frm_cust_tel'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
	<li style="list-style:none; color:red;"><?php echo e($message); ?></li>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
<?php $__errorArgs = ['frm_cust_mail'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
	<li style="list-style:none; color:red;"><?php echo e($message); ?></li>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

<?php echo e(html()->form('POST', '/forgetchk')->style('margin:0px;')->open()); ?>

<table>

	<tr>
		<td>
		<table border="1" cellspacing="0">
			<tr>
				<td class="item">ご登録の電話番号</td>
				<td>
					<?php echo e(html()->text('frm_cust_tel')->attribute('maxlength', '13')); ?>

					<span id="essential">&nbsp;ハイフン有で入力して下さい。&nbsp;例:&nbsp;03-5207-8730</span>
				</td>
			</tr>
			<tr>
				<td class="item">ご登録のE-Mail</td>
				<td>
					<?php echo e(html()->text('frm_cust_mail')->attributes(['size' => '40', 'maxlength' => '80'])); ?>

				</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td align="center">
			<?php echo e(html()->submit('送信')); ?>

		</td>
	</tr>
</table>
<?php echo e(html()->form()->close()); ?>

<br />

<a name="forgetpassword"><h4 class="help2">パスワードを忘れてしまったら</h4></a>
<pre>
パスワードをお忘れの場合は、以下にログインID・弊社ご登録E-Mail情報をご入力の上、送信ボタンを押してください。
ご登録のE-mailアドレスへメールにてお知らせいたします。
</pre>
<div style="color:blue;">
	<?php if (isset($component)) { $__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.auth-session-status','data' => ['class' => 'mb-4','status' => session('status')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('auth-session-status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mb-4','status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(session('status'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5)): ?>
<?php $attributes = $__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5; ?>
<?php unset($__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5)): ?>
<?php $component = $__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5; ?>
<?php unset($__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5); ?>
<?php endif; ?>
</div>
<?php $__errorArgs = ['profile_cust_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
	<li style="list-style:none; color:red;"><?php echo e($message); ?></li>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
<?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
	<li style="list-style:none; color:red;"><?php echo e($message); ?></li>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

<form method="POST" action="<?php echo e(route('password.email')); ?>">
<?php echo csrf_field(); ?>
<table>
	<tr>
		<td>
			<table border="1" cellspacing="0">
				<tr>
					<td class="item">ログインID</td>
					<td>
						<?php echo e(html()->text('profile_cust_code')->attribute('maxlength', '9')); ?>

					</td>
				</tr>
				<tr>
					<td class="item">ご登録のE-Mail</td>
					<td>
						<?php echo e(html()->text('email')->attributes(['size' => '40', 'maxlength' => '80'])); ?>

					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center"><input type="submit" value="送信"></td>
	</tr>
</table><br />
</form>

</div>
</div>
<center>
</body>
</html><?php /**PATH /var/www/dwo2/resources/views/weborder/information.blade.php ENDPATH**/ ?>