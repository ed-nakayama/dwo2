<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
<meta http-equiv="Content-Type"content="text/html;charset=utf-8">
<title>弥生 WEB ORDER</title>
<link href="<?php echo e(asset('assets/cust/css/common.css')); ?>" rel="stylesheet">

</head>
<body topmargin="0">
	<center>
	<div id="main">
	
<?php echo $__env->make('weborder.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo e($slot); ?>



<?php echo $__env->make('weborder.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</div>
</center>
</body>
</html><?php /**PATH /var/www/dwo2/resources/views/layouts/guest.blade.php ENDPATH**/ ?>