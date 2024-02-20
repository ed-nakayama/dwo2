<?php

namespace App\Http\Controllers\Weborder\Order;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Controllers\Classes\OrderInfoSession;
use App\Http\Controllers\Classes\BasketSession;

class OrderDetailinput extends Controller
{
    function index()
    {
		$basketsession = new BasketSession();

		// 消費税切捨て
		$tax = floor($basketsession->taxPrice());

		$orderinfosession = new OrderInfoSession();
		$orderinfo = $orderinfosession->get();

		return view('weborder.order.detailinput' ,
			[
			'orderinfo'      => $orderinfo,
			'basketCount'    => $basketsession->count(),
			'basketList'     => $basketsession->toArray(),
			'basketTax'      => $tax,
			'basketTotal'    => $basketsession->totalPrice() + $tax,
			'basketSubTotal' => $basketsession->totalPrice(),
			]
		);
    }
}
