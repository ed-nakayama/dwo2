<?php

namespace App\Http\Controllers\Classes;

use App\Models\MItem;
use App\Models\ORDER_DTL;

class OrderDetailViewDAO {

	public $util;
/*
 * コンストラクタ
 */
	function __construct() {
		// 初期化
		$this->util = new Util();
	}


 /*************************************************************
 * 条件検索
 *
 * 利用ファイル
 *   admin/order/OrderList.php list()
 *   admin/order/OrderLisDetail.php detail()
 *   admin/order/OrderLis2Detail.php detail()
 ***************************************************************/
    public function findById($orderNum) {

		$detailViewList = ORDER_DTL::join('M_ITEM', 'M_ITEM.item_cd',  config('dwo.ORDER_DTL') . '.item_cd')
			->where('web_order_num' ,$orderNum)
			->selectRaw(config('dwo.ORDER_DTL') . ".* ,M_ITEM.item_name_kanji")
			->orderBy('order_line_num')
			->get();

        return $detailViewList;
    }


 /*************************************************************
 * 更新
 *
 * 利用ファイル
 *   admin/order/orderListDetail.php store()
 *   admin/order/orderList2Detail.php store()
 ***************************************************************/
    public function update($userId ,$param) {

		$order_num = $param['orderNum'];

		$orderLineNum = $param['orderLineNum'];
		$custOrderNum = (isset($param['custOrderNum'])) ? $param['custOrderNum'] : null;
		$itemCd       = (isset($param['itemCd']))       ? $param['itemCd']       : null;
		$itemPrice    = (isset($param['itemPrice']))    ? $param['itemPrice']    : null;
		$itemVol      = (isset($param['itemVol']))      ? $param['itemVol']      : null;
		$itemAmt      = (isset($param['itemAmt']))      ? $param['itemAmt']      : null;
		$itemTaxRate  = (isset($param['itemTaxRate']))  ? $param['itemTaxRate']  : null;
		$itemTax      = (isset($param['itemTax']))      ? $param['itemTax']      : null;
		$itemDel      = (isset($param['itemDel']))      ? $param['itemDel']      : null;
		$itemTaxRateMixed  = (isset($param['itemTaxRateMixed']))  ? $param['itemTaxRateMixed']  : null;

		$recCount = count($orderLineNum);

		for ($i = 0; $i < $recCount; $i++) {

			$del_flag = $this->util->checkbox($itemDel ,$orderLineNum[$i]);
				
			if ($del_flag == '1') {
				$detail = ORDER_DTL::where('web_order_num' ,$order_num)
					->where('order_line_num' ,$orderLineNum[$i])
					->forceDelete();

			} else {
				$detail = ORDER_DTL::where('web_order_num' ,$order_num)
					->where('order_line_num' ,$orderLineNum[$i])
					->update(array(
						'cust_order_num' => $custOrderNum[$i],
						'item_cd'        => $itemCd[$i],
						'item_price'     => $itemPrice[$i],
						'item_vol'       => $itemVol[$i],
						'item_amt'       => $itemAmt[$i],
						'tax_rate'       => $itemTaxRate[$i],
//						'tax_rate_mixed' => $itemTaxRateMixed[$i],
						'tax'            => $itemTax[$i]
					));

			}
		}

		return;
    }

}
