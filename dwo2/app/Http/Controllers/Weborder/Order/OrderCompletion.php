<?php

namespace App\Http\Controllers\Weborder\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Validation\ValidationException;

use App\Http\Controllers\Classes\OrderRegistManager;
use App\Http\Controllers\Classes\BasketSession;
use App\Http\Controllers\Classes\OrderInfoSession;

class OrderCompletion extends Controller
{
/******************************************
 * 保存
 ******************************************/
   function store(Request $request)
    {

		if ($request->input("frm_regist") == "EXEC") {

			// 登録、メール送信処理
			$orderRegistManager = new OrderRegistManager();
			$result = $orderRegistManager->RegistOrder();

			if (!empty($result)) {
				return redirect()->route('order.syserror');
			}

			// (２重登録防止用)
			// バスケット情報のクリア
			$basketsession = new BasketSession();
			$basketsession->clear();

			// オーダー情報のクリア
			$orderinfosession = new OrderInfoSession();
			$orderinfo = $orderinfosession->get();
			$syonin_mail_flg = $orderinfo->syonin_mail_flg;

			// オーダー情報のクリア
			$orderinfosession->resetComplete(); // 必要な情報は残す
 			$orderinfosession->setToSession();
		}

		return redirect()->route('order.completion') 
			->with(['status' => 'success-store', 'syonin_mail_flg' => $syonin_mail_flg]);
    }


}
