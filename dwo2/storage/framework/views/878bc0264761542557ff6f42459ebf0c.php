＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
<?php echo e($weborderheader->name1); ?>

<?php echo e($weborderheader->contact_name1); ?>様

<?php echo e($agentview->name); ?>　<?php echo e($weborderheader->dwo_order_person_name); ?>　様より下記ご注文を承りました。

ご注文受付日　：<?php echo e(substr($orderacceptance->order_acceptance_order_date,0,4)); ?>年<?php echo e(substr($orderacceptance->order_acceptance_order_date,5,2)); ?>月<?php echo e(substr($orderacceptance->order_acceptance_order_date,8,2)); ?>日
ご注文受付番号：<?php echo e($weborderheader->web_order_num); ?>

--------------------------------------------------------------------
<?php $__currentLoopData = $weborderdetailList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detaillist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
貴社発注No　　：<?php echo e($detaillist->remarks); ?>

商品コード　　：<?php echo e($detaillist->item_cd); ?>

商品名　　　　：<?php echo e($detaillist->item_name_kanji); ?>

ご注文数量　　：<?php echo e($detaillist->item_vol); ?>


<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

◆承認期限：<?php echo e(substr($ago2week,0,4)); ?>年<?php echo e(substr($ago2week,5,2)); ?>月<?php echo e(substr($ago2week,8,2)); ?>日 <?php if($upgrade_flag == "1"): ?>15時 <?php endif; ?>

下記URLより「個人情報保護方針」についてご確認のうえ、承認の場合は「承認」ボタンをクリックしてください。
<?php echo e(url('')); ?><?php echo e(config('dwo.URL_DOC_ROOT')); ?>recognize/top?id=<?php echo e($orderacceptance->order_acceptance_seq); ?>&aid=<?php echo e($orderacceptance->order_acceptance_id); ?>



※「否認」をクリックした場合および承認期限が切れた場合は、商品の注文ならびにユーザー登録情報は削除されます。


--------------------------------------------------------------------
■お問い合わせ先■
弥生株式会社  受注管理課
TEL    ： 03-5207-8730
FAX    ： 03-5207-8731
E-MAIL ： order-center@yayoi-kk.co.jp
＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
<?php /**PATH /var/www/dwo2/resources/views/mail_templates/syonin.blade.php ENDPATH**/ ?>