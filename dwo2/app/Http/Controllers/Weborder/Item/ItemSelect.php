<?php

namespace App\Http\Controllers\Weborder\Item;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use App\Http\Controllers\Classes\OrderInfoSession;
use App\Http\Controllers\Classes\ProductlistViewDAO;
use App\Http\Controllers\Classes\Basket;
use App\Http\Controllers\Classes\BasketSession;
use App\Http\Controllers\Classes\CreditInfoManager;

use App\Mail\AlertCreditLimit;

class ItemSelect extends Controller
{

/*************************************
* 商品選択
**************************************/
   function index()
    {
		$orderinfosession = new OrderInfoSession();
		$orderinfo = $orderinfosession->get();

		return view('weborder.item.select', compact(
			'orderinfo',
			));
    }


/*************************************
* 商品詳細
**************************************/
    function detail(Request $request)
    {
		// データ検索
		$orderinfosession = new OrderInfoSession();
		$orderinfo = $orderinfosession->get();

		$agentview = session('agentView');

		$productlistviewDAO = new ProductlistViewDAO($orderinfo, $agentview);
		$productlistviewDAO->sales_stop = $request->input("frm_salesstop"); // 0,1,null
	
		if ($request->input("frm_salesstop") == '') {
			// 商品コード、商品名検索
			$productlistviewDAO->product_code = $request->input("frm_prod_code");
			$productlistviewDAO->item_name_kanji = $request->input("frm_prod_name");
		} else {
			// グループ検索
			$productlistviewDAO->product_category_big_code = $request->input("frm_bigcode");
			$productlistviewDAO->product_category_middle_code = $request->input("frm_midcode");
		}

		$prList = $productlistviewDAO->findUniqList();
		// 配列化
		$aryLst = array();
		
		for ($i = 0; $i < $prList->size(); $i++) {
			$prod = $prList->get($i);
			$aryLst[] = $prod->toArray();
		}

		session()->put('keep_prodList' ,$aryLst);

		return view('weborder.item.detail',
			[
			'yosin_error'   => '',
			'orderinfo'      => $orderinfo,
			'keep_prodList'  => $aryLst,
			'keep_bigcode'   => $request->input('frm_bigcode'),
			'keep_midcode'   => $request->input('frm_midcode'),
			'keep_salesstop' => $request->input('frm_salesstop'),
			'keep_prod_name' => $request->input('frm_prod_name'),
			'keep_prod_code' => $request->input('frm_prod_code'),
			]
		);

    }


/*************************************
* 商品購入
**************************************/
    function regist(Request $request)
    {
		// バスケット登録
		$basketsession = new BasketSession();

		// バスケット追加でloop用のセッション商品リストを取得
		$keepSesProdList = session()->get("keep_prodList");

		$agentView = session('agentView');

		$frmCount = 0;

		// 指定数量と予約受付け中判定チェック
		for ($i=0; $i<count($keepSesProdList); $i++) {
			$name_cntfrm = "frm_add_count_".$keepSesProdList[$i]['product_code']."_".$keepSesProdList[$i]['price_product_sup_code'];

			$cnt = $request->input($name_cntfrm);

			// 指定数量チェック
			if ( !empty($cnt) && $cnt <= 0 ) {
				throw ValidationException::withMessages([
					'under_one' => '数量には1個以上を指定して下さい。',
				]);
			}

			// 予約受付け中判定チェック
			if ( empty($cnt) ) {
				$frmCount++; // 全数量が空をチェックするためのカウントをUP
			} else {
				if (!is_numeric($cnt)) {
					throw ValidationException::withMessages([
						'no_num' => '半角数字を入力して下さい。',
					]);
				}
			}
		}

		if ((count($keepSesProdList) > 0) && (count($keepSesProdList) == $frmCount)) {
			throw ValidationException::withMessages([
				'no_num' => '注文される商品の数量を入力して下さい。',
			]);
		}

		// エラー時対応としてバスケット状態をバックアップ
		$backupList = $basketsession->toArray();

		for ($i=0; $i<count($keepSesProdList); $i++) {
			
			$name_cntfrm = "frm_add_count_".$keepSesProdList[$i]['product_code']."_".$keepSesProdList[$i]['price_product_sup_code'];

			// 値(数量)が入っているものだけ
			if ($request->input($name_cntfrm) != "") {

				// 追加用バスケットの作成(HTMLリクエストパラメータをキーにセッション情報からセットする)
				$basket = new Basket();
				$basket->product_code        =  $keepSesProdList[$i]['product_code'];
				$basket->item_name_kanji     =  ($keepSesProdList[$i]['price_product_sup_code']=="")?$keepSesProdList[$i]['item_name_kanji']:$keepSesProdList[$i]['item_name_kanji']." ".$keepSesProdList[$i]['price_product_sup_short'];
				$basket->base_name           =  $keepSesProdList[$i]['item_name_kanji']; // 初期名称を保存
				$basket->count               =  $request->input($name_cntfrm);
				$basket->status              =  $keepSesProdList[$i]['product_status_id'];
				$basket->sales_price         =  $keepSesProdList[$i]['sales_price'];
				$basket->price_invoice_price =  $keepSesProdList[$i]['view_invoce_price'];
				$basket->item_class_large    =  $keepSesProdList[$i]['item_class_large'];
				$basket->item_class_medium    =  $keepSesProdList[$i]['item_class_medium'];
				$basket->item_ship_date    =  $keepSesProdList[$i]['product_ship_date'];

				$basket->support_code       =  $keepSesProdList[$i]['price_product_sup_code'];
				$basket->support_price      =  $keepSesProdList[$i]['support_price'];
				$basket->sup_item_name      =  $keepSesProdList[$i]['sup_item_name'];
				$basket->support_base_price =  $keepSesProdList[$i]['support_base_price'];

				if ($basket->support_price == "") {
					$basket->support_price = "0"; // numeric初期化
				}
				if (($basket->support_code!="") && ($basket->sup_item_name=="")) {
					$basket->sup_item_name = "サポート契約料金"; // DB不整合により名称が未登録のものに対応
				}
				if (($basket->support_code!="") && ($basket->support_base_price=="")) {
					$basket->support_base_price = $basket->support_price; // DB不整合により金額が未登録のものに対応
				}

				if ($basket->price_invoice_price == "") {
					throw ValidationException::withMessages([
						'no_price' => '提供価格が設定されていないため、この商品を購入することは出来ません。',
					]);
				}

				try {
					// 登録
					$basketsession->add($basket);
				} catch(Exception $e) {
					
					// バスケット状態を元に戻す。
					$basketsession->setFromArray($backupList);

					throw ValidationException::withMessages([
						'invalid_error' => '不明なエラーが発生しました。',
					]);
				}
			}
		}

		// 与信チェック
		$creditinfomanager = new CreditInfoManager();
		$creditinfo = $creditinfomanager->GetCreditData($agentView->cust_num);
			
		$yosin_error = '';
			
		if (config('dwo.CREDIT_LIMIT_ERROR_FLG') == 1) {
			
			if ($creditinfo->yuyo < 0) {
				$yosin_error = "on"; // テンプレ表示判定用
	
				// バスケット状態を元に戻す。
				$basketsession->setFromArray($backupList);
	
				// 管理者へメール送信
				Mail::send(new AlertCreditLimit($agentView , '購入商品選択時'));
	
				throw ValidationException::withMessages([
					'over_limit' => '限度額を超過してしまいます。',
				]);
			}

		}
			

		return redirect()->route('item.detail', 
			[
			'yosin_error'   => $yosin_error,
			'frm_bigcode'   => $request->input('frm_bigcode'),
			'frm_midcode'   => $request->input('frm_midcode'),
			'frm_salesstop' => $request->input('frm_salesstop'),
			'frm_prod_name' => $request->input('frm_prod_name'),
			'frm_prod_code' => $request->input('frm_prod_code'),
			])
			->with('status', 'success-store');

	}



}
