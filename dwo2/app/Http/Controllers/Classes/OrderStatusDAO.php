<?php

namespace App\Http\Controllers\Classes;

use App\Models\OrderStatusMt;

class OrderStatusDAO {

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
 *   admin/order/OrderStatus.php  store()
 ***************************************************************/
    public function update($userId, $param) {

		$idList   = $param['idList'];
		$nameList = (isset($param['nameList'])) ? $param['nameList'] : null;
	  	$sortList = (isset($param['sortList'])) ? $param['sortList'] : null;
		$delList  = (isset($param['delList']))  ? $param['delList']  : null;

		$recCount = count($idList);

		for ($i = 0; $i < $recCount; $i++) {
			$st = OrderStatusMt::where('order_status_id' ,$idList[$i])->first();

			if (isset($st)) {
				$status_name = $nameList[$st->order_status_id];
				$sort_num    = $sortList[$st->order_status_id];
				$status_del  = $this->util->checkbox($delList  ,$st->order_status_id);

				if ( $st->order_status_name  != $status_name
					|| $st->order_sort_num   !=  $sort_num
					|| $st->order_status_del != $status_del)
				{
					$st->order_status_modified_id = $userId;
				}

				$st->order_status_name = $status_name;
				$st->order_sort_num    =  $sort_num;
				$st->order_status_del  = $status_del;


				$st->save();
			}
		}

        return;

    }

}
?>
