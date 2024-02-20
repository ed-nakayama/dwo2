<?php

namespace App\Http\Controllers\Classes;

use App\Models\AgentView;

class ProductlistViewDAO {

	private $orderinfo = null;

	public $sales_stop = '';
	public $visible_ori = false;
	public $visible_pap_std = false;
	public $visible_pap_gld = false;
	public $visible_ybp = false;
	public $visible_ybp_pap = false;

	public $product_code; // array
	public $item_name_kanji;
	public $product_category_big_code;
	public $product_category_middle_code;

	public $util;

	/**
	 * 不要？
	 */

	function __construct($orderinfo = null, $agentView = null) {
		$this->product_code = array();
		$this->orderinfo = $orderinfo;
		$this->agentView = $agentView;
		if ($orderinfo != "") {
			$this->setVisibleUser();
		}
		$this->util= new Util();
	}

 /*************************************************************
 * 表示用ユニーク商品検索
 *
 * 利用ファイル
 *   weborder/ItemSelect.php detail()
 ***************************************************************/
    public function findUniqList() {

		$sql  = "SELECT DISTINCT";
		$sql .= "       P.CUST_GROUP2 ";
		$sql .= "      ,P.PRODUCT_CODE ";
		$sql .= "      ,I.PRICE_PRODUCT_SUP_CODE ";
		$sql .= "      ,P.ITEM_CLASS_LARGE ";
		$sql .= "      ,P.ITEM_CLASS_MEDIUM ";
		$sql .= "      ,P.ITEM_CLASS_SMALL ";
		$sql .= "      ,P.ITEM_NAME_KANJI ";
		$sql .= "      ,P.SALES_PRICE ";
		$sql .= "      ,P.SAMPLE_PRICE ";
		$sql .= "      ,P.PRODUCT_STATUS_ID ";
		$sql .= "      ,TO_CHAR(P.PRODUCT_SHIP_DATE, 'YYYY-MM-DD') AS PRODUCT_SHIP_DATE ";
		$sql .= "      ,P.PRODUCT_VISIBLE_PAP_STD ";
		$sql .= "      ,P.PRODUCT_VISIBLE_PAP_GLD ";
		$sql .= "      ,P.PRODUCT_VISIBLE_YBP ";
		$sql .= "      ,P.PRODUCT_VISIBLE_YBP_PAP ";
		$sql .= "      ,I.PRICE_PRODUCT_SUP_SHORT ";
		$sql .= "      ,I.SAMPLE_PRICE AS INVOICE_SAMPLE_PRICE";
		$sql .= "      ,I.PRICE_INVOICE_PRICE ";
		$sql .= "      ,I.PRICE_INVOICE_PRICE_SUP ";
		$sql .= "      ,I.PRICE_PRODUCT_CODE ";
		$sql .= "      ,I.SUP_ITEM_NAME ";
		$sql .= "      ,I.SUPPORT_BASE_PRICE ";
		$sql .= "  from PRODUCTLIST_VIEW P";
		$sql .= "     ,(SELECT IP.PRICE_PRODUCT_CODE";
		$sql .= "             ,IP.PRICE_PRODUCT_SUP_CODE";
		$sql .= "             ,IP.PRICE_PRODUCT_SUP_SHORT";
		$sql .= "             ,IP.SAMPLE_PRICE";
		$sql .= "             ,IP.PRICE_CLASS_LARGE";
		$sql .= "             ,IP.PRICE_CLASS_MEDIUM";
		$sql .= "             ,IP.PRICE_CLASS_SMALL";
		$sql .= "             ,IP.PRICE_INVOICE_PRICE";
		$sql .= "             ,IP.PRICE_INVOICE_PRICE_SUP";
		$sql .= "             ,MI.ITEM_NAME_KANJI AS SUP_ITEM_NAME";
		$sql .= "             ,MI.SALES_PRICE AS SUPPORT_BASE_PRICE";
		$sql .= "         FROM DWO_INVOICE_PRICE IP";
		$sql .= "             ,M_ITEM MI";
		$sql .= "         WHERE IP.PRICE_CLASS_LARGE = "  . $this->agentView->cust_class_large;
		$sql .= "           AND IP.PRICE_CLASS_MEDIUM = " . $this->agentView->cust_class_medium;
		$sql .= "           AND IP.PRICE_CLASS_SMALL = "  . $this->agentView->cust_class_small;
		

		// 弥生１３対応 2012/11/11
		$memberType = session()->get("memberType");
		if ($this->orderinfo->pap_order == TRUE && $memberType == 'PAP') {
			$sql .= "           AND IP.PRICE_PRODUCT_SUP_CODE is NULL";
		}
		$sql .= "           AND IP.PRICE_PRODUCT_SUP_CODE = MI.ITEM_CD(+)";
		$sql .= "           AND (MI.DEL_TYPE = '0' OR MI.DEL_TYPE IS NULL)";
		$sql .= "           AND " . $this->getVisibleInvoicePriceExpr();
		$sql .= "           AND IP.PRICE_DEL = 0";
		$sql .= "  ) I";


		$where = array();
		$where[] = "P.CUST_GROUP2 = " . $this->agentView->cust_group2;

		if ($this->sales_stop != '') {
			if ($this->sales_stop == TRUE) {
				// $where[] = " PRODUCT_SALES_STOP_DATE <= sysdate "; <-- 販売終了は製品が販売終了という前提であってここの条件にはならない
				$where[] = " P.ITEM_CLASS_LARGE = '03' "; // サプライのみ
			} else {
				$where[] = " (P.PRODUCT_SALES_STOP_DATE is null or P.PRODUCT_SALES_STOP_DATE > sysdate) ";
			}
		}

		$tmp = '';
		if (isset($this->product_code)) {
			for ($i=0; $i<count($this->product_code); $i++) {
				if ($this->product_code[$i] != '') {
					$tmp .= "'{$this->product_code[$i]}',";
				}
			}
		}
	
		if ($tmp != '') {
			$tmp = substr($tmp, 0, strlen($tmp)-1);
			$where[] = "P.PRODUCT_CODE IN ({$tmp}) ";
		}

		if (!empty($this->item_name_kanji) ) {
			$where[] = "P.ITEM_NAME_KANJI LIKE '%{$this->item_name_kanji}%'";
		}

		if ($this->product_category_big_code != '') {
			$where[] = "P.PRODUCT_CATEGORY_BIG_CODE = {$this->product_category_big_code}";
		}

		if ($this->product_category_middle_code != '') {
			$where[] = "P.PRODUCT_CATEGORY_MIDDLE_CODE = {$this->product_category_middle_code}";
		}

		// 可視属性
		if ($this->visible_ori) {
			$where[] = " (P.PRODUCT_VISIBLE_PAP_STD = 1 OR P.PRODUCT_VISIBLE_PAP_GLD = 1) ";
		}
		if ($this->visible_pap_std) {
			$where[] = " P.PRODUCT_VISIBLE_PAP_STD = 1 ";
		}
		if ($this->visible_pap_gld) {
			$where[] = " P.PRODUCT_VISIBLE_PAP_GLD = 1 ";
		}
		if ($this->visible_ybp) {
			$where[] = " P.PRODUCT_VISIBLE_YBP = 1 ";
		}
		if ($this->visible_ybp_pap) {
			$where[] = " P.PRODUCT_VISIBLE_YBP_PAP = 1 ";
		}

		$where[] = "P.PRODUCT_CODE = I.PRICE_PRODUCT_CODE(+)";

		$tmp = '';
		for ($i=0; $i<count($where); $i++) {
			if ($i==0)
				$tmp = " WHERE " . $where[$i];
			else
				$tmp = $tmp . " AND " . $where[$i];
		}

		// where句連結
        $sql .= $tmp;

		// ソート条件
        $sql .= " ORDER BY P.ITEM_CLASS_LARGE, P.PRODUCT_CODE, I.PRICE_PRODUCT_SUP_CODE \n";

		$prodList = \DB::select($sql);

        $list = new ArrayList();

		foreach ($prodList as $pr) {
			$productlistview = new ProductlistView($this->orderinfo, $this->agentView);
			$productlistview->setAll($pr);
			$list->add($productlistview);
		}

        return $list;

    }

