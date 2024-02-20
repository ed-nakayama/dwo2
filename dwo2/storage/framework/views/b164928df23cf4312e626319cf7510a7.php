<?php if (isset($component)) { $__componentOriginal91fdd17964e43374ae18c674f95cdaa3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal91fdd17964e43374ae18c674f95cdaa3 = $attributes; } ?>
<?php $component = App\View\Components\AdminLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('admin-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AdminLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

<head>
	<title>郵便番号辞書更新</title>


	<script type="text/javascript">
		$(function(){
			$("#form").submit(function(){
				$('#submit').attr('disabled', true);
				$('#errors').empty();
				$('#msg').empty();
				$("#loading").html("<img src='img/gif-load.gif'/>");
			});
		});
	</script>

</head>




	<h1>郵便番号辞書更新</h1>

	<div id="instraction" class="instraction" style="text-align:left;border-style:dotted; border-color:#32cd32; position: relative; width: 910px;" >
		<div id="loading" style="position: absolute; top: 40%; left: 45%; opacity:0.5;"><br /></div>
		<h3>♪使い方♪</h3>
		<h4>その１：最新の郵便番号データを自動的にダウンロードして更新する方法。<span style="color:#32cd32;">（オススメ！）</span></h4>
		<ul style="list-style:decimal">
			<li>「更新」ボタンを押下し、完了を待ちます。</li>
<pre style="color:red;">
※日本郵便株式会社の郵便番号データダウンロードページが停止している場合、郵便番号データがダウンロードできずエラーになります。
　しばらく時間を置いてから再度実行してください。
　それでもエラーになる場合は、情報システム部のお問い合わせください。
</pre>
		</ul>
		<h4>その２：郵便番号データを自分ダウンロードして更新する方法。</h4>
		<ul style="list-style:decimal">
			<li>
				<a style="color: -webkit-link;cursor: pointer;text-decoration: underline;" href="http://www.post.japanpost.jp/zipcode/dl/kogaki-zip.html" target="brank">日本郵便株式会社の郵便番号データダウンロードページ</a>から、
				最新の郵便番号データをパソコンの任意の場所（デスクトップなど）にダウンロードします。
				<ul style="list-style:disc">
					<li>ZIP形式のデータファイルをダウンロードしてください。</li>
					<li>「読み仮名データの促音・拗音を小書きで表記するもの」を選択してください。</li>
					<li>「都道府県一覧」メニュー内の、「全国一括」データファイルを選択してください。</li>
				</ul>
			</li>
			<li>このページの「参照」ボタンをクリックし、ダウンロードした郵便番号データを選択します。</li>
			<li>「更新」ボタンを押下し、完了を待ちます。</li>
		</ul>
	</div>
	
	<div id="errors" style="margin-left:350px;">
        <?php if(session('flash_message')): ?>
				<li style="list-style:none; color:red;"><?php echo e(session('flash_message')); ?></li>
		<?php endif; ?>
	</div>
	
	<?php echo e(html()->form('POST', '/admin/zipdata/update/result')->attribute('name', 'form')->acceptsFiles()->open()); ?>

		郵便番号辞書データ：
	<?php echo e(html()->file('zipdata_file')->attribute('accept', 'application/zip')); ?>

	<?php echo e(html()->submit('更新')); ?>

	<?php echo e(html()->form()->close()); ?>




 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal91fdd17964e43374ae18c674f95cdaa3)): ?>
<?php $attributes = $__attributesOriginal91fdd17964e43374ae18c674f95cdaa3; ?>
<?php unset($__attributesOriginal91fdd17964e43374ae18c674f95cdaa3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal91fdd17964e43374ae18c674f95cdaa3)): ?>
<?php $component = $__componentOriginal91fdd17964e43374ae18c674f95cdaa3; ?>
<?php unset($__componentOriginal91fdd17964e43374ae18c674f95cdaa3); ?>
<?php endif; ?><?php /**PATH /var/www/dwo2/resources/views/admin/zipdata/updateForm.blade.php ENDPATH**/ ?>