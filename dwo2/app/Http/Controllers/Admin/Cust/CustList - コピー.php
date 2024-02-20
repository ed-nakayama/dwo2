<?php

namespace App\Http\Controllers\Admin\Cust;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Classes\CreditInfoManager;
use App\Http\Controllers\Classes\CustDAO;

class CustList extends Controller
{

/*************************************
* 顧客サブマスタ一覧
**************************************/
	public function findNew()
	{
		$loginUser = Auth::user();
		
		$custDAO = new CustDAO();
		$custDAO->findNew($loginUser->operator_id);

		$param['search_cust_code']   = '';
		$param['search_account_num'] = '';
		$param['search_name']        = '';
		$param['search_name_kana']   = '';
		$param['search_tel']         = '';
		$param['search_web_flag']    = '';
		$param['search_del_flag']    = '';

		return view('admin.cust.list' ,
			[
			'custList' => '',
			'param' => $param,
		]);
	}


/*************************************
* 顧客サブマスタ一覧 検索
**************************************/
	public function findList(Request $request)
	{
		$validated = $request->validate([
			'search_cust_code'   => ['nullable'],
			'search_account_num' => ['nullable'],
			'search_name'        => ['nullable'],
			'search_name_kana'   => ['nullable'],
			'search_tel'         => ['nullable'],
			'search_web_flag'    => ['nullable'],
			'search_del_flag'    => ['nullable'],
		]);

		$custDAO = new CustDAO();
		$custList = $custDAO->find($validated);

		// ページング時の検索パワラメータ渡しのため
		$param['search_cust_code']   = $request->search_cust_code;
		$param['search_account_num'] = $request->search_account_num;
		$param['search_name']        = $request->search_name;
		$param['search_name_kana']   = $request->search_name_kana;
		$param['search_tel']         = $request->search_tel;
		$param['search_web_flag']    = $request->search_web_flag;
		$param['search_del_flag']    = $request->search_del_flag;

		$custList->appends($param);

		return view('admin.cust.list' ,
			[
			'custList' => $custList,
			'param' => $param,
		]);
	}


/*************************************
* 顧客サブマスタ 詳細
**************************************/
	public function find(Request $request)
	{
		$validated = $request->validate([
			'cust_code' => ['required'],
		]);

		$param['search_cust_code'] = $request->input('cust_code');

		$custDAO = new CustDAO();
		$custList = $custDAO->find($param);

		if (empty($custList[0])) {
			return back()->with(['status' => 'fail-search']);
		}

		$cust = $custList[0];


		// 与信残額の取得
		if (!empty($cust->profile_cust_code) ) {
			$creditInfoManager = new CreditInfoManager();
			$creditInfo = $creditInfoManager->GetCreditDataByCustCode($cust->profile_cust_code);

			$cust->limitPrice = $creditInfo->credit_limit;
			$cust->salesPrice = $creditInfo->credit_limit - $creditInfo->credit_balance;
			$cust->zanPrice   = $creditInfo->now_temp_order_sum;
			$cust->restPrice   =$creditInfo->yuyo;
		}


		return view('admin.cust.detail' ,compact(
			'cust',
		));
	}


/*************************************
* 顧客サブマスタ 更新
**************************************/
	public function store(Request $request)
	{
		$validated = $request->validate([
			'cust_code'       => ['required'],
			'mail_flag'       => ['nullable'],
			'extra_mail'      => ['nullable', 'email'],
			'extra_mail_flag' => ['nullable'],
			'web_flag'        => ['nullable'],
			'comment'         => ['nullable'],
			'del_flag'        => ['nullable'],
		]);


		$admin = Auth::user();

		$custDAO = new CustDAO();
		$custList = $custDAO->update($admin->operator_id, $validated);

		return redirect()->route('admin.cust.detail', [
			'cust_code' => $request->input('cust_code'),
			])
			->with(['status' => 'success-updated']);
	}


}
