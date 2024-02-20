<table border="0" width="100%">
	<tr>
		<td width="600px">
			<p>
				<?php if(!empty($menu)): ?><?php echo e($menu); ?><?php endif; ?>
			</p>
		</td>
		<td align="right">
			<p class="login">
			<form method="POST" action="/logout" name="logoutForm">
			<?php echo csrf_field(); ?>
			<?php if(!empty($manual)): ?>
				<a href="<?php echo e(asset('assets/cust/pdf/manual.pdf')); ?>" target="_blank"><img src="<?php echo e(asset('assets/cust/img/usage.png')); ?>" alt="マニュアル" width="60px" height="20px"></a>&nbsp;&nbsp;
			<?php endif; ?>
			<?php if(!empty($menu)): ?>
				<a href="" onclick="event.preventDefault(); this.closest('form').submit();"><img src="<?php echo e(asset('assets/cust/img/logout.png')); ?>" alt="ログアウト" width="60px" height="20px"></a>
			<?php endif; ?>
			</form>
			</p>
		</td>
	</tr>
</table>
<?php /**PATH /var/www/dwo2/resources/views/weborder/common/menu.blade.php ENDPATH**/ ?>