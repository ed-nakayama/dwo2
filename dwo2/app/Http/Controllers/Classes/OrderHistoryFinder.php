<?php

namespace App\Http\Controllers\Classes;

use Illuminate\Support\Facades\Hash;

use App\Models\AgentView;

class OrderHistoryFinder {

	public $util;
	public $total_vol;
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
 * admin/order/OrderSearchHistory.php index() search()
 ***************************************************************/
	public function find($param) {

		$ORDER_HDR = config('dwo.ORDER_HDR');
		$ORDER_DTL = config('dwo.ORDER_DTL');

		$dataList = AgentView::join("{$ORDER_HDR}", 'Agent_View.cust_num', "{$ORDER_HDR}.cust_num")
			->join("{$ORDER_DTL}", "{$ORDER_DTL}.web_order_num", "{$ORDER_HDR}.web_order_num")
			->where("{$ORDER_HDR}.origin_type", '1')
			->orderBy("{$ORDER_HDR}.web_order_num")
			->orderBy("{$ORDER_DTL}.order_line_num")
			->selectRaw("{$ORDER_HDR}.web_order_num, {$ORDER_HDR}.order_date, {$ORDER_HDR}.state_type, {$ORDER_HDR}.cust_order_num, {$ORDER_HDR}.cust_del_type,{$ORDER_HDR}.operator_del_type, {$ORDER_HDR}.dwo_ship_status_update as batch_update," .
				 " Agent_View.cust_num, Agent_View.name1, Agent_View.name2, Agent_View.cust_class_medium," .
				 " {$ORDER_DTL}.item_cd, {$ORDER_DTL}.item_vol");


		if (isset($param['orderNum'])) {
			$dataList = $dataList->where("{$ORDER_HDR}.web_order_num", $param['orderNum']);
		}

		if (isset($param['orderStartDate'])) {
			$dataList = $dataList->where("{$ORDER_HDR}.order_date", '>=',  $param['orderStartDate']);
		}

		if (isset($param['orderEndDate'])) {
			$dataList = $dataList->where("{$ORDER_HDR}.order_date", '<=',  $param['orderEndDate']);
		}

		if (isset($param['statusId'])) {
			$dataList = $dataList->whereIn("{$ORDER_HDR}.state_type", $param['statusId']);
		}

		if (isset($param['custNum'])) {
			$dataList = $dataList->where('Agent_View.cust_num', $param['custNum']);
		}

		if (isset($param['custName'])) {
			$custName = $param['custName'];
			
			$dataList = $dataList->where(function($query) use ($custName) {
	    		$query->where('Agent_View.name1' , 'like' ,"%{$custName}%")
					->orWhere('Agent_View.name2' , 'like' ,"%{$custName}%");
			});
		}

		if (isset($param['itemCode'])) {
			$dataList = $dataList->where("{$ORDER_DTL}.item_cd", 'like', "%{$param['itemCode']}%");
		}

		if (isset($param['custOrderNum'])) {
			$dataList = $dataList->where("{$ORDER_HDR}.cust_order_num", $param['custOrderNum']);
		}

		if (isset($param['custClass'])) {
			if ($param['custClass'] == '1') {
				$dataList = $dataList->where('Agent_View.cust_class_medium', '01');
			} else if ($param['custClass'] == '2') {
				$dataList = $dataList->where('Agent_View.cust_class_medium', '02');
			}
		}

		if (isset($param['custDel'])) {
			if ($param['custDel'] == '1') {
				$dataList = $dataList->where("{$ORDER_HDR}.cust_del_type", '0');
			} else if ($param['custDel'] == '2') {
				$dataList = $dataList->where("{$ORDER_HDR}.cust_del_type", '1');
			}
		}

		if (isset($param['operatorDel'])) {
			if ($param['operatorDel'] == '1') {
				$dataList = $dataList->where("{$ORDER_HDR}.operator_del_type", '0');
			} else if ($param['operatorDel'] == '2') {
				$dataList = $dataList->where("{$ORDER_HDR}.operator_del_type", '1');
			}
		}

		$pagination = $dataList->paginate(20);


		$this->total_vol = $dataList->sum("{$ORDER_DTL}.item_vol");

		return $pagination;
		
	}


	
	private function prepareStatusList() {
		
		$orderStatusDAO = new OrderStatusDAO();
		$prList = $orderStatusDAO->findList();
		
		for ($i = 0; $i < $prList->size(); $i++) {
			$data = $prList->get($i);
			$this->statusList[$i]['id'] = $data->id;
			$this->statusList[$i]['name'] = $data->name;	
		}
		
	}

	
	private function getStatus($statusId) {
		
		foreach ($this->statusList as $val) {
			
			if ($val['id'] === $statusId) {
				return $val['name'];
			}
			
		}
		
		return "";
		
	}

}
