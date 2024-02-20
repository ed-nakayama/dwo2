			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<p class="sidebar">ユーザー情報</p>
					</td>
				<tr>
			</table>
			<table border="0">
				<tr>
					<td>
						<table border="1" cellspacing="0" frame="hsides" rules="rows" width="370px">
							<tr>
								<td class="item" width="17%">貴社ID</td>
								<td width="33%">&nbsp;<?php echo e(session('agentView')->cust_num); ?></td>
								<td width="20%">&nbsp;</td>
								<td width="30%">&nbsp;</td>
							</tr>
							<tr>
								<td class="item">貴社名</td>
								<td colspan="3">&nbsp;<?php echo e(session('agentView')->name1 . session('agentView')->name2); ?></td>
							</tr>
							<tr>
								<td class="item">ご担当者</td>
								<td colspan="3">&nbsp;<?php echo e(session('agentView')->contact_name1); ?>&nbsp;&nbsp;様</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
<?php /**PATH /var/www/dwo2/resources/views/weborder/common/userinfo.blade.php ENDPATH**/ ?>