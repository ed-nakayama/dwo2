<?php

namespace App\Http\Controllers\Weborder\Common;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Controllers\Classes\BasketSession;


class CommonShoppingcart extends Controller
{
    function index()
    {

		$basketsession = new BasketSession();

		$basketCount    = $basketsession->count();
		$basketList     = $basketsession->toArray();
		$basketTotal    = $basketsession->totalPrice() + $basketsession->taxPrice();
		$basketTax      = $basketsession->taxPrice();
		$basketSubTotal = $basketsession->totalPrice();

		return view('weborder.common.shoppingcart', compact(
			'basketCount',
			'basketList',
			'basketTotal',
			'basketTax',
			'basketSubTotal',
		));
    }
}
