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

<title>お客様情報承認</title>

<script type="text/javascript">
<!--
	function zip_search() {
		if (document.frm.frm_regist_zip1.value == "") {
			alert("郵便番号を入力してください。");
			document.frm.frm_regist_zip1.focus();
			return;
		}
		document.frmZip.frm_zip1.value = document.frm.frm_regist_zip1.value;
		document.frmZip.frm_zip2.value = document.frm.frm_regist_zip2.value;
		w = window.open("", "ZipWin", "width=640,height=480,scrollbars=yes");
		if (w) {
			document.frmZip.submit();
		}
	}

	function setZip(p_zip,p_pref,p_city) {
		document.frm.frm_regist_zip1.value = p_zip.substr(0, 3);
		document.frm.frm_regist_zip2.value = p_zip.substr(3);
		document.frm.frm_regist_add1.value = p_city;

		if (document.frm.frm_regist_pref_cd) {
			for (i = 0; i < document.frm.frm_regist_pref_cd.options.length; i++) {
				if (document.frm.frm_regist_pref_cd.options[i].text == p_pref) {
					document.frm.frm_regist_pref_cd.options[i].selected = true;
					break;
				}
			}
		}
	}

	function regCustSubmit() {
		document.frm1.submit();
	}
-->
</script>


</head>
<body bgcolor="#ffffff">

<?php echo e(html()->form('POST', '/zip/searchzip')->attributes(['name'=> 'frmZip', 'target' => 'ZipWin'])->style('margin:0px;')->open()); ?>

<?php echo e(html()->hidden('frm_zip1')); ?>

<?php echo e(html()->hidden('frm_zip2')); ?>

<?php echo e(html()->form()->close()); ?>


<center>
<table>
	<tr><td><?php echo e(session()->get('weborderheader')['name1']); ?><?php echo e(session()->get('weborderheader')['name2']); ?>　<?php echo e(session()->get('weborderheader')['contact_name1']); ?>様</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td><?php echo e(session()->get('agentView')->name1 . session()->get('agentView')->name2); ?>　<?php echo e(session()->get('agentView')->contact_name1); ?>様より下記商品の注文ならびにユーザー登録情報（社名、住所、電話番号、<br/>メールアドレス、担当者名など）をご入力いただきました。</td></tr>
	<tr><td>以下の「個人情報保護方針」をご確認のうえ、</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td><b>■承認いただける場合</b></td></tr>
	<tr><td>【承認】ボタンをクリックしてください。</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td><b>■ご承認いただけない場合</b></td></tr>
	<tr><td>【否認】ボタンをクリックしてください。</td></tr>
	<tr><td>ご注文ならびにユーザー登録情報は削除されます。</td></tr>
	<tr><td>&nbsp;</td></tr>
<?php if( session()->get('weborderheader')['contents_type'] == "54" || session()->get('weborderheader')['contents_type'] == "55" ): ?>
	<tr><td><b>■ご住所、電話番号などに変更・誤りがある場合</b></td></tr>
	<tr><td>【登録情報更新】ボタンをクリックし、正しい内容に上書き入力のうえ【承認】ボタンをクリックしてください。</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td><b>■登録名義、代表取締役または代表者に変更・誤りがある場合</b></td></tr>
	<tr><td>【否認】ボタンをクリックしてください。（ご注文ならびにユーザー登録情報は削除されます）</td></tr>
	<tr><td>ご購入先の販売代理店へご連絡のうえ、名義変更手続きをお願いいたします。</td></tr>
	<tr><td>&nbsp;</td></tr>
<?php else: ?>
	<tr><td><b>■入力内容に変更・誤りがある場合</b></td></tr>
	<tr><td>【登録情報更新】ボタンをクリックし、正しい内容に上書き入力のうえ【承認】ボタンをクリックしてください。</td></tr>
	<tr><td>&nbsp;</td></tr>
<?php endif; ?>
</table>

<br/>

