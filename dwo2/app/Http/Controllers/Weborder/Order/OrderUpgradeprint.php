<?php

namespace App\Http\Controllers\Weborder\Order;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Controllers\Classes\WebOrderHeaderDAO;
use App\Http\Controllers\Classes\WebOrderDetailDAO;
use App\Http\Controllers\Classes\AgentViewDAO;


class OrderUpgradeprint extends Controller
{
	public function viewer(Request $request)
	{
		$weborderheaderdao = new WebOrderHeaderDAO();
		$orderheader = $weborderheaderdao->find($request->input('orderNum'));

		$weborderdetaildao = new WebOrderDetailDAO();
		$orderdetailList = $weborderdetaildao->findNamePlus($request->input('orderNum'));

		$agentViewDao = new AgentViewDAO();
		$agentView = $agentViewDao->findById($orderheader->cust_num);

		return view('weborder.order.upgradeprint' ,[
			'agentView'       => $agentView,
			'orderheader'     =>  $orderheader,
			'orderdetailList' => $orderdetailList,
		]);
    }

}
