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

<table border="0" width="100%">
  <tr>
    <td width="10%"></td>
    <td width="80%">
      <table id="pap_info">
        <tr>
          <td><p id="pap_info_title">サプライ用品お取り扱い終了のご案内</p></td>
        </tr>
        <tr>
          <td>『&lt;顧問先向け&gt; 弥生製品 優待販売制度』によるサプライ用品のお取り扱いは<br/>2017年10月19日をもちまして終了いたしました。</td>
        </tr>
        <tr>
          <td><p id="pap_info_link">今後のサプライ用品のご購入は<a href="https://www.yayoi-kk.co.jp/icare/store/supply/index.jsp">サプライ用品ご注文</a>をご利用ください</p></td>
        </tr>
        <tr>
          <td><font color="#FF0000">【注意】</font><br />システムメンテナンスのため、サプライ用品ご注文ページは下記の時間ご利用いただけません。<br />ご不便をおかけいたしますが、何卒ご了承くださいますようお願い申し上げます。<br /><font color="#FF0000">・2017年10月19日（木）15:00～23:59（予定）</font><br/><br/></td>
        </tr>
        <tr>
          <td align="center">
            <div id="pap_foot">
              <div class="foot_info_logo"><img src="<?php echo e(asset('assets/cust/img/pap_foot_logo.png')); ?>" width="161" height="118" alt="弥生PAP" /></div>
              <div class="foot_info"><img src="<?php echo e(asset('assets/cust/img/pap_foot_tel.png')); ?>" width="379" height="66" alt="弥生PAP会員専用電話サポート（フリーダイヤル）0120-714-841" />
                <p>受付時間　9:30～12:00／13:00～17:30　（土・日・祝日、および弊社休業日を除きます）<br />
                プッシュ回線か、トーン信号を発信できる電話機で、音声ガイドにしたがって「７桁のお客様番号」（※）を入力してください。※弥生PAP会員カードをご参照ください。</p>
              </div>
            </div>
          </td>
        </tr>
      </table>
    </td>
    <td width="10%"></td>
  </tr>
</table>

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
<?php /**PATH /var/www/dwo2/resources/views/weborder/serviceinfo.blade.php ENDPATH**/ ?>