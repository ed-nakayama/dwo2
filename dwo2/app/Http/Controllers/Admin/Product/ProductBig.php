<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Classes\BigDAO;
use App\Models\BigCategoryMt;

class ProductBig extends Controller
{

/*************************************
* 大分類一覧
**************************************/
	public function index()
	{
        $bigDAO = new BigDAO();
        $validated['search_del'] = '1';
        $bigList = $bigDAO->findByDeleteType($validated['search_del']);

		return view('admin.product.big',
			[
			'bigList'    => $bigList,
			'search_del' => '1',
			]);
	}


/*************************************
 * 検索
**************************************/
    function search(Request $request) {

		$validated = $request->validate([
			'search_del' => ['required'],
		]);

        $bigDAO = new BigDAO();
        $bigList = $bigDAO->findByDeleteType($validated['search_del']);

		return view('admin.product.big',[
			'bigList'    => $bigList,
			'search_del' => $request->input('search_del'),
			]);
    }


/*************************************
 * 新規登録
**************************************/
    function regist(Request $request) {

		$validated = $request->validate([
			'new_code'     => ['required' ,'unique:DWO_big_category_mt,big_category_code'],
			'new_name'     => ['required'],
		]);

		$admin = Auth::user();

		$big = new BigCategoryMt();

		$big->big_category_code        = $request->new_code;
		$big->big_category_name        = $request->new_name;
		$big->big_category_old_product = isset($request->new_old_prod) ? $request->new_old_prod : '0';
		$big->big_category_modified_id = $admin->operator_id;
		$big->big_category_del         = '0';

		$big->save();

		return redirect()->route('admin.product.big.search', [
			'search_del' => $request->input('search_del'),
			])
			->with('status', 'success-regist');
    }


/*************************************
 * 更新
**************************************/
    function store(Request $request) {

		$validated = $request->validate([
			'codeList.*'    => ['required'],
			'nameList.*'    => ['required'],
			'oldProdList.*' => ['nullable'],
			'delList.*'     => ['nullable'],
		]);


		$admin = Auth::user();

		$bigDAO = new BigDAO();
		$retBig = $bigDAO->update_list($admin->operator_id ,$validated);

		return redirect()->route('admin.product.big.search', [
			'search_del' => $request->input('search_del'),
			])
			->with('status', 'success-store');
    }


}