<table width="600">
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td align="center">受付No.<?php echo e(session()->get('acceptance')['order_acceptance_header_no']); ?></td>
	</tr>
	


	<tr>
		<td nowrap>【ご注文内容】</td>
		<td>&nbsp;</td>
		<td>
			
			<table border=1>
				<tr>
					<td bgcolor="#8080c0">商品コード</td>
					<td bgcolor="#8080c0">商品名称</td>
					<td bgcolor="#8080c0">数量</td>
				</tr>
				<?php $__currentLoopData = session()->get('weborderdetailList'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detaillist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td align="center"><?php echo e($detaillist['item_cd']); ?></td>
						<td><?php echo e($detaillist['item_name_kanji']); ?><?php if( session()->get('weborderheader')['contents_type'] == "54" || session()->get('weborderheader')['contents_type'] == "55" ): ?><br>サポートプランアップグレード<?php endif; ?></td>
						<td align="center"><?php echo e($detaillist['item_vol']); ?></td>
					</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</table>
			
		</td>
	</tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td align="right">
			<a href="/information#inquiry" target="_blank">
				■ご注文に関するお問い合わせについて
			</a>
		</td>
	</tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<?php if(session()->get('msg') != ""): ?>
	<tr><td>&nbsp;</td><td>&nbsp;</td><td><font color="red"><?php echo e(session()->get('msg')); ?></font></td></tr>
<?php endif; ?>
	<tr>
		<td valign="top">【ご登録情報】</td>
		<td>&nbsp;</td>
		<td>
			<table class="new" width="500px" border="1"cellspacing="0"frame="hsides"rules="rows">
				<tr>
					<td class="item" width="200px">登録名義</td>
					<td><?php echo e(session()->get('weborderheader')['name1'] . session()->get('weborderheader')['name2']); ?></td>
				</tr>
				<tr>
					<td class="item">登録名義(カタカナ)</td>
					<td><?php echo e(session()->get('weborderheader')['name_kana1']); ?></td>
				</tr>
				<tr>
					<td class="item">代表者取締役または代表者</span></td>
					<td><?php echo e(session()->get('weborderheader')['president_name1']); ?></td>
				</tr>
				<tr>
					<td class="item">代表者取締役または代表者(カタカナ)<br></td>
					<td><?php echo e(session()->get('weborderheader')['president_name_kana1']); ?></td>
				</tr>
				<tr>
					<td class="item">担当者名</td>
					<td><?php echo e(session()->get('weborderheader')['contact_name1']); ?></td>
				</tr>
				<tr>
					<td class="item">担当者名(カタカナ)</td>
					<td><?php echo e(session()->get('weborderheader')['contact_name_kana1']); ?></td>
				</tr>
				<tr>
					<td class="item">メールアドレス</td>
					<td><?php echo e(session()->get('weborderheader')['mail_address']); ?></td>
				</tr>
				<tr>
					<td class="item">ホームページURL</td>
					<td><?php echo e(session()->get('weborderheader')['url']); ?></td>
				</tr>
				<tr>
					<td class="item">郵便番号</td>
					<td>
						<?php echo e(session()->get('weborderheader')['frm_regist_zip1']); ?>-<?php echo e(session()->get('weborderheader')['frm_regist_zip2']); ?>

					</td>
				</tr>

				<tr>
					<td class="item">都道府県</td>
					<td>
						<?php $__currentLoopData = $prefList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pref): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php if( session()->get('weborderheader')['prefecture_cd'] == $pref->pref_cd ): ?>
								<?php echo e($pref->pref_name); ?><br>
							<?php break; ?>;
							<?php endif; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</td>
				</tr>

				<tr>
					<td class="item">市区町村</td>
					<td><?php echo e(session()->get('weborderheader')['address1']); ?></td>
				</tr>
				<tr>
					<td class="item">丁番地</td>
					<td><?php echo e(session()->get('weborderheader')['address2']); ?></td>
				</tr>
				<tr>
					<td class="item">建物名</td>
					<td><?php echo e(session()->get('weborderheader')['address3']); ?></td>
				</tr>
				<tr>
					<td class="item">登録電話番号</td>
					<td><?php echo e(session()->get('weborderheader')['tel']); ?></td>
				</tr>
					<td class="item">連絡先電話番号</td>
					<td><?php echo e(session()->get('weborderheader')['communicate_tel']); ?></td>
				</tr>
				<tr>
					<td class="item">連絡先FAX番号</td>
					<td><?php echo e(session()->get('weborderheader')['fax']); ?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
		</td>
	</tr>
</table>


<?php echo e(html()->form('POST', '/recognize/update')->attribute('name', 'frm1')->style('margin:0px;')->open()); ?>

<?php echo e(html()->hidden('web_order_num', session()->get('weborderheader')['web_order_num'] )); ?>

<?php echo e(html()->hidden('id', session()->get('id') )); ?>

<?php echo e(html()->hidden('aid',session()->get('aid') )); ?>

<?php echo e(html()->form()->close()); ?>


<br/></br>

<table>
<tr>
<td>
<pre>
■ 個人情報保護方針
<ul>
<li>いただいた個人情報は、ご購入・ご登録いただいた商品の確認やお届けを実施する上で必要な管理とお客さまへの連絡、
本サービスの改善等に使用し、お客さまの同意がある場合または法令に基づく場合を除き、その他の目的に利用することはございません。
また、弊社の安全管理措置に従い適切に管理いたします。
</li>
<li>第三者への提供は、本ご注文受付後の配送や、サービスに関連した情報などをお届けする場合に限り業務委託先にお客さまの情報を開示いたします。
それ以外で、お客さまの承諾なしに第三者提供を行うことはございません。
</li>
<li>ご登録いただいた個人情報に関するお問い合わせは、「個人情報相談窓口」で承ります。連絡先および弊社のプライバシーポリシーは、こちらでご確認ください。
<a href="https://www.yayoi-kk.co.jp/company/privacy/index.html" target="_blank">https://www.yayoi-kk.co.jp/company/privacy/index.html</a>
</li>
</ul>
</pre>
</td>
</tr>
</table>

<br/>

<?php echo e(html()->form('POST', '/recognize/check')->attribute('name', 'accept')->style('margin:0px;')->open()); ?>

<?php echo e(html()->submit('　承認　')->attribute('name', 'do_accept')); ?>　　
<?php echo e(html()->submit('　否認　')->attribute('name', 'do_reject')); ?>　　
<?php echo e(html()->button('登録情報更新')->attribute('name', 'do_update')->attribute('onClick' ,'javascript:regCustSubmit();return false;')); ?>

<?php echo e(html()->form()->close()); ?>



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
<?php /**PATH /var/www/dwo2/resources/views/weborder/recognize/top.blade.php ENDPATH**/ ?>