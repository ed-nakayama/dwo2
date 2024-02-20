<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use App\Http\Controllers\Classes\CustDAO;
use App\Http\Controllers\Classes\DeliveryDAO;

class OrderDelivery extends Controller
{

/*************************************
* 納品先マスタ 検索
**************************************/
	public function search(Request  $request)
	{
		$validated = $request->validate([
			'search_cust_code'     => ['required', 'string'],
			'search_delivery_name' => ['nullable', 'string'],
			'search_tel'           => ['nullable', 'numeric'],
			'search_addr'         => ['nullable', 'string'],
		]);

		$param['search_cust_code']     = !empty($request->search_cust_code)     ? $request->search_cust_code     : null;
		$param['search_delivery_name'] = !empty($request->search_delivery_name) ? $request->search_delivery_name : null;
		$param['search_tel']           = !empty($request->search_tel)           ? $request->search_tel           : null;
		$param['search_addr']          = !empty($request->search_addr)          ? $request->search_addr          : null;

		$cust_param['search_cust_code'] = $param['search_cust_code'];

		$custDAO = new CustDAO();
//		$custList = $custDAO->find($cust_param);
		$cust = $custDAO->find_by_id($param['search_cust_code']);

//		if (empty($custList[0])) {
		if (empty($cust)) {
			throw ValidationException::withMessages([
				'search_cust_code' => '得意先が存在しません。',
			]);
		}

//		$cust = $custList[0];

		$deliveryDAO = new DeliveryDAO();
		$dataList = $deliveryDAO->find($validated);
		$dataList->append($param);

		return view('admin.order.delivery' ,
			[
			'cust'                 => $cust,
			'dataList'             => $dataList,
			'param'                => $param,

//			'search_cust_code'     => $request->input('search_cust_code'),
//			'search_delivery_name' => $request->input('search_delivery_name'),
//			'search_tel'           => $request->input('search_tel'),
//			'search_addr'          => $request->input('search_addr'),
		]);
	}



/*************************************
* 納品先マスタ 保存
**************************************/
    function store(Request $request) {

		$validated = $request->validate([
			'codeList.*'       => ['required'],
			'seqList.*'        => ['required'],
			'destList.*'       => ['required'],
			'personNameList.*' => ['nullable'],
			'telList.*'        => ['nullable'],
			'faxList.*'        => ['nullable'],
			'zipList.*'        => ['nullable'],
			'prefList.*'       => ['nullable'],
			'address1List.*'   => ['nullable'],
			'address2List.*'   => ['nullable'],
			'address3List.*'   => ['nullable'],
			'delList.*'        => ['nullable'],
		]);
/*
		$param['search_cust_code']     = !empty($request->search_cust_code)     ? $request->search_cust_code     : null;
		$param['search_delivery_name'] = !empty($request->search_delivery_name) ? $request->search_delivery_name : null;
		$param['search_tel']           = !empty($request->search_tel)           ? $request->search_tel           : null;
		$param['search_addr']          = !empty($request->search_addr)          ? $request->search_addr          : null;
*/
		$loginUser = Auth::user();

		$deliveryDAO = new DeliveryDAO();
		$dataList = $deliveryDAO->update_list($loginUser->operator_id, $validated);

		return redirect()->route('admin.order_delivery.search', 
			['page'                 => $request->input('page'), 
			'search_cust_code'     => $request->input('search_cust_code'),
			'search_delivery_name' => $request->input('search_delivery_name'),
			'search_tel'           => $request->input('search_tel'),
			'search_addr'          => $request->input('search_addr'),
			])
			->with('status', 'success-store');
	}


}
