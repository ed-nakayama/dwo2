<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Classes\OrderHistoryFinder;

class OrderSearchHistory extends Controller
{

/*************************************
* 受注履歴照会
**************************************/
	public function index()
	{
		$param['orderNum']       = null;
		$param['orderStartDate'] = null;
		$param['orderEndDate']   = null;
		$param['statusId']       = null;
		$param['custNum']        = null;
		$param['custName']       = null;
		$param['itemCode']       = null;
		$param['custOrderNum']   = null;
		$param['custClass']      = null;
		$param['custDel']        = '1';
		$param['operatorDel']    = '1';

		$finder = new OrderHistoryFinder();
		$dataList = $finder->find($param);

		$totalItemQuantity = $finder->total_vol;
 		$dataCount = $dataList->total();

		return view('admin.order.searchHistory',
			[
			'dataList'          => $dataList,
			'param'             => $param,
			'totalItemQuantity' => $totalItemQuantity,
			'dataCount'         => $dataCount,
		]);
	}


/*************************************
* 受注履歴照会 検索
**************************************/
	public function search(Request $request)
	{
		$param['orderNum']       = $request->orderNum;
		$param['orderStartDate'] = $request->orderStartDate;
		$param['orderEndDate']   = $request->orderEndDate;
		$param['statusId']       = $request->statusId;
		$param['custNum']        = $request->custNum;
		$param['custName']       = $request->custName;
		$param['itemCode']       = $request->itemCode;
		$param['custOrderNum']   = $request->custOrderNum;
		$param['custClass']      = $request->custClass;
		$param['custDel']        = $request->custDel;
		$param['operatorDel']    = $request->operatorDel;

		$finder = new OrderHistoryFinder();
		$dataList = $finder->find($param);

		$totalItemQuantity = $finder->total_vol;
 		$dataCount = $dataList->total();

		return view('admin.order.searchHistory',
			[
			'dataList'          => $dataList,
			'param'             => $param,
			'totalItemQuantity' => $totalItemQuantity,
			'dataCount'         => $dataCount,
		]);
	}


}
