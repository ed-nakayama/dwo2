<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Classes\StatusDAO;
use App\Models\ProductStatusMt;

class ProductStatus extends Controller
{

/*************************************
* 商品ステータスマスタ一覧
**************************************/
	public function index()
	{
		$statusDAO = new StatusDAO();
		$dataList = $statusDAO->find();
		
		return view('admin.product.status',compact(
			'dataList',
		));
	}


/*************************************
* 商品ステータスマスタ 新規登録
**************************************/
	public function regist(Request $request)
	{
		$validated = $request->validate([
			'new_code' => ['required' ,'unique:DWO_product_status_mt,prod_status_id'],
			'new_name' => ['required'],
		]);

		$admin = Auth::user();

		$status = new ProductStatusMt();
		
		$status->prod_status_id          = $request->new_code;
		$status->prod_status_name        = $request->new_name;
		$status->prod_status_modified_id = $admin->operator_id;
		$status->prod_status_del         = '0';

		$status->save();

		return redirect()->route('admin.product.status')
			->with('status', 'success-regist');
	}


/*************************************
* 商品ステータスマスタ 保存
**************************************/
    function store(Request $request) {

		$validated = $request->validate([
			'codeList.*'    => ['required'],
			'nameList.*'    => ['nullable'],
			'delList.*'     => ['nullable'],
		]);


		$admin = Auth::user();

		$statusDAO = new StatusDAO();
		$dataList = $statusDAO->update($admin->operator_id ,$validated);

		return redirect()->route('admin.product.status', 
			['page' => $request->input('page'), 
			])
			->with('status', 'success-store');
    }

}
