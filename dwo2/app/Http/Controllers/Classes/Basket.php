<?php

namespace App\Http\Controllers\Classes;

class Basket {

  var $product_code       ; // 商品コード
  var $item_name_kanji    ; // 商品名漢字
  var $base_name          ; // 商品名漢字。保守付きなどを付加する前の状態
  var $count              ; // 数量
  var $status             ; // ステータス
  var $sales_price        ; // 販売価格
  var $price_invoice_price; // 商品仕切り価格

  var $support_code       ; // サポートコード(ある場合のみ)
  var $support_price      ; // サポート価格(ある場合のみ) 最終的にprice_invoice_priceからマイナスするもの
  var $sup_item_name      ; // 保守商品名称
  var $support_base_price ; // サポート定価

  var $cust_order_num     ; // 顧客発注番号(貴社発注No. [20桁])
  var $item_class_large   ; // 01:製品, 03:サプライ, 02:サポート 承認メール有無に使用
  var $item_class_medium  ;
  var $item_ship_date;
  
  
  /**
   * この商品がNw製品かどうかを返す。
   * @return boolean Nw製品の場合はtrue、それ以外の場合はfalse
   */
  public function isNwProduct() {
  	
  	return (
  				($this->item_class_large == "01") &&
  				(($this->item_class_medium == "18") || ($this->item_class_medium == "19") || ($this->item_class_medium == "21"))
  			);
  			
  }
  
}
