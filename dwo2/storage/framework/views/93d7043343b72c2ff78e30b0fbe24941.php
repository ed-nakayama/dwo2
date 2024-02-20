************** ID Notification ***********
<?php echo e($cust_name); ?> 様
日頃は弥生ＷｅｂＯｒｄｅｒをご利用いただきありがとうございます。
お問合せいただいたお客様のIDは下記の通りです。
IDは大切に保管して下さい。
======================================
【お客様のID】<?php echo e($custid); ?>


問合わせ日時： <?php echo e(\Carbon\Carbon::now()->format('Y/m/d H:i')); ?>

======================================
<?php /**PATH /var/www/dwo2/resources/views/mail_templates/forgetid.blade.php ENDPATH**/ ?>