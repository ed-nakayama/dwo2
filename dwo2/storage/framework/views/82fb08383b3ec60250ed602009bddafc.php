<?php if( config('dwo.APPLICATION_ENV') != 'PRODUCTION'): ?>
<div style="background-color:<?php echo e(config('dwo.APPLICATION_ENV_BARCOLOR')); ?>;color:<?php echo e(config('dwo.APPLICATION_ENV_FONTCOLOR')); ?>;font-weight:bolder">
	<?php echo e(config('dwo.APPLICATION_ENV_TITLE')); ?> 今日の日付：<?php echo e(date('Y年m月d日')); ?>

</div>
<?php endif; ?>
<table border="0" width="100%">
	<tr>
		<td>
			<a href="/home"><img src="<?php echo e(asset('assets/cust/img/logo.jpg')); ?>"></a>
		</td>
	</tr>
	<tr>
		<td width="100%">
			<h1 class="weborder" align="center"><img src="<?php echo e(asset('assets/cust/img/mainbar.png')); ?>" alt="Webオーダー" width="350px" height="50px"></h1>
		</td>
	</tr>
</table>
<?php /**PATH /var/www/dwo2/resources/views/weborder/common/header.blade.php ENDPATH**/ ?>