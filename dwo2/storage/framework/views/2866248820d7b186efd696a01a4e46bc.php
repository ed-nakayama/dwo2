＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
<?php echo e($agentview->name1 . $agentview->name2); ?>

<?php echo e($weborderheader['dwo_order_person_name']); ?>様


この度は弥生Webオーダーをご利用頂き、誠にありがとうございます。

以下のご注文のお客様情報登録内容はご購入のお客様（ユーザー登録のお客様）によって
更新されました。

※更新後の内容は「注文履歴」よりご確認ください。
<?php echo e(url('')); ?><?php echo e(config('dwo.URL_DOC_ROOT')); ?>


今回のご注文の内容です。
ご注文受付日　：<?php echo e(substr($weborderheader['order_date'],0,4)); ?>年<?php echo e(substr($weborderheader['order_date'],4,2)); ?>月<?php echo e(substr($weborderheader['order_date'],6,2)); ?>日
ご注文受付番号：<?php echo e($weborderheader['web_order_num']); ?>

--------------------------------------------------------------------
<?php $__currentLoopData = $weborderdetailList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detaillist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
貴社発注No　　：<?php echo e($detaillist['remarks']); ?>

商品コード　　：<?php echo e($detaillist['item_cd']); ?>

商品名　　　　：<?php echo e($detaillist['item_name_kanji']); ?>

ご注文数量　　：<?php echo e($detaillist['item_vol']); ?>

ご提供価格　　：￥<?php echo e(number_format($detaillist['item_price'])); ?>

金額　　　　　：￥<?php echo e(number_format($detaillist['item_amt'])); ?>

<?php if(!empty($detaillist['tax_rate']) ): ?>消費税率　　　：<?php echo e($detaillist['tax_rate'] * 100); ?><?php endif; ?> 

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
--------------------------------------------------------------------
　　　小計　：￥<?php echo e(number_format($weborderheader['order_amt'])); ?>

　　消費税　：￥<?php echo e(number_format($weborderheader['tax'])); ?>

　合計金額　：￥<?php echo e(number_format($weborderheader['total_amt'])); ?>

--------------------------------------------------------------------
<?php echo $__env->make('weborder/common/tax10_comment_mail', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if($weborderheader['contents_type'] != "54" && $weborderheader['contents_type'] != "55"): ?>

商品納品先
納品先名称　　：<?php echo e($weborderheader['dest_name1'] . $weborderheader['dest_name2']); ?>

納品先郵便番号：<?php echo e($weborderheader['dest_post']); ?>

納品先住所　　：<?php $__currentLoopData = $prefList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kenlist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if($weborderheader['dest_pref_cd'] == $kenlist-> pref_cd): ?><?php echo e($kenlist->pref_name); ?><?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php echo e($weborderheader['dest_address1'] . $weborderheader['dest_address2'] . $weborderheader['dest_address3']); ?>

納品先担当者名：<?php echo e($weborderheader['dest_contact_name1']); ?>　様
納品先電話番号：<?php echo e($weborderheader['dest_tel']); ?>

--------------------------------------------------------------------
<?php endif; ?>
伝票送付先 [納品書][請求書]
送付先名称　：<?php echo e($agentview->name1 . $agentview->name2); ?>

送付先郵便番号：<?php echo e($agentview->post); ?>

送付先住所　　：<?php echo e($agentview->pref); ?><?php echo e($agentview->address1); ?><?php echo e($agentview->address2); ?><?php echo e($agentview->address3); ?>

送付先担当者名：<?php echo e($agentview->contact_name1); ?>　様
送付先電話番号：<?php echo e($agentview->tel); ?>

<?php if($weborderheader['contents_type'] != "54" && $weborderheader['contents_type'] != "55"): ?>
--------------------------------------------------------------------
運賃　　　　　　：当社負担
サプライ二重梱包：無
<?php endif; ?>
--------------------------------------------------------------------
■お問い合わせ先■
弥生株式会社  受注管理課
TEL    ： 03-5207-8730
FAX    ： 03-5207-8731
E-MAIL ： order-center@yayoi-kk.co.jp
＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
<?php /**PATH /var/www/dwo2/resources/views/mail_templates/infoUpdate.blade.php ENDPATH**/ ?>