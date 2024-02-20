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
		n = document.frm.frm_regist_pref_cd.selectedIndex;
		// 県名をセット
		document.frm.frm_regist_pref.value = document.frm.frm_regist_pref_cd.options[n].text;
		document.frm.submit();
	}
-->
</script>


</head>
<body bgcolor="#ffffff">

<?php echo e(html()->form('POST', '/zip/out/searchzip')->attributes(['name'=> 'frmZip', 'target' => 'ZipWin'])->style('margin:0px;')->open()); ?>

<?php echo e(html()->hidden('frm_zip1')); ?>

<?php echo e(html()->hidden('frm_zip2')); ?>

<?php echo e(html()->form()->close()); ?>



<br/>
<?php if(!empty($errors->all()) ): ?>
	<tr>
		<td>
          <font color=red>■入力内容に誤りがあります。以下のエラーをご確認下さい。
			<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<li style="list-style:none; color:red;"><?php echo e($error); ?></li>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</td>
	<tr>
<?php endif; ?>

<table width="600">

	<tr>
		<td nowrap  valign="top">【ご登録情報】</td>
		<td>&nbsp;</td>
		<td>
			<?php echo e(html()->form('POST', '/recognize/update/do')->attribute('name', 'frm')->style('margin:0px;')->open()); ?>

			<?php echo e(html()->hidden('frm_regist_pref')); ?>

			<?php echo e(html()->hidden('web_order_num' ,session()->get('weborderheader')['web_order_num'])); ?>

			
			<table class="new" width="500px" border="1"cellspacing="0"frame="hsides"rules="rows">
				<tr>
					<td class="item" width="200px">登録名義<span id="gray">[32文字/全角]</span></td>
					<?php if( session()->get('weborderheader')['contents_type'] == "54" || session()->get('weborderheader')['contents_type'] == "55" ): ?></td>
						<td>
							<?php echo e(html()->text('frm_regist_name', session()->get('weborderheader')['name1'] . session()->get('weborderheader')['name2'])->attributes(['size' => '50', 'maxlength' => '32'])->disabled()); ?>

						</td>
					<?php else: ?>
						<td>
							<?php echo e(html()->text('frm_regist_name', $frm_regist_name)->attributes(['size' => '50', 'maxlength' => '32'])); ?>

						</td>
					<?php endif; ?>
				</tr>
				<tr>
					<td class="item">登録名義(カタカナ)<span id="gray">[40文字/全角]</span></td>
					<?php if( session()->get('weborderheader')['contents_type'] == "54" || session()->get('weborderheader')['contents_type'] == "55" ): ?></td>
						<td>
							<?php echo e(html()->text('frm_regist_kana', session()->get('weborderheader')['name_kana1'])->attributes(['size' => '50', 'maxlength' => '40'])->disabled()); ?>

						</td>
					<?php else: ?>
						<td>
							<?php echo e(html()->text('frm_regist_kana', $frm_name_kana)->attributes(['size' => '50', 'maxlength' => '40'])); ?>

						</td>
					<?php endif; ?>
				</tr>
				<tr>
					<td class="item">代表者取締役または代表者<span id="gray">[15文字/全角]</span></td>
					<?php if( session()->get('weborderheader')['contents_type'] == "54" || session()->get('weborderheader')['contents_type'] == "55" ): ?></td>
						<td>
							<?php echo e(html()->text('frm_regist_ceo', session()->get('weborderheader')['president_name1'])->attributes(['size' => '50', 'maxlength' => '15'])->disabled()); ?>

						</td>
					<?php else: ?>
						<td>
							<?php echo e(html()->text('frm_regist_ceo', $frm_regist_ceo)->attributes(['size' => '50', 'maxlength' => '15'])); ?>

						</td>
					<?php endif; ?>
				</tr>
				<tr>
					<td class="item">代表者取締役または代表者(カタカナ)<br><span id="gray">[30文字/全角]</span></td>
					<?php if( session()->get('weborderheader')['contents_type'] == "54" || session()->get('weborderheader')['contents_type'] == "55" ): ?></td>
						<td>
							<?php echo e(html()->text('frm_regist_ceo_kana', session()->get('weborderheader')['president_name_kana1'])->attributes(['size' => '50', 'maxlength' => '30'])->disabled()); ?>

						</td>
					<?php else: ?>
						<td>
							<?php echo e(html()->text('frm_regist_ceo_kana', $frm_regist_ceo_kana)->attributes(['size' => '50', 'maxlength' => '30'])); ?>

						</td>
					<?php endif; ?>
				</tr>
				<tr>
					<td class="item">担当者名<span id="gray">[8文字/全角]</span></td>
					<td>
						<?php echo e(html()->text('frm_regist_name_of_charge', $frm_regist_name_of_charge)->attributes(['size' => '50', 'maxlength' => '8'])); ?>

					</td>
				</tr>
				<tr>
					<td class="item">担当者名(カタカナ)<span id="gray">[16文字/全角]</span></td>
					<td>
						<?php echo e(html()->text('frm_regist_name_of_charge_kana', $frm_regist_name_of_charge_kana)->attributes(['size' => '50', 'maxlength' => '16'])); ?>

					</td>
				</tr>
				<tr>
					<td class="item">メールアドレス<span id="essential">*</span><span id="gray">[半角]</span></td>
					<td>
						<?php echo e(html()->text('frm_regist_mail', $frm_regist_mail)->attributes(['size' => '50', 'maxlength' => '80'])); ?>

					</td>
				</tr>
				<tr>
					<td class="item">ホームページURL<span id="gray">[半角]</span></td>
					<td>
						<?php echo e(html()->text('frm_regist_url', $frm_regist_url)->attributes(['size' => '50', 'maxlength' => '100'])); ?>

						<div id="gray">(例) http://www.yayoi-kk.co.jp/</div>
					</td>
				</tr>
				<tr>
					<td class="item">郵便番号<span id="essential">*</span></td>
					<td>
						<?php echo e(html()->text('frm_regist_zip1', $frm_regist_zip1)->attributes(['size' => '7', 'maxlength' => '3'])); ?>

						&nbsp;-&nbsp;
						<?php echo e(html()->text('frm_regist_zip2', $frm_regist_zip2)->attributes(['size' => '7', 'maxlength' => '4'])); ?>

						<?php echo e(html()->button('住所検索')->class('address')->attribute('onClick', 'zip_search();return false;')); ?>

					<div id="gray">(例) 123 - 4567</div>
					</td>
				</tr>

				<tr>
					<td class="item">都道府県<span id="essential">*</span></td>
					<td>
						<SELECT name="frm_regist_pref_cd">
							<OPTION value="">選択して下さい
							<?php $__currentLoopData = $prefList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php echo e(html()->option($pre->pref_name, $pre->pref_cd ,($frm_regist_pref_cd == $pre->pref_cd))); ?>

							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</SELECT>
						<div id="gray">(例) 東京都</div>
					</td>
				</tr>

				<tr>
					<td class="item">市区町村<span id="essential">*</span><span id="gray">[16文字/全角]</span></td>
					<td>
						<?php echo e(html()->text('frm_regist_add1', $frm_regist_add1)->attributes(['size' => '50', 'maxlength' => '16'])); ?>

						<div id="gray">(例) 千代田区外神田</div>
					</td>
				</tr>
				<tr>
					<td class="item">丁番地<span id="essential">*</span><span id="gray">[20文字/全角]</span></td>
					<td>
						<?php echo e(html()->text('frm_regist_add2', $frm_regist_add2)->attributes(['size' => '50', 'maxlength' => '20'])); ?>

						<div id="gray">(例) ４丁目１４番１号</div>
					</td>
				</tr>
				<tr>
					<td class="item">建物名<span id="gray">[20文字/全角]</span></td>
					<td>
						<?php echo e(html()->text('frm_regist_add3', $frm_regist_add3)->attributes(['size' => '50', 'maxlength' => '20'])); ?>

						<div id="gray">(例) 秋葉原ＵＤＸ２１階</div>
					</td>
				</tr>
				<tr>
					<td class="item">登録電話番号<span id="gray">[半角]</span></td>
					<td>
						<?php echo e(html()->text('frm_regist_tel1', $frm_regist_tel1)->attributes(['size' => '4', 'maxlength' => '4'])); ?>

						&nbsp;-&nbsp;
						<?php echo e(html()->text('frm_regist_tel2', $frm_regist_tel2)->attributes(['size' => '4', 'maxlength' => '4'])); ?>

						&nbsp;-&nbsp;
						<?php echo e(html()->text('frm_regist_tel3', $frm_regist_tel3)->attributes(['size' => '4', 'maxlength' => '4'])); ?>

					</td>
				</tr>
					<td class="item">連絡先電話番号<span id="gray">[半角]</span></td>
					<td>
						<?php echo e(html()->text('frm_regist_contact_tel1', $frm_regist_contact_tel1)->attributes(['size' => '4', 'maxlength' => '4'])); ?>

						&nbsp;-&nbsp;
						<?php echo e(html()->text('frm_regist_contact_tel2', $frm_regist_contact_tel2)->attributes(['size' => '4', 'maxlength' => '4'])); ?>

						&nbsp;-&nbsp;
						<?php echo e(html()->text('frm_regist_contact_tel3', $frm_regist_contact_tel3)->attributes(['size' => '4', 'maxlength' => '4'])); ?>

					</td>
				</tr>
				<tr>
					<td class="item">連絡先FAX番号<span id="gray">[半角]</span></td>
					<td>
						<?php echo e(html()->text('frm_regist_contact_fax1', $frm_regist_contact_fax1)->attributes(['size' => '4', 'maxlength' => '4'])); ?>

						&nbsp;-&nbsp;
						<?php echo e(html()->text('frm_regist_contact_fax2', $frm_regist_contact_fax2)->attributes(['size' => '4', 'maxlength' => '4'])); ?>

						&nbsp;-&nbsp;
						<?php echo e(html()->text('frm_regist_contact_fax3', $frm_regist_contact_fax3)->attributes(['size' => '4', 'maxlength' => '4'])); ?>

					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<?php echo e(html()->button('　戻る　')->attributes(['name' => 'do_back', 'onClick' => 'javascript:history.back();'])); ?>　　
						<?php echo e(html()->button('　更新確定　')->attributes(['name' => 'do_update', 'onClick' => 'javascript:regCustSubmit();'])); ?>

					</td>
				</tr>
			</table>
			<?php echo e(html()->form()->close()); ?>

		</td>
	</tr>
	<tr>
		<td>
		</td>
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
<?php /**PATH /var/www/dwo2/resources/views/weborder/recognize/update.blade.php ENDPATH**/ ?>