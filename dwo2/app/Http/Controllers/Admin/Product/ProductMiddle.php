<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Classes\MiddleDAO;
use App\Models\MiddleCategoryMt;

class ProductMiddle extends Controller
{

/*************************************
* 中分類一覧
**************************************/
	public function index(Request $request)
	{
		$validated['search_del'] = 1;
		
		$middleDAO = new MiddleDAO();
		$middleList = $middleDAO->findList($validated);

		return view('admin.product.middle',
			[
			'middleList'      => $middleList,
			'search_code'     => '',
			'search_big_code' => '',
			'search_name'     => '',
			'search_prodLink' => '',
			'search_supLink'  => '',
			'search_del'      => '1',
			]);
	}


/*************************************
* 条件検索
**************************************/
    public function search(Request $request) {

		$validated = $request->validate([
			'search_code'     => ['nullable'],
			'search_big_code' => ['nullable'],
			'search_name'     => ['nullable'],
			'search_prodLink' => ['nullable'],
			'search_supLink'  => ['nullable'],
			'search_del'      => ['nullable'],
		]);

		// 検索条件のリダイレクト対策
		if (\old('search_code'))     $validated['search_code']     = \old('search_code');
		if (\old('search_big_code')) $validated['search_big_code'] = \old('search_big_code');
		if (\old('search_name'))     $validated['search_name']     = \old('search_name');
		if (\old('search_prodLink')) $validated['search_prodLink'] = \old('search_prodLink');
		if (\old('search_supLink'))  $validated['search_supLink']  = \old('search_supLink');
		if (\old('search_del'))      $validated['search_del']      = \old('search_del');

		$middleDAO = new MiddleDAO();
		$middleList = $middleDAO->findList($validated);

		return view('admin.product.middle',
			[
			'middleList'      => $middleList,
			'search_code'     => !empty($validated['search_code'])     ? $validated['search_code']     : '',
			'search_big_code' => !empty($validated['search_big_code']) ? $validated['search_big_code'] : '',
			'search_name'     => !empty($validated['search_name'])     ? $validated['search_name']     : '',
			'search_prodLink' => !empty($validated['search_prodLink']) ? $validated['search_prodLink'] : '',
			'search_supLink'  => !empty($validated['search_supLink'])  ? $validated['search_supLink']  : '',
			'search_del'      => !empty($validated['search_del'])      ? $validated['search_del']      : '',
			]);
    }


/*************************************
* 新規登録
**************************************/
    function regist(Request $request) {

		$validated = $request->validate([
			'new_code'     => ['required' ,'unique:DWO_middle_category_mt,middle_category_code'],
			'new_name'     => ['required'],
			'new_big_code' => ['required'],
			'new_prodLink' => ['nullable'],
			'new_supLink'  => ['nullable'],
		]);


		$admin = Auth::user();

		$mid = new MiddleCategoryMt();
		
		$mid->middle_big_category_code      = $request->new_big_code;
		$mid->middle_category_code          = $request->new_code;
		$mid->middle_category_name          = $request->new_name;
		$mid->middle_category_link_flag     = !empty($request->new_prodLink) ? '1' : '0';
		$mid->middle_category_sup_link_flag = !empty($request->new_supLink)  ? '1' : '0';
		$mid->middle_category_modified_id   = $admin->operator_id;
		$mid->middle_category_del           = '0';

		$mid ->save();

		return redirect()->route('admin.product.middle.search', [
			'search_code'     => $request->input('search_code'),
			'search_big_code' => $request->input('search_big_code'),
			'search_name'     => $request->input('search_name'),
			'search_prodLink' => $request->input('search_prodLink'),
			'search_supLink'  => $request->input('search_supLink'),
			'search_del'      => $request->input('search_del'),
			])
			->with('status', 'success-regist');
    }


/*************************************
 * 更新
**************************************/
    function store(Request $request) {

		$validated = $request->validate([
			'codeList.*'     => ['required'],
			'bigCodeList.*'  => ['required'],
			'nameList.*'     => ['nullable'],
			'prodLinkList.*' => ['nullable'],
			'supLinkList.*'  => ['nullable'],
			'delList.*'      => ['nullable'],
	]);

		$loginUser = Auth::user();

		$middleDAO = new MiddleDAO();
		$middleList = $middleDAO->update_list($loginUser->operator_id, $validated);

		return redirect()->route('admin.product.middle.search', [
			'search_code'     => $request->input('search_code'),
			'search_big_code' => $request->input('search_big_code'),
			'search_name'     => $request->input('search_name'),
			'search_prodLink' => $request->input('search_prodLink'),
			'search_supLink'  => $request->input('search_supLink'),
			'search_del'      => $request->input('search_del'),
			])
			->with('status', 'success-store');
    }


}
