<?php

namespace App\Http\Controllers\Classes;

/**
 * �^�M���N���X
 */
class CreditInfo {

	var $credit_limit      ; // �^�M���x�z (���p�\���x�z)
	var $credit_balance    ; // �^�M�c
	var $now_temp_order_sum; // �󒍖�������
	var $basket_sum        ; // ���݂̃o�X�P�b�g���v

	var $yuyo              ; // ����P�\�z(�����Z�o�p)
	var $zan               ; // ����c(�����Z�o�p)

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
