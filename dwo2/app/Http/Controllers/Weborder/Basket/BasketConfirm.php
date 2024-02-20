<?php

namespace App\Http\Controllers\Weborder\Basket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Classes\BasketSession;
use App\Http\Controllers\Classes\CreditInfoManager;
use App\Http\Controllers\Classes\OrderInfoSession;

class BasketConfirm extends Controller
{

/*************************************
* 買い物かご確認
**************************************/
    function index(Request $request)
    {
		$orderinfosession = new OrderInfoSession();
		$orderinfo = $orderinfosession->get();

		$user = Auth::user();// 顧客番号を取得

		$basketsession = new BasketSession();

		// 与信エラー時対応としてバスケット状態をバックアップ
		$backupList = $basketsession->toArray();

		if (!empty($request->input("frm_prod_cd"))) {
			$prod_cd_ary = $request->input("frm_prod_cd"); // フォーム値の商品コードを取得
			for ($i=0; $i<count($prod_cd_ary); $i++) {
				$frm_delchk = $request->input("frm_delchk_".$prod_cd_ary[$i]); // フォーム値の削除チェックボックスを取得
				
				$div_cd = explode("_", $prod_cd_ary[$i], 2);
				if ($frm_delchk == "1") {
					// バスケットから削除
					$basketsession->del($div_cd[0], $div_cd[1]);

					if($basketsession->count() == 0) {
						return redirect()->route('item.select');
					}
					
				} else {
					// 件数更新
					$frm_count = $request->input("frm_count_".$prod_cd_ary[$i]); // フォーム値の数量を取得
					$basket = $basketsession->getBasket($div_cd[0], $div_cd[1]);
					$basket->count = $frm_count;
					$basketsession->EditBasket($basket);
				}
			}
		}

		// 与信チェック
		$creditinfomanager = new CreditInfoManager();
		$creditinfo = $creditinfomanager->GetCreditData($user->profile_cust_code);

		$yosin_error = ''; // テンプレ表示判定用
		if (config('dwo.CREDIT_LIMIT_ERROR_FLG') == 1) {
			
			if ($creditinfo->yuyo < 0) {
//				$res = Ethna::raiseNotice('限度額を超過してしまいます。', E_DWO_SYSERROR );
//				$this->ae->addObject(null, $res);
				$yosin_error = 'on'; // テンプレ表示判定用
	
				// バスケット状態を元に戻す。
				$basketsession->setFromArray($backupList);
	
				// 管理者へメール送信
				$mailcreditlimit = new MailCreditLimit($this);
				$mailcreditlimit->MailCreLimit("購入内容変更時");
			}
			
		}
		
		// 消費税切捨て
		$tax = floor($basketsession->taxPrice());

		return view('weborder.basket.confirm',
		[
			'orderinfo'    => $orderinfo,
			'yosin_error'    => $yosin_error,
			'basketCount'    => $basketsession->count(),
			'basketList'     => $basketsession->toArray(),
			'basketTax'      => $tax,
			'basketTotal'    => $basketsession->totalPrice()+$tax,
			'basketSubTotal' => $basketsession->totalPrice(),
		]);
    }
}
