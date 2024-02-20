<?php

namespace App\Http\Controllers\Classes;

use App\Models\Admin;

class OperatorDAO {

	public $util;
/*
 * コンストラクタ
 */
	function __construct() {
		// 初期化
		$this->util = new Util();
	}


 /*************************************************************
 * 更新
 *
 * 利用ファイル
 *   Admin/Operator/OperatorDetail.php store()
 ***************************************************************/
    public function update($userId, $param) {

		$codeList      = (isset($param['codeList']))      ? $param['codeList']      : null;
		$idList        = (isset($param['idList']))        ? $param['idList']        : null;
		$privList      = (isset($param['privList']))      ? $param['privList']      : null;
		$nameList      = (isset($param['nameList']))      ? $param['nameList']      : null;
		$nameRomanList = (isset($param['nameRomanList'])) ? $param['nameRomanList'] : null;
	  	$mailList      = (isset($param['mailList']))      ? $param['mailList']      : null;
	  	$telList       = (isset($param['telList']))       ? $param['telList']       : null;
	  	$delList       = (isset($param['delList']))       ? $param['delList']       : null;

		$recCount = count($codeList);

		for ($i = 0; $i < $recCount; $i++) {
			$admin = Admin::find($codeList[$i]);

			if (isset($admin)) {
				$operator_id         = $idList[$admin->operator_code];
				$operator_priv       = $this->util->checkBox($privList  ,$admin->operator_code);
				$operator_name       = $nameList[$admin->operator_code];
				$operator_name_roman = $nameRomanList[$admin->operator_code];

				$operator_tel  = $telList[$admin->operator_code];
				$email         = $mailList[$admin->operator_code];
				$operator_del  = $this->util->checkBox($delList  ,$admin->operator_code);

				if ( $admin->operator_id           != $operator_id
					|| $admin->operator_priv       != $operator_priv
					|| $admin->operator_name       != $operator_name
					|| $admin->operator_name_roman != $operator_name_roman
					|| $admin->operator_tel        != $operator_tel
					|| $admin->email               != $email
					|| $admin->operator_del        != $operator_del)
				{
					$admin->operator_modified_id  = $userId;
				}

				$admin->operator_id         = $operator_id;
				$admin->operator_priv       = $operator_priv;
				$admin->operator_name       = $operator_name;
				$admin->operator_name_roman = $operator_name_roman;
				$admin->operator_tel        = $operator_tel;
				$admin->email               = $email;
				$admin->operator_del        = $operator_del;

				$admin->save();
			}
		}

        return;
    }


}
