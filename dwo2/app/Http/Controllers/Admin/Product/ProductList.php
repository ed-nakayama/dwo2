<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Classes\ProductDAO;

class ProductList extends Controller
{

/*************************************
* 製品マスタ一覧
**************************************/
	public function index()
	{
        $productDAO = new ProductDAO();
        $prodList = $productDAO->findNew();

		return view('admin.product.list',
			[
			'prodList' => $prodList,
			'prodCode' => '',
			'webOrder' => '',
			'status'   => '',
			'del'      => '',
			'newFlag'  => '',
			]);
	}


/*************************************
* 製品マスタ一覧 検索
**************************************/
	public function search_list(Request $request)
	{
		$param = $request->only(
			'prodCode',
			'webOrder',
			'status',
			'del',
			'newFlag',
		);

        $productDAO = new ProductDAO();
        $prodList = $productDAO->find($param);

		return view('admin.product.list' ,
			[
			'prodList' => $prodList,
			'prodCode' => $request->input('prodCode'),
			'webOrder' => $request->input('webOrder'),
			'status'   => $request->input('status'),
			'del'      => $request->input('del'),
			'newFlag'  => $request->input('newFlag'),
			]
		);
	}


/*************************************
* 製品マスタ 保存
**************************************/
	public function store(Request $request)
	{
		$param = $request->only(
			'codeList',
			'samplePriceList',
			'startDateList',
			'endDateList',
			'statusList',
			'shipDateList',
			'webOrderList',
			'visiblePAPStdList',
			'visiblePAPGoldList',
			'visibleYbpPapList',
			'visibleYBPList',
			'delList',
		);

		$loginUser = Auth::user();

        $productDAO = new ProductDAO();
        $prodList = $productDAO->update_list($loginUser->operator_id, $param);

		return redirect()->route('admin.product.list.search', 
			['page'    => $request->input('page'), 
			'prodCode' => $request->input('prodCode'),
			'webOrder' => $request->input('webOrder'),
			'status'   => $request->input('status'),
			'del'      => $request->input('del'),
			'newFlag'  => $request->input('newFlag'),
			])
			->with('status', 'success-store');
	}


}
