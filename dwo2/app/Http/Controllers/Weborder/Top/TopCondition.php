<?php

namespace App\Http\Controllers\Weborder\Top;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\Classes\WebOrderHeaderDAO;
use App\Http\Controllers\Classes\CreditInfoManager;

class TopCondition extends Controller
{

/*************************************
* お取引条件
**************************************/
	public function index()
	{
		$custCode = \Auth::user()->profile_cust_code;

		$webOrderHeaderDAO = new WebOrderHeaderDAO();
		$lastupdate = $webOrderHeaderDAO->findLastUpdate($custCode);

		// 与信データ取得
		$creditInfoManager = new CreditInfoManager();
		$creditinfo = $creditInfoManager->GetCreditData($custCode);

		return view('weborder.top.condition' ,compact(
			'lastupdate',
			'creditinfo',
		));
	}


}
