<?php

namespace App\Http\Controllers\Classes;

use App\Models\ORDER_DTL;

class WebOrderDetailDAO {

 /*************************************************************
 * 条件検索 商品名付き
 *
 * 利用ファイル
 *   admin/order/OrderList2Detail.php store()
 *   weborder/topTopHistory.php mail_do()
 *   classes/AcceptanceManager.php demandMail()
 *   classes/UpgradeAcceptanceManager.php demandMail()
 *   classes/OrderPrintview.php viewer()
 *   classes/OrderUpgradeprint.php viewer()
 ***************************************************************/
    public function findNamePlus($orderNum) {

		$ORDER_DTL = config('dwo.ORDER_DTL');

		$list = ORDER_DTL::leftjoin('M_ITEM', "$ORDER_DTL.item_cd", 'M_ITEM.item_cd')
			->where('web_order_num' , $orderNum)
			->selectRaw("$ORDER_DTL.*, M_ITEM.item_name_kanji ")
			->orderBy('order_line_num')
			->get();

        return $list;
    }


 /*************************************************************
 * 条件検索 商品名付き
 *
 * 利用ファイル
 *   weborder/top/TopHistory2detail.php index()
 ***************************************************************/
    public function findNamePlus2($orderNum) {

		$ORDER_DTL = config('dwo.ORDER_DTL');

        $sql = "SELECT D.*, I.ITEM_NAME_KANJI, I.ITEM_CLASS_LARGE ,C.RETI_VOL ,C.RETI_PRICE ";

        $sql .= "  FROM ";
        $sql .= "       (select OH.WEB_ORDER_NUM ,OH.ORDER_NUM ,OD.ORDER_LINE_NUM ,RD.RETI_VOL ,RETI_PRICE ";
        $sql .= "        from T_RETI_DTL RD, T_CC_ORDER_DTL OD ,T_CC_ORDER_HDR OH ";
        $sql .= "        where OH.WEB_OPERATOR_CD = 'DWO' ";
        $sql .= "          and OH.ORDER_NUM = OD.ORDER_NUM ";
        $sql .= "          and OD.ORDER_NUM = RD.ORDER_NUM ";
        $sql .= "          and OD.ORDER_LINE_NUM = RD.ORDER_LINE_NUM ";
        $sql .= "       ) C ";

        $sql .= "       ,M_ITEM I ," . $ORDER_DTL . " D ";
        $sql .= " WHERE D.WEB_ORDER_NUM = " . $orderNum;
        $sql .= "   AND D.ITEM_CD = I.ITEM_CD(+) ";
        $sql .= "   AND D.WEB_ORDER_NUM = C.WEB_ORDER_NUM(+) ";
        $sql .= "   AND D.ORDER_LINE_NUM = C.ORDER_LINE_NUM(+) ";
        $sql .= " ORDER BY D.ORDER_LINE_NUM";

		$list = \DB::select($sql);

        return $list;

    }


 /*************************************************************
 * 新規登録
 *
 * 利用ファイル
 ***************************************************************/
    public function insert($list) {

		$detail = new ORDER_DTL();

		$detail->web_order_num  = $list->web_order_num;
		$detail->order_line_num = $list->order_line_num;
		$detail->item_cd        = $list->item_cd;
		$detail->item_vol       = $list->item_vol;
		$detail->item_price     = $list->item_price;
		$detail->item_amt       = $list->item_amt;
		$detail->remarks        = $list->remarks;
		$detail->cust_order_num = $list->custOrderNum;
		$detail->tax_rate       = $list->taxRate;		// 2013/10/29
		$detail->tax            = $list->tax;			// 2013/10/29
		$detail->tax_rate_mixed = $list->taxRateMixed;	// 2015/12/09

		$detail->save();
		
        return;

    }
}
