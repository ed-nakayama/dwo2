<?php

namespace App\Http\Controllers\Classes;

use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Classes\Util;
use App\Models\ProductStatusMt;

class StatusDAO {

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
 *   admin/product/ProductStatus.php  find()
 ***************************************************************/
    public function find() {

		$dataList = ProductStatusMt::orderBy('prod_status_id')
			->get();

        return $dataList;
    }


 /*************************************************************
 * 更新
 *
 * 利用ファイル
 *   admin/product/ProductStatus.php  store()
 ***************************************************************/
    public function update($userId ,$param) {

		$codeList = $param['codeList'];
		$nameList = (isset($param['nameList'])) ? $param['nameList'] : null;
		$delList  = (isset($param['delList']))  ? $param['delList']  : null;

		$recCount = count($codeList);

		for ($i = 0; $i < $recCount; $i++) {
			$status = ProductStatusMt::where('prod_status_id' ,$codeList[$i])->first();

			if (isset($status)) {
				$status_name = $nameList[$status->prod_status_id];
				$status_del = $this->util->checkbox($delList  ,$status->prod_status_id);

				if ( $status->prod_status_name   != $status_name
					|| $status->prod_status_del != $status_del)
				{
					$status->prod_status_modified_id = $userId;
				}

				$status->prod_status_name = $status_name;
				$status->prod_status_del = $status_del;

				$status->save();
			}
		}

        return;
    }


}