    /************************************************
     * 取引先形態による商品可視属性を設定します。
     ************************************************/
    private function setVisibleUser() {

    	if ($this->orderinfo->pap_order) {

    		if ($this->orderinfo->cust_kbn == AgentView::CUST_CLASS_OR) {
    			$this->visible_ori = true;
    		} else if ($this->orderinfo->cust_kbn == AgentView::CUST_CLASS_PAP_GOLD) {
    			$this->visible_pap_gld = true;
    		} else if ($this->orderinfo->cust_kbn == AgentView::CUST_CLASS_PAP_MEMBER) {
    			$this->visible_pap_std = true;
    		} else {
    			$this->visible_ybp_pap = true;
    		}

    	} else {
    		// YBP or 一般製品
    		$this->visible_ybp = true;
    	}

    }

    /***************************************************************
     * 取引先グループの仕切可視SQL条件式を取得します。
     * @param array product PRODUCT_LISTビューデータの連想配列
     * @return string SQL条件式
     ***************************************************************/
    private function getVisibleInvoicePriceExpr() {

		$code = $this->agentView->cust_group2;

		/* 2010-10-19 アップグレード対応 by nakayama */ 
		return "(IP.PRICE_AGENT_LEVEL_1 = '$code' or IP.PRICE_AGENT_LEVEL_2 = '$code' or IP.PRICE_AGENT_LEVEL_3 = '$code' or IP.PRICE_AGENT_LEVEL_4 = '$code' or IP.PRICE_AGENT_LEVEL_5 = '$code' or IP.PRICE_AGENT_LEVEL_6 = '$code' or IP.PRICE_AGENT_LEVEL_7 = '$code' or IP.PRICE_AGENT_LEVEL_8 = '$code' )";
		
    }


