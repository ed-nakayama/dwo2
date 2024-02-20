<?php

namespace App\Http\Controllers\Weborder\Order;

use App\Http\Controllers\Controller;

use App\Http\Controllers\Classes\OrderInfoSession;
use App\Http\Controllers\Classes\BasketSession;

class OrderConfirm extends Controller
{
    function index()
    {
		$orderinfosession = new OrderInfoSession();
		// 受注情報セット
		$orderinfo = $orderinfosession->get();

		$basketsession = new BasketSession();
		// バスケット情報セット
		// 消費税切捨て
		$basketCount = $basketsession->count();
		$basketList = $basketsession->toArrayForRegist();

		// 下記テンプレはお客様登録がある場合はCustinfo/InputDoからCALLされることに注意。
		return view('weborder.order.confirm' ,compact(
			'orderinfo',
			'basketCount',
			'basketList' ,
		));

    }
}
