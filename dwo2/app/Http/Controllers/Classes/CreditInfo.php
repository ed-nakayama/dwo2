<?php

namespace App\Http\Controllers\Classes;

/**
 * —^Mî•ñƒNƒ‰ƒX
 */
class CreditInfo {

	var $credit_limit      ; // —^MŒÀ“xŠz (—˜—p‰Â”\ŒÀ“xŠz)
	var $credit_balance    ; // —^Mc
	var $now_temp_order_sum; // ó’–¢ˆ—•ª
	var $basket_sum        ; // Œ»İ‚ÌƒoƒXƒPƒbƒg‡Œv

	var $yuyo              ; // æˆø—P—\Šz(“à•”Zo—p)
	var $zan               ; // æˆøc(“à•”Zo—p)

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