 /*************************************************************
 * 商品検索 T.N 2010-11-13
 *
 * 利用ファイル
 *   admin/order/OrderList2.php isearchProd()
 ***************************************************************/
    public function searchProdList($custNum ,$itemCode, $agentView) {

		$sql  = " SELECT DISTINCT";
		$sql .= "        P.PRODUCT_CODE ";
		$sql .= "       ,P.ITEM_CLASS_LARGE ";
		$sql .= "       ,P.ITEM_CLASS_MEDIUM ";
		$sql .= "       ,P.ITEM_CLASS_SMALL ";
		$sql .= "       ,P.ITEM_NAME_KANJI ";
		$sql .= "       ,P.SALES_PRICE ";
		$sql .= "       ,P.PRODUCT_STATUS_ID ";
		$sql .= "       ,TO_CHAR(P.PRODUCT_SHIP_DATE, 'YYYY-MM-DD') AS PRODUCT_SHIP_DATE ";
		$sql .= "       ,I.PRICE_INVOICE_PRICE ";
		$sql .= "       ,I.PRICE_PRODUCT_CODE ";
		$sql .= "  from (SELECT IP.PRICE_PRODUCT_CODE";
		$sql .= "             ,IP.PRICE_CLASS_LARGE";
		$sql .= "             ,IP.PRICE_CLASS_MEDIUM";
		$sql .= "             ,IP.PRICE_CLASS_SMALL";
		$sql .= "             ,IP.PRICE_INVOICE_PRICE";
		$sql .= "         FROM DWO_INVOICE_PRICE IP";
		$sql .= "         WHERE IP.PRICE_PRODUCT_CODE = '" . $itemCode                     . "'";
		$sql .= "           AND IP.PRICE_CLASS_LARGE = '"  . $agentView->cust_class_large  . "'";
		$sql .= "           AND IP.PRICE_CLASS_MEDIUM = '" . $agentView->cust_class_medium . "'";
		$sql .= "           AND IP.PRICE_CLASS_SMALL = '"  . $agentView->cust_class_small  . "'";
		$sql .= "           AND (IP.PRICE_PRODUCT_SUP_CODE = '' OR PRICE_PRODUCT_SUP_CODE is NULL)";
		$sql .= "           AND IP.PRICE_DEL = 0"; 
		$sql .= "      ) I";
		$sql .= "  ,PRODUCTLIST_VIEW P";

		$sql .= " where P.PRODUCT_CODE = '" . $itemCode . "'";
		$sql .= "   and P.CUST_GROUP2 = '" .  $agentView->cust_group2 . "'";
		$sql .= "   and P.PRODUCT_CODE = I.PRICE_PRODUCT_CODE(+)";


		$prodList = \DB::select($sql);

		$cnt = count($prodList);

		for ($i = 0; $i < $cnt; $i++) {

			$prodList[$i]->cust_name = $agentView->name1 . $agentView->name2;

	 		if (isset($prodList[$i]->price_product_code) ) {  // オリジナルにバグ？

	 			$ipr = new InvoicePriceRate($agentView, $prodList[$i]);
	 		
				$prodList[$i]->discount_rate = $ipr->getRate();
				$prodList[$i]->price_invoice_price = bcmul( strval($prodList[$i]->sales_price), bcdiv( strval($ipr->getRate()), '100', 3), 0);
			} else {
				$prodList[$i]->discount_rate = null;
			}
		}

        return $prodList;
    }


}
