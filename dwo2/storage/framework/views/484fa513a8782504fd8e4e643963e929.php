<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	    <link href="<?php echo e(asset('assets/admin/css/style0.css')); ?>" rel="stylesheet">

        <?php echo app('Illuminate\Foundation\Vite')(['resources/js/app.js']); ?>

</HEAD>

<BODY bgcolor="#FFFFFF">


<TABLE border=0>
<tr>
	<td>
	<?php if( config('dwo.APPLICATION_ENV') != 'PRODUCTION'): ?>
		<center>
		<div style="background-color:<?php echo e(config('dwo.APPLICATION_ENV_BARCOLOR')); ?>;color:<?php echo e(config('dwo.APPLICATION_ENV_FONTCOLOR')); ?>;font-weight:bolder">
			<?php echo e(config('dwo.APPLICATION_ENV_TITLE')); ?> 今日の日付：<?php echo e(date('Y年m月d日')); ?>

		</div>
		</center>
	<?php endif; ?>
	</td>
</tr>
<tr>
	<td>
	<TABLE border=1>
	  <TR>
	    <TD nowrap colspan="5" align="left" valign="top" bgcolor="#ffff6a">　オペレーターID：<?php echo e(Auth::user()->operator_id); ?>　<?php echo e(Auth::user()->operator_name); ?></TD>
	 	<td  bgcolor="#ffff6a">
	    	<a href="/admin/password/edit"">パスワード変更</a>
	 	</td>
	 	<td  bgcolor="#ffff6a">
			<form method="POST" action="<?php echo e(route('admin.logout')); ?>">
				<?php echo csrf_field(); ?>

				<?php if (isset($component)) { $__componentOriginald69b52d99510f1e7cd3d80070b28ca18 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald69b52d99510f1e7cd3d80070b28ca18 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.responsive-nav-link','data' => ['href' => route('admin.logout'),'onclick' => 'event.preventDefault();
					this.closest(\'form\').submit();']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('responsive-nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.logout')),'onclick' => 'event.preventDefault();
					this.closest(\'form\').submit();']); ?>
				<?php echo e(__('Log Out')); ?>

				 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald69b52d99510f1e7cd3d80070b28ca18)): ?>
<?php $attributes = $__attributesOriginald69b52d99510f1e7cd3d80070b28ca18; ?>
<?php unset($__attributesOriginald69b52d99510f1e7cd3d80070b28ca18); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald69b52d99510f1e7cd3d80070b28ca18)): ?>
<?php $component = $__componentOriginald69b52d99510f1e7cd3d80070b28ca18; ?>
<?php unset($__componentOriginald69b52d99510f1e7cd3d80070b28ca18); ?>
<?php endif; ?>
			</form>
	 	</td>
	  </TR>
	  <TR>
	    <TD><A href="/admin/product/list">商品サブマスタ</A></td>
	    <TD><A href="/admin/product/big">商品大分類マスタ</A></td>
	    <TD><A href="/admin/product/middle">商品中分類マスタ</A></td>
	    <TD><A href="/admin/product/category/list">商品分類登録マスタ</A></td>
	    <TD><A href="/admin/product/status">商品ステータスマスタ</A></td>
	    <TD><A href="/admin/batch/conf">バッチ設定</A></td>
	    <TD><A href="/admin/info">お知らせ</A></td>
	  </TR>
	  <TR>
	    <TD><A href="/admin/cust/list">得意先サブマスタ</A></td>
	    <TD><A href="/admin/operator/detail">管理ユーザマスタ</A></td>
	    <TD><A href="/admin/order/delivery/list">納品先マスタ</A></td>
	    <TD><A href="/admin/order/list">受付状況確認</A></td>
	    <TD><A href="/admin/order/search/history">受注履歴照会</A></td>
	    <TD><A href="/admin/order/status">受注ステータスマスタ</A></td>
	    <TD><A href="/admin/test/shipping/form">テスト</A></td>
	  </TR>
	  <TR>
	    <TD><A href="/admin/order/list2">受付編集</A></td>
	    <td><a href="/admin/zipdata/update/form">郵便番号辞書更新</a></td>
	  </TR>
	</TABLE>
	</td>
</tr>
<tr>
	<td>
		<br>
		<?php echo e($slot); ?>

	</td>
</tr>
</TABLE>
</BODY>
</HTML>
<?php /**PATH /var/www/dwo2/resources/views/layouts/admin.blade.php ENDPATH**/ ?>