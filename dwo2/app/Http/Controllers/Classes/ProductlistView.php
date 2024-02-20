<?php

namespace App\Http\Controllers\Classes;

class ProductlistView {

	private $orderinfo = null;
	private $custGroup2; // 顧客分類２（取り扱い製品）
	private $product_code                ; // 商品コード
	private $product_category_big_code   ; // 商品大分類コード
	private $product_category_middle_code; // 商品中分類コード
	private $price_product_sup_code      ; // 保守商品コード
	public $item_class_large            ; // 提供商品 1:製品 2:サプライ 3:サポート
	public $item_class_medium           ; //
	public $item_class_small            ; //
	private $item_name_kanji             ; // 商品名漢字
	private $sales_price                 ; // 販売価格
	private $sample_price                ; // DWO参考価格
	private $product_sales_stop_date     ; // 販売終了日
	private $product_status_id           ; // 在庫状況(ステータス)
	private $product_ship_date           ; // 出荷可能日
	private $price_product_sup_short     ; // 保守商品短縮表示
	private $invoice_sample_price;         // 登録済み出荷注文時のDWO参考価格
	private $price_invoice_price     ; // -商品仕切り価格
	private $price_invoice_price_sup ; // -サポート仕切り価格
	private $sup_item_name               ; // 保守商品名称
	private $support_base_price          ; // 保守商品定価

	/**
	 *
	 */
	 public function __construct($orderinfo, $agentAry) {
	 	$this->orderinfo = $orderinfo;
	 	$this->agentAry = $agentAry;
	 }

	 /**
	  * 取引先形態＆取引先別の提供価格(仕切価格)を取得します。
	  */
	 public function getUserPrice() {

	 	if ($this->getDwoUserItemPrice() !== '') {
	 		return $this->getDwoUserPrice();
	 	} else {
	 		$ipr = new InvoicePriceRate($this->agentAry, $this);
// 2017/05/16 mikami	 		return $this->sales_price * ($ipr->getRate() / 100);
	 		return bcmul(strval($this->sales_price), bcdiv(strval($ipr->getRate()), '100', 3), 0); 
	 	}

	 }

	 /**
	  * DWOで設定された取引先形態＆取引先別の提供価格(仕切価格)を取得します。
	  */
	 public function getDwoUserPrice() {
		return $this->getDwoUserItemPrice() + $this->getDwoUserSupportPrice();
	 }

	 /**
	  * DWOで設定された取引先形態＆取引先別の商品提供価格(仕切価格)を取得します。
	  * @return int 商品提供価格
	  */
	 public function getDwoUserItemPrice() {
		return $this->price_invoice_price;
	 }

	 /**
	  * DWOで設定された取引先形態＆取引先別の商品保守価格を取得します。
	  * @return int 商品保守価格
	  */
	 public function getDwoUserSupportPrice() {
		return $this->price_invoice_price_sup;
	 }

	 /**
	  * 発送可能日を取得します。<br>
	  * 欠品と予約受付中以外は「通常サイクル」となります。
	  * @return string 発送可能日
	  */
	 public function getShipDate() {

	 	if (($this->product_status_id != "3") && ($this->product_status_id != "8")) {
	 		return "通常サイクル";
	 	}

	 	return $this->product_ship_date;

	 }


	/**
	 * このインスタンスの配列表現を取得します。
	 * @return array このインスタンスの配列表現
	 */
	public function toArray() {

		return array(
					'custGroup2' => $this->custGroup2,
					'product_code' => $this->product_code,
					'product_category_big_code' => $this->product_category_big_code,
					'product_category_middle_code' => $this->product_category_middle_code,
					'price_product_sup_code' => $this->price_product_sup_code,
					'item_class_large' => $this->item_class_large,
					'item_class_medium' => $this->item_class_medium,
					'item_class_small' => $this->item_class_small,
					'item_name_kanji' => $this->item_name_kanji,
					//'sales_price' => $this->getSalesPrice(),
					'sales_price' => $this->getSamplePrice(),
					//'sample_price' => $this->getSamplePrice(),
					'product_sales_stop_date' => $this->product_sales_stop_date,
					'product_status_id' => $this->product_status_id,
					'product_ship_date' => $this->getShipDate(),
					'price_product_sup_short' => $this->price_product_sup_short,
					'price_invoice_price' => $this->price_invoice_price,
					'price_invoice_price_sup' => $this->price_invoice_price_sup,
					'sup_item_name' => $this->sup_item_name,
					'support_base_price' => (($this->price_product_sup_code != "") ? $this->getSupportBasePrice() : ''),

					'view_invoce_price' => $this->getUserPrice(),
					'support_price' => (($this->price_product_sup_code != "") ? $this->getDwoUserSupportPrice() : ''),
					'prod_search_key' => $this->getProdSearchKey(),
//					'product_status_str' => $this->getStockStatus()
					);

	}

