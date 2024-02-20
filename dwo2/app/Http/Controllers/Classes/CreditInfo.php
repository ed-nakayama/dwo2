<?php

namespace App\Http\Controllers\Classes;

/**
 * 与信情報クラス
 */
class CreditInfo {

	var $credit_limit      ; // 与信限度額 (利用可能限度額)
	var $credit_balance    ; // 与信残
	var $now_temp_order_sum; // 受注未処理分
	var $basket_sum        ; // 現在のバスケット合計

	var $yuyo              ; // 取引猶予額(内部算出用)
	var $zan               ; // 取引残(内部算出用)

/*
	function toArray() {
		$datList['credit_limit'      ] = $this->credit_limit      ;
		$datList['credit_balance'    ] = $this->credit_balance    ;
		$datList['now_temp_order_sum'] = $this->now_temp_order_sum;
		$datList['basket_sum'        ] = $this->basket_sum        ;

		$datList['yuyo'              ] = $this->yuyo              ;
		$datList['zan'               ] = $this->zan               ;

		return $datList;
	}
*/

}
