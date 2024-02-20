<?php

namespace App\Http\Controllers\Classes;

/**
 * 与信情報取得プロシージャデータアクセスクラス
 */
class CalCreditLimitDAO
{
	public $o_credit_limit;
	public $o_max_limit;
	public $o_error_status;
	public $o_error_message;

 /*************************************************************
 * 引数に指定された顧客の与信情報取得を取得します。
 * @param string custNum 顧客番号
 * @return CalCreditLimit 与信情報取得結果
 *
 * 利用ファイル
 *   class/CreditInfoManager.php  GetCreditDataByCustCode()
 ***************************************************************/
	public function getCreditLimit($custNum) {

		$pdo = \DB::getPdo();

		$o_limit = 0;
		$o_status= 'aaa';
		$o_message = 'aaa';
		$o_max_limit = 0;

		$stmt = $pdo->prepare("begin PRC_CAL_CREDIT_LIMIT(:p1, :p2, :o_limit, :o_status, :o_message, :o_max_limit); end;");
		$tmp = 0;

		$stmt->bindParam(':p1'         , $custNum,     \PDO::PARAM_INT, 10);
		$stmt->bindParam(':p2'         , $tmp,         \PDO::PARAM_INT, 10);
		$stmt->bindParam(':o_limit'    , $o_limit,     \PDO::PARAM_INT, 10);
		$stmt->bindParam(':o_status'   , $o_status,    \PDO::PARAM_STR, 255);
		$stmt->bindParam(':o_message'  , $o_message,   \PDO::PARAM_STR, 255);
		$stmt->bindParam(':o_max_limit', $o_max_limit, \PDO::PARAM_INT, 10);

		$stmt->execute();

		$this->o_credit_limit  = $o_limit;
		$this->o_max_limit     = $o_max_limit;
		$this->o_error_status  = $o_status;
		$this->o_error_message = $o_message;

    }


}
?>
