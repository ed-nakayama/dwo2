<?php

namespace App\Http\Controllers\Classes;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Http\Controllers\Classes\CalCreditLimitDAO;
use App\Http\Controllers\Classes\CreditInfo;
use App\Http\Controllers\Classes\WebOrderHeaderDAO;
use App\Http\Controllers\Classes\BasketSession;

class CreditInfoManager
{

 /*************************************************************
 * 与信情報を取得します。<br>
 * ※与信計算にバスケット金額を含めたい場合はGetCreditDataファンクションを仕様
 * 
 * @param string custCode 顧客コード
 * @return CreditInfo 与信情報
 *
 * 利用ファイル
 *   admin/cust/custDetail.php find()
 *   classes/custDAO.php find()
 ***************************************************************/
    public function GetCreditDataByCustCode($custCode)
    {
		// 与信残額の取得
		$calcreditlimit = new CalCreditLimitDAO();
		$calcreditlimit->getCreditLimit($custCode);

		$total_amt = 0;
		// 受注未処理金額の取得
		$weborderheaderdao = new WebOrderHeaderDAO();
		$total_amt = $weborderheaderdao->findTempCredit($custCode);

		// 各取得データを与信クラスにセット
		$creditinfo = new CreditInfo();
		$creditinfo->credit_limit       = $calcreditlimit->o_max_limit;
		$creditinfo->credit_balance     = $calcreditlimit->o_credit_limit;
		$creditinfo->now_temp_order_sum = $total_amt;
		$creditinfo->basket_sum = 0;

		// 表示データ用内部算出
		$creditinfo->yuyo = $creditinfo->credit_balance - $creditinfo->now_temp_order_sum - $creditinfo->basket_sum;
		$creditinfo->zan  = $creditinfo->credit_limit - $creditinfo->yuyo;

		return $creditinfo;

    }


 /*************************************************************
 * 与信情報を取得します
 * @param Ethna::Session ses 顧客情報、バスケット情報を含むセッションオブジェクト
 * @return CreditInfo 与信情報
 *
 * 利用ファイル
 *   Requests/Auth/LoginRequest.php userCheck()
 *   weborder/Top/TopHome.php index()
 *   weborder/Top/TopCondition.php index()
 *   weborder/Basket/BasketConfirm.php index()
 *   weborder/Item/Itemselect.php regist()
 *   weborder/Top/TopHomeupgrade.php index() - 未使用
 ***************************************************************/
    public function GetCreditData($custCode = null)
    {
		$creditinfo = $this->GetCreditDataByCustCode($custCode);

		$basket_sum = 0;
		// 現在のバスケットを取得
		$basketsession = new BasketSession();
		$creditinfo->basket_sum = $basketsession->totalPrice() + $basketsession->taxPrice();

		// 表示データ用内部算出
		$creditinfo->yuyo = $creditinfo->credit_balance - $creditinfo->now_temp_order_sum - $basket_sum;
		$creditinfo->zan  = $creditinfo->credit_limit - $creditinfo->yuyo;

		return $creditinfo;
    }


}
