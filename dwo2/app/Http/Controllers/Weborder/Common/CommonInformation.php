<?php

namespace App\Http\Controllers\Weborder\Common;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\InfoMt;

class CommonInformation extends Controller
{

/*************************************
* Information
**************************************/
	public function index()
	{
		$agentView = session('agentView');

		if ($agentView->cust_class_code == "OR" || $agentView->cust_class_code == "YBP") {
			$info = InfoMt::select('msg')->first();
			$information = $info->msg;

		} else { // PAP専用お知らせ
			$info = InfoMt::select('msg2')->first();
			$information = $info->msg2;
		}
		
		return view('weborder.common.information' ,compact(
			'information',
		));
	}


}
