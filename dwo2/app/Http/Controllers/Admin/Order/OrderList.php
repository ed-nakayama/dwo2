<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Classes\OrderHeaderViewDAO;
use App\Http\Controllers\Classes\OrderDetailViewDAO;
use App\Http\Controllers\Classes\AgentViewDAO;


class OrderList extends Controller
{

/*************************************
* 受付状況確認
**************************************/
	public function index()
	{
		$param['orderNum']       = null;
		$param['orderStartDate'] = null;
		$param['orderEndDate']   = null;
		$param['custNum']        = null;
		$param['custName']       = null;
		$param['custNameKana']   = null;
		$param['custTel']        = null;
		$param['deliveryType']   = null;
		$param['deliveryName']   = null;
		$param['nameOfCharge']   = null;
		$param['statusId']       = null;
		$param['inputType']      = null;
		$param['custDel']        = '1';
		$param['operatorDel']    = '1';
		$param['inputStartDate'] = null;
		$param['inputEndDate']   = null;
		
		$orderHeaderViewDAO = new OrderHeaderViewDAO();

		$dataList = $orderHeaderViewDAO->find($param ,"DESC");

		$dataList->appends($param);

		return view('admin.order.list' ,
			[
			'dataList' => $dataList,
			'param'    => $param,
		]);

	}


/*************************************
* 受付状況確認
**************************************/
	public function list(Request $request)
	{
		$param['orderNum']       = !empty($request->orderNum)       ? $request->orderNum       : null;
		$param['custNum']        = !empty($request->custNum)        ? $request->custNum        : null;
		$param['orderStartDate'] = !empty($request->orderStartDate) ? $request->orderStartDate : null;
		$param['orderEndDate']   = !empty($request->orderEndDate)   ? $request->orderEndDate   : null;
		$param['custName']       = !empty($request->custName)       ? $request->custName       : null;
		$param['custNameKana']   = !empty($request->custNameKana)   ? $request->custNameKana   : null;
		$param['prefList']       = !empty($request->prefList)       ? $request->prefList       : null;
		$param['custTel']        = !empty($request->custTel)        ? $request->custTel        : null;
		$param['deliveryType']   = isset($request->deliveryType)    ? $request->deliveryType   : null;
		$param['deliveryName']   = !empty($request->deliveryName)   ? $request->deliveryName   : null;
		$param['nameOfCharge']   = !empty($request->nameOfCharge)   ? $request->nameOfCharge   : null;
		$param['statusId']       = isset($request->statusId)        ? $request->statusId       : null;
		$param['inputType']      = !empty($request->inputType)      ? $request->inputType      : null;
		$param['custDel']        = !empty($request->custDel)        ? $request->custDel        : '1';
		$param['operatorDel']    = !empty($request->operatorDel)    ? $request->operatorDel    : '1';
		$param['inputStartDate'] = !empty($request->inputStartDate) ? $request->inputStartDate : null;
		$param['inputEndDate']   = !empty($request->inputEndDate)   ? $request->inputEndDate   : null;

		$orderHeaderViewDAO = new OrderHeaderViewDAO();

		if (empty($request->input('print'))) {
			$dataList = $orderHeaderViewDAO->find($param ,"DESC");

			$dataList->appends($param);

		} else {
			ini_set("memory_limit", "512M");
			
			$orderHeaderList = $orderHeaderViewDAO->find($param ,"ASC");

			$orderDetailViewDAO = new OrderDetailViewDAO();

			$arg = 0;
			foreach ($orderHeaderList as $orderheader) {
				$orderDetailList = $orderDetailViewDAO->findById($orderheader->web_order_num);
				$orderHeaderList[$arg++]->orderDetailList = $orderDetailList;
			}

			$pdf = \PDF::loadView('pdf_templates.pdf_bill',compact(
				'orderHeaderList',
			));
			$pdf->setPaper('A4');
		
			return $pdf->download('pdf_bill.pdf');
		}

		return view('admin.order.list' ,
			[
			'dataList' => $dataList,
			'param'    => $param,
		]);
	}


/*************************************
* 受付状況確認 印刷
**************************************/
	public function print(Request $request)
	{

		$param = $request->only(
			'orderNum',
			'orderStartDate',
			'orderEndDate',
			'custNum',
			'custName',
			'custNameKana',
			'custTel',
			'deliveryType',
			'deliveryName',
			'nameOfCharge',
			'statusId',
		);

		$orderHeaderViewDAO = new OrderHeaderViewDAO();

		$dataList = $orderHeaderViewDAO->find($param ,"ASC");

		return view('admin.order.list' ,compact(
			'dataList',
		));
	}


/*************************************
* 受付状況確認 詳細
**************************************/
	public function detail(Request $request)
	{
		$orderHeaderViewDAO = new OrderHeaderViewDAO();
		$headerView = $orderHeaderViewDAO->findById($request->input('orderNum'));

		$secondaryCustNum  = "";
		$secondaryCustName = "";

		// ２次店顧客番号から顧客情報を取得(オリコン、TMの場合)
		if (!empty($headerView->secondary_cust_num) ) {
			$agentviewDAO = new AgentViewDAO();
			$agentView = $agentviewDAO->findById($headerView->secondary_cust_num);

			$secondaryCustNum  = $agentView->cust_num;
			$secondaryCustName = $agentView->name1 . $agentView->name2;
		}

		$orderDetailViewDAO = new OrderDetailViewDAO();
		$detailViewList = $orderDetailViewDAO->findById($request->input('orderNum'));

		return view('admin.order.detail' ,compact(
			'headerView',
			'detailViewList',
			'secondaryCustNum',
			'secondaryCustName',
		));
	}


/*************************************
* 受付状況確認　詳細　保存
**************************************/
	public function store(Request $request)
	{
		$validated = $request->validate([
			'orderNum'           => ['required'],
			'stateType'          => ['required'],
			'orderDate'          => ['nullable'],
			'shippingDate'       => ['nullable'],
			'orderPersonName'    => ['nullable'],
			'doublePackageType'  => ['nullable'],
			'deliveryDateType'   => ['nullable'],
			'deliveryDate'       => ['nullable'],
			'deliveryTimeType'   => ['nullable'],
			'destName1'          => ['nullable'],
			'destPost'           => ['nullable', 'max:8'],
			'destPrefCd'         => ['nullable'],
			'destAddress1'       => ['nullable'],
			'destAddress2'       => ['nullable'],
			'destAddress3'       => ['nullable'],
			'destContactName1'   => ['nullable'],
			'destTel'            => ['nullable', 'max:20'],
			'destFax'            => ['nullable', 'max:20'],
			'directDeliveryType' => ['nullable'],
			'deliverMemo'        => ['nullable'],
			'custDelType'        => ['nullable'],
			'operatorDelType'    => ['nullable'],
		]);

		$validated2 = $request->validate([
			'orderNum'          => ['required'],
			'orderLineNum.*'    => ['nullable'],
			'custOrderNum.*'    => ['nullable'],
			'itemCd.*'          => ['nullable'],
			'itemPrice.*'       => ['nullable'],
			'itemVol.*'         => ['nullable'],
			'itemAmt.*'         => ['nullable'],
			'itemTaxRate.*'     => ['nullable'],
			'itemTax.*'         => ['nullable'],
			'itemDel.*'         => ['nullable'],
		]);


		$admin = Auth::user();

		$orderDetailViewDAO = new OrderDetailViewDAO();

		// 明細の更新
		if ($request->input('contentsType') == "40" || $request->input('contentsType') == "81" || $request->input('contentsType') == "82") {
			$orderDetailViewDAO->update($admin->operator_id, $validated2);
		}

		// ヘッダの更新
		$orderHeaderViewDAO = new OrderHeaderViewDAO();
		$orderHeaderViewDAO->update($admin->operator_id, $validated);


		return redirect()->route('admin.order.list.detail', 
			[
			'orderNum' => $request->input('orderNum'),
			])
			->with('status', 'success-store');

	}


}
