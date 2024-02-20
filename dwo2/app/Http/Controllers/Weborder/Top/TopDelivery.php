<?php

namespace App\Http\Controllers\Weborder\Top;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Classes\DeliveryDAO;

class TopDelivery extends Controller
{

/*************************************
* 納品先　検索
**************************************/
	public function index(Request $request)
	{
		// 納品先検索
		$deliveryDAO = new DeliveryDAO();

		// 条件セット
		$param['delivery_cust_code'] = \Auth::user()->profile_cust_code;
		$param['delivery_seq'] = $request->frm_delivery_seq;
		$param['delivery_name'] = $request->frm_delivery_name;
		$param['delivery_tel'] = $request->frm_delivery_tel;

		// データ検索
		$deliveryList = $deliveryDAO->findweb($param);

		$OtherListCount = 0;
		if (!empty($deliveryList[0])) {
			$OtherListCount = count($deliveryList);
		}
		
		return view('weborder.top.deliveryselect',
			[
			'OtherList'         => $deliveryList,
			'OtherListCount'    => $OtherListCount,
			'frm_delivery_seq'  => $request->input('frm_delivery_seq'),
			'frm_delivery_name' => $request->input('frm_delivery_name'),
			'frm_delivery_tel'  => $request->input('frm_delivery_tel'),
			]);
    }


/*************************************
* 納品先　詳細
**************************************/
	public function detail(Request $request)
	{
		// 納品先検索
		$deliveryDAO = new DeliveryDAO();

		// 別の納品先を指定された場合はここで条件追加
		$param['delivery_cust_code'] = \Auth::user()->profile_cust_code;
		$param['delivery_seq'] = $request->frm_delivery_seq;

		// データ検索
		$deliveryList = $deliveryDAO->findweb($param);

		$data = null;
		if (!empty($deliveryList[0])) {
			$data = $deliveryList[0]; // 条件を付加しているので必ず１件のみ取得できる
//		} else {
//			$res = Ethna::raiseNotice('データ検索時にエラーが発生しました。', E_DWO_SYSERROR );
//			$this->ae->addObject(null, $res);
//			return 'weborder_error';
		}

		return view('weborder.top.deliverydetail',
			[
			'deliveryData'         => $data,
			]);
    }



/*************************************
* 納品先　削除
**************************************/
	public function delete(Request $request)
	{
		// 納品先検索
		$deliveryDAO = new DeliveryDAO();

		// 別の納品先を指定された場合はここで条件追加
		$param['delivery_cust_code'] = \Auth::user()->profile_cust_code;
		$param['delivery_seq'] = $request->frm_delivery_seq;
		$deliveryList = $deliveryDAO->findweb($param);

		if (!empty($deliveryList[0])) {
			$data = $deliveryList[0]; // 条件を付加しているので必ず１件のみ取得できる

			// 削除実行
			$deliveryDAO->delete($data);
		}

        return redirect('/top/delivery');
    }

}
