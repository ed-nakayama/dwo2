<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Classes\OrderStatusDAO;

use App\Models\OrderStatusMt;

class OrderStatus extends Controller
{

/*************************************
* 製品マスタ一覧
**************************************/
	public function index()
	{
		$dataList = OrderStatusMt::orderBy('order_status_id')
			->get();
		 
		return view('admin.order.status',compact(
			'dataList',
		));
	}


/*************************************
 * 新規登録
**************************************/
    function regist(Request $request) {

		$validated = $request->validate([
			'new_id'   => ['required' ,'unique:DWO_order_status_mt,order_status_id'],
			'new_name' => ['required'],
		]);

		$admin = Auth::user();

		$status = new OrderStatusMt();

		$status->order_status_id          = $request->new_id;
		$status->order_status_name        = $request->new_name;
		$status->order_status_modified_id = $admin->operator_id;
		$status->order_status_del         = '0';

		$status->save();

		return redirect()->route('admin.order.status', 
			['page' => $request->input('page'), 
			])
			->with('status', 'success-regist');
    }


/*************************************
 * 更新
**************************************/
    function store(Request $request) {

		$validated = $request->validate([
			'idList.*'   => ['required'],
			'nameList.*' => ['required'],
			'sortList.*' => ['nullable'],
			'delList.*'  => ['nullable'],
		]);

		$admin = Auth::user();

		 $orderStatusDAO = new OrderStatusDAO();
		 $ope = $orderStatusDAO->update($admin->operator_id ,$validated);

		return redirect()->route('admin.order.status', 
			['page' => $request->input('page'), 
			])
			->with('status', 'success-store');

    }


}
