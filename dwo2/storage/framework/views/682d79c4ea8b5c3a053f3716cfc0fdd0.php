<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>
</HEAD>

<body topmargin="0">
	<center>
	<div id="main">


<?php if( config('dwo.APPLICATION_ENV') != 'PRODUCTION'): ?>
	<center>
	<div style="background-color:<?php echo e(config('dwo.APPLICATION_ENV_BARCOLOR')); ?>;color:<?php echo e(config('dwo.APPLICATION_ENV_FONTCOLOR')); ?>;font-weight:bolder">
		<?php echo e(config('dwo.APPLICATION_ENV_TITLE')); ?> 今日の日付：<?php echo e(date('Y年m月d日')); ?>

	</div>
	</center>
<?php endif; ?>

	<main>
		<br>
		<?php echo e($slot); ?>

	</main>

</div>
</center>
</body>
</html><?php /**PATH /var/www/dwo2/resources/views/layouts/admin_guest.blade.php ENDPATH**/ ?>