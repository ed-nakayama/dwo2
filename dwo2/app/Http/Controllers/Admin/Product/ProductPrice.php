<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Classes\PriceDAO;

class ProductPrice extends Controller
{
	function index(Request $request)
	{
		$validatedData = $request->validate([
			'prodCode' => ['required'],
			'prodName' => ['required'],
		]);

		$prodCode = $request->input("prodCode");
		$prodName = $request->input("prodName");

		$priceDAO = new PriceDAO();

		$priceList = $priceDAO->findList($prodCode);

		$total = count($priceList);

		return view('admin.product.price',
			[
			'priceList'   => $priceList,
			'total'       => $total,
			'prodCode'    => $prodCode,
			'prodName'    => $prodName,
			]);
	}


/*************************************
 * 新規登録
**************************************/
    function regist(Request $request) {

		$validated = $request->validate([
			'prodCode'      => ['required'],
			'prodName'      => ['required'],
			'supCode'       => ['required'],
			'supShortName'  => ['nullable'],
			'supLicenseNum' => ['nullable'],
			'priceClass'    => ['required'],
			'samplePrice'   => ['nullable', 'max:11'],
			'prodPrice'     => ['nullable'],
			'supPrice'      => ['nullable'],
			'agentLevel1'   => ['nullable'],
			'agentLevel2'   => ['nullable'],
			'agentLevel3'   => ['nullable'],
			'agentLevel4'   => ['nullable'],
			'agentLevel5'   => ['nullable'],
			'agentLevel6'   => ['nullable'],
			'agentLevel7'   => ['nullable'],
			'agentLevel8'   => ['nullable'],
		]);

		$loginUser = Auth::user();

        $priceDAO = new PriceDAO();
        $price = $priceDAO->insert($loginUser->operator_id ,$validated);

		return redirect()->route('admin.product.price', 
			[
			'prodCode'        => $request->input("prodCode"),
			'prodName'        => $request->input("prodName"),
			])
			->with('status', 'success-regist');
    }


/*************************************
 * 更新
**************************************/
    function store(Request $request) {

		$validated = $request->validate([
			'seqList.*'           => ['required'],
			'supCodeList.*'       => ['nullable'],
			'supShortNameList.*'  => ['nullable'],
			'supLicenseNumList.*' => ['nullable'],
			'priceClassList.*'    => ['required'],
			'samplePriceList.*'   => ['nullable', 'max:11'],
			'prodPriceList.*'     => ['nullable'],
			'supPriceList.*'      => ['nullable'],
			'agentLevel1List.*'   => ['nullable'],
			'agentLevel2List.*'   => ['nullable'],
			'agentLevel3List.*'   => ['nullable'],
			'agentLevel4List.*'   => ['nullable'],
			'agentLevel5List.*'   => ['nullable'],
			'agentLevel6List.*'   => ['nullable'],
			'agentLevel7List.*'   => ['nullable'],
			'agentLevel8List.*'   => ['nullable'],
			'delList.*'           => ['nullable'],
		]);

		$loginUser = Auth::user();

		$priceDAO = new PriceDAO();
		$price = $priceDAO->update($loginUser->operator_id ,$validated);

		return redirect()->route('admin.product.price', 
			[
			'prodCode'        => $request->input("prodCode"),
			'prodName'        => $request->input("prodName"),
			])
			->with('status', 'success-store');
    }


}
