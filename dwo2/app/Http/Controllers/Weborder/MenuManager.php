<?php

namespace App\Http\Controllers\Weborder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Classes\OrderInfoSession;

class MenuManager extends Controller
{
	static function menuArray() {
      
		$menuAry = array(array("key" => "home"        , "viewstr" => "ホーム"          , "link" => "/home"),
                         array("key" => "itemselect"  , "viewstr" => "商品選択"        , "link" => "/item/select"),
                         array("key" => "itemdetail"  , "viewstr" => "商品詳細"        , "link" => "/item/detail"),
                         array("key" => "basket"      , "viewstr" => "買い物かご確認"  , "link" => "/basket/confirm"),
                         array("key" => "order"       , "viewstr" => "オーダー詳細入力", "link" => "/order/detailinput"),
                         array("key" => "delivery"    , "viewstr" => "納品先指定選択"  , "link" => "/delivery/select"),
                         array("key" => "custinfo"    , "viewstr" => "お客様情報入力"  , "link" => "/custinfo/input"),
                         array("key" => "orderconfirm", "viewstr" => "オーダー確認"    , "link" => "/order/confirm"),
                         array("key" => "complete"    , "viewstr" => "オーダー完了"    , "link" => "/order/completion"),
                       );

		return $menuAry;
	}
	
	
	/**********************************************
	 * 指定ページまでのmenuを配列化しappへセット
	 **********************************************/
	public static function setMenu($keyName) {

		$retAry = array();

		// お客様情報登録を表示させるかどうかでセッション情報を取得
		$orderinfosession = new OrderInfoSession();
		$orderinfo = $orderinfosession->get();

		$menuAry = self::menuArray();

		for ($i = 0; $i < count($menuAry); $i++) {
			if ($keyName == $menuAry[$i]["key"]) {
				// homeのみ例外
				if ($keyName == "home") {
					$retAry[] = array("viewstr" => $menuAry[$i]["viewstr"], "link" => $menuAry[$i]["link"]);
				} else {
					$retAry[] = array("viewstr" => $menuAry[$i]["viewstr"], "link" => "#");
				}
				break;
			} else {
				if (($orderinfo->cust_regist_flg == "") && ($menuAry[$i]["key"] == "custinfo")) {
					// 非表示
				} else {
					$retAry[] = array("viewstr" => $menuAry[$i]["viewstr"], "link" => $menuAry[$i]["link"]);
				}
			}
		}

		$menuList = '';

		foreach ($retAry as $dwomenu) {
			if ($dwomenu['link'] == "#") {
				$menuList .= '<a>' . $dwomenu['viewstr'] . '</a>&nbsp;&gt;&nbsp;';
			} else {
				$menuList .= '<a href="' . $dwomenu['link'] . '">' . $dwomenu['viewstr'] . '</a>&nbsp;&gt;&nbsp;';
			}
		}

		return $menuList;
	}


	/*
	 * 先頭と最後のみをリンク化
	 */
	public static function setMenuComplete() {

		$retAry = array();

		$menuAry = self::menuArray();

		// お客様情報登録を表示させるかどうかでセッション情報を取得
		$orderinfosession = new OrderInfoSession();
		$orderinfo = $orderinfosession->get();

		for ($i = 0; $i < count($menuAry); $i++) {

			if ($i == 0) {
				$retAry[] = array("viewstr" => $menuAry[$i]["viewstr"], "link" => $menuAry[$i]["link"]);
			} else if ($i==count($menuAry)-1) {
				$retAry[] = array("viewstr" => $menuAry[$i]["viewstr"], "link" => "#");
			} else {
				if (($orderinfo->cust_regist_flg == "") && ($menuAry[$i]["key"] == "custinfo")) {
					// 非表示
				} else {
					$retAry[] = array("viewstr" => $menuAry[$i]["viewstr"], "link" => "#");
				}
			}
		}

		$menuList = '';

		foreach ($retAry as $dwomenu) {
			if ($dwomenu['link'] == "#") {
				$menuList .= '<a>' . $dwomenu['viewstr'] . '</a>&nbsp;&gt;&nbsp;';
			} else {
				$menuList .= '<a href="' . $dwomenu['link'] . '">' . $dwomenu['viewstr'] . '</a>&nbsp;&gt;&nbsp;';
			}
		}

		return $menuList;
	}
}
?>
