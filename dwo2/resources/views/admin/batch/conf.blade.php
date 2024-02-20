<x-admin-layout>

<head>
	<title>承認バッチ設定</title>
</head>

{{--------------------------------------------------------------------}}

    @if (session('flash_message'))
		<FONT color="red">{{ session('flash_message') }}</font>
	@endif


{{ html()->form('POST', '/admin/batch/conf/store')->open() }}

<h4>【承認期限切れ注文取り消し処理】</h4>
　注文日から{{ html()->text('cancelDay', $batch->batch_acceptance_cancel_day)->attributes(['size' => '5', 'maxlength' => '3']) }}日
　バッチ{{ html()->checkbox('cancelEnable', $batch->batch_acceptance_cancel_enable, '1')->disabled() }}
　{{ html()->submit('実行')->value('submit')->attribute('name', 'exec_cancel') }}

<h4>【承認督促メール送信】</h4>
　注文日から{{ html()->text('demandDay', $batch->batch_acceptance_demand_day)->attributes(['size' => '5', 'maxlength' => '3']) }}日
　バッチ{{ html()->checkbox('demandEnable', $batch->batch_acceptance_demand_enable, '1')->disabled() }}
　{{ html()->submit('実行')->value('submit')->attribute('name', 'exec_demand') }}

<h4>【アップグレード承認期限切れ注文取り消し処理】</h4>
　月末最終営業日から{{ html()->text('upgradeCancelDay', $batch->batch_upgrade_cancel_day)->attributes(['size' => '5', 'maxlength' => '3']) }}日前
　バッチ{{ html()->checkbox('upgradeCancelEnable', $batch->batch_upgrade_cancel_enable, '1')->disabled() }}
　{{ html()->submit('実行')->value('submit')->attribute('name', 'exec_upgradeCancel') }}

<h4>【アップグレード承認督促メール送信】</h4>
　月末最終営業日から{{ html()->text('upgradeDemandDay', $batch->batch_upgrade_demand_day)->attributes(['size' => '5', 'maxlength' => '3']) }}日前
　バッチ{{ html()->checkbox('upgradeDemandEnable', $batch->batch_upgrade_demand_enable, '1')->disabled() }}
　{{ html()->submit('実行')->value('submit')->attribute('name', 'exec_upgradeDemand') }}

<h4>【締め処理】</h4>
　{{ html()->submit('実行')->value('submit')->attribute('name', 'exec_closing') }}


<hr/>

<center>{{ html()->submit('更新')->value('submit')->attribute('name', 'update') }}</center>

{{ html()->form()->close() }}

{{--------------------------------------------------------------------}}

</x-admin-layout>
