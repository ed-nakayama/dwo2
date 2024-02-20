<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Classes\ProductDAO;
use App\Http\Controllers\Classes\CategoryDAO;

use App\Models\ProductCategoryMt;

class ProductCategory extends Controller
{

/*************************************
* 商品分類登録マスタ検索
**************************************/
	public function index()
	{
		return view('admin.product.categoryList',
			[
			'prodCode'  => '',
			]);
	}


/*************************************
* 商品分類登録マスタ 詳細
**************************************/
	public function detail(Request $request)
	{
		$validated = $request->validate([
			'prodCode' => ['required','exists:DWO_product_mt,product_code'],
		]);

		$productDAO = new ProductDAO();
		$prodList = $productDAO->find($validated);

		$prod = $prodList[0];

		$categoryDAO = new CategoryDAO();
		$dataList = $categoryDAO->findDelSort($validated['prodCode']);

		return view('admin.product.category',
			[
			'prod'             => $prod,
			'dataList'         => $dataList,
			'prodCode' => $request->input('prodCode'),
			]);
	}


/*************************************
* 商品分類登録マスタ 新規登録
**************************************/
	public function regist(Request $request)
	{
		$validated = $request->validate([
			'prodCode' => ['required','exists:DWO_product_mt,product_code'],
			'bigCode'  => ['required'],
			'midCode'  => ['required'],
		]);

		$admin = Auth::user();

		$cat = new ProductCategoryMt();
		
		$cat->product_category_code        = $request->prodCode;
		$cat->product_category_big_code    = $request->bigCode;
		$cat->product_category_middle_code = $request->midCode;
		$cat->product_category_modified_id = $admin->operator_id;
		$cat->product_category_del         = '0';
		$cat->product_category_no          = ProductCategoryMt::max('product_category_no') + 1;

		$cat->save();


		return redirect()->route('admin.product.category', [
			'prodCode' => $request->input('prodCode'),
			])
			->with('status', 'success-regist');
    }


/*************************************
* 商品分類登録マスタ 保存
**************************************/
    function store(Request $request) {

		$validated = $request->validate([
			'codeList.*'    => ['required'],
			'bigCodeList.*' => ['required'],
			'midCodeList.*' => ['required'],
			'delList.*'     => ['nullable'],
		]);

		$loginUser = Auth::user();

		$categoryDAO = new CategoryDAO();
		$dataList = $categoryDAO->update_list($loginUser->operator_id, $validated);

		return redirect()->route('admin.product.category', [
			'prodCode' => $request->input('prodCode'),
			])
			->with('status', 'success-store');
	}


}