	private function getSalesPrice() {
	 	return 	$this->sales_price + $this->getSupportBasePrice();
	}

	private function getSupportBasePrice() {

		// 保守付商品の場合
	 	if ($this->price_product_sup_code != "") {

	 		if (!$this->support_base_price) {
	 			return $this->getDwoUserSupportPrice();
	 		} else {
	 			return $this->support_base_price;
	 		}

	 	}

	 	return 0;

	}
	
	/**
	  * 参考価格を取得します。
	  * PAPの登録済み出荷注文時はPAPに該当する仕切りのDWO参考価格を返します。
	  * ただし、仕切りのDWO参考価格が未登録（0円も未登録とみなす）の場合、該当する商品サブマスタ登録のDWO参考価格を返します。
	  * 通常製品注文時は、商品サブマスタ登録のDWO参考価格を返します。
	  * DWO参考価格がいずれも未設定の場合、またはサプライ製品、サポート製品（単体）の場合は従来通り、
	  * シェルパの商品マスタの定価（現仮想価格）を返します。
	  *
	  * @return int 参考価格
	  */
	private function getSamplePrice() {
		
		if ($this->item_class_large == 1) {
		
			if ($this->orderinfo->pap_order && $this->invoice_sample_price) {
				return $this->invoice_sample_price;
			}
			
			if ($this->sample_price) {
				return $this->sample_price;
			}
			
		}
		
		return $this->getSalesPrice();
		
	}

	private function getProdSearchKey() {
	 	// 後付のためデバッグ用
	 	return $this->prod_search_key = $this->product_code.'_'.$this->price_product_sup_code;
	}


/*********************************
* データセット
**********************************/
	function setAll($row) {

		$this->custgroup2                   = (isset($row->cust_group2))                  ? $row->cust_group2                  : "";
		$this->product_code                 = (isset($row->product_code))                 ? $row->product_code                 : "";
		$this->product_category_big_code    = (isset($row->product_category_big_code))    ? $row->product_category_big_code    : "";
		$this->product_category_middle_code = (isset($row->product_category_middle_code)) ? $row->product_category_middle_code : "";
		$this->price_product_sup_code       = (isset($row->price_product_sup_code))       ? $row->price_product_sup_code       : "";
		$this->item_class_large             = (isset($row->item_class_large))             ? $row->item_class_large             : "";
		$this->item_class_medium            = (isset($row->item_class_medium))            ? $row->item_class_medium            : "";
		$this->item_class_small             = (isset($row->item_class_small))             ? $row->item_class_small             : "";
		$this->item_name_kanji              = (isset($row->item_name_kanji))              ? $row->item_name_kanji              : "";
		$this->sales_price                  = (isset($row->sales_price))                  ? $row->sales_price                  : "";
		$this->sample_price                 = (isset($row->sample_price))                 ? $row->sample_price                 : "";
		$this->product_sales_stop_date      = (isset($row->product_sales_stop_date))      ? $row->product_sales_stop_date      : "";
		$this->product_status_id            = (isset($row->product_status_id))            ? $row->product_status_id            : "";
		$this->product_ship_date            = (isset($row->product_ship_date))            ? $row->product_ship_date            : "";
		$this->price_product_sup_short      = (isset($row->price_product_sup_short))      ? $row->price_product_sup_short      : "";
		$this->invoice_sample_price         = (isset($row->invoice_sample_price))         ? $row->invoice_sample_price         : "";
		$this->price_invoice_price          = (isset($row->price_invoice_price))          ? $row->price_invoice_price          : "";
		$this->price_invoice_price_sup      = (isset($row->price_invoice_price_sup))      ? $row->price_invoice_price_sup      : "";
		$this->sup_item_name                = (isset($row->sup_item_name))                ? $row->sup_item_name                : "";
		$this->support_base_price           = (isset($row->support_base_price))           ? $row->support_base_price           : "";

   }

}
