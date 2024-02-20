下記承認期限切れ注文を取り消しました。

--------------- 注文番号 ---------------
<?php for($i = 0; $i < count($orderNoList); $i++): ?>
<?php echo e($orderNoList[$i]); ?>

<?php endfor; ?>
----------------------------------------
全 <?php echo e(count($orderNoList)); ?> 件
<?php /**PATH /var/www/dwo2/resources/views/mail_templates/cancelResult.blade.php ENDPATH**/ ?>