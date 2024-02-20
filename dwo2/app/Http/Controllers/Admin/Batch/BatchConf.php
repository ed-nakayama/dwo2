<?php

namespace App\Http\Controllers\Admin\Batch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Classes\AcceptanceManager;
use App\Http\Controllers\Classes\UpgradeAcceptanceManager;
use App\Http\Controllers\Classes\ProductDAO;
use App\Http\Controllers\Classes\WebOrderHeaderDAO;

use App\Models\BatchConf as Batch;

class BatchConf extends Controller
{
	public $msg = '';

    /**
     * Display the user's profile form.
     */
    public function index()
    {
		$batch = Batch::first();
        
		return view('admin.batch.conf',compact(
				'batch'
			));
    }


    /****************************************
     * 保存
     ****************************************/
    public function store(Request $request)
    {
		$msg = '';

		if (!empty($request->input('update'))) {

			\DB::table('DWO_batch_conf')->update([
				'batch_acceptance_cancel_day'    => $request->cancelDay,
//				'batch_acceptance_cancel_enable' => !empty($request->cancelEnable) ? 1 : 0,
				'batch_acceptance_demand_day'    => $request->demandDay,
//				'batch_acceptance_demand_enable' => !empty($request->demandEnable) ? 1 : 0,
				'batch_upgrade_cancel_day'       => $request->upgradeCancelDay,
//				'batch_upgrade_cancel_enable'    => !empty($request->upgradeCancelEnable) ? 1 : 0,
				'batch_upgrade_demand_day'       => $request->upgradeDemandDay,
//				'batch_upgrade_demand_enable '   => !empty($request->upgradeDemandEnable) ? 1 : 0,
			]);

			$msg = "更新しました。";

		} else if (!empty($request->input('exec_closing'))) { // 締め処理

			$stat = $this->closing();
			$msg = $this->msg;

		} else if (!empty($request->input('exec_cancel'))) { // 承認期限切れ注文取り消し処理
			$acceptanceManager = new AcceptanceManager($this);
			$acceptanceManager->Cancel($request->input('cancelDay'), $request->input('cancelEnable'));
			$msg = "承認期限切れ注文取り消し処理を実行しました。";

		} else if (!empty($request->input('exec_demand'))) { // 承認督促メール送信
			$acceptanceManager = new AcceptanceManager($this);
			$acceptanceManager->Demand($request->input('demandDay'), $request->input('demandEnable'));
			$msg = "承認督促メール送信処理を実行しました。";

		} else if (!empty($request->input('exec_upgradeCancel'))) { // 承認期限切れ注文取り消し処理
			$upgradeAcceptanceManager = new UpgradeAcceptanceManager($this);
			$upgradeAcceptanceManager->Cancel($request->input('upgradeCancelDay'), $request->input('upgradeCancelEnable'));
			$msg = "アップグレード承認期限切れ注文取り消し処理を実行しました。";

		} else if (!empty($request->input('exec_upgradeDemand'))) { // 承認督促メール送信
			$upgradeAcceptanceManager = new UpgradeAcceptanceManager($this);
			$upgradeAcceptanceManager->Demand($request->input('upgradeDemandDay'), $request->input('upgradeDemandEnable'));
			$msg = "アップグレード承認督促メール送信処理を実行しました。";
		}

		return redirect()->route('admin.batch.conf')->with('flash_message', $msg);
    }


    /****************************************
     * 締め処理
     ****************************************/
    public function closing()
	{

		$batchdate = date("Y/m/d H:i:s");
		$productDAO = new ProductDAO();
		$webOrderHeaderDAO = new WebOrderHeaderDAO();

		try {
			$webOrderHeaderDAO->updateShippingStatusForBatch();
			$webOrderHeaderDAO->updateStatusReserve2ShippingForBatch();
			$productDAO->updateInStock();
		} catch(Exception $e) {
			$this->msg = "エラーが発生しました。".$batchdate."[".$e->getMessage()."]";

			return 'NG';
		}
		
		$this->msg = "締め処理を実行しました。";

		return 'OK';
	}
	
	
}
