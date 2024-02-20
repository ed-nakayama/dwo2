<?php

namespace App\Http\Controllers\Classes;

use App\Models\AgentView;
use App\Models\ORDER_HDR;

class OrderHeaderViewDAO {

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
 *   admin/order/OrderList.php index() list() x 2
 ***************************************************************/
     public function find($param ,$desc = 'ASC') {

		$ORDER_HDR = config('dwo.ORDER_HDR');

		$query = ORDER_HDR::join('M_CC_CUST', 'M_CC_CUST.cust_num', "{$ORDER_HDR}.cust_num")
			->where('origin_type', '1');

        if (!empty($param['orderNum']) ) {
			$query = $query->where('web_order_num', $param['orderNum']);
        }

        if (!empty($param['orderStartDate'])) { // 開始日
			$query = $query->where('order_date', '>=',  $param['orderStartDate']);
        }

        if (!empty($param['orderEndDate'] )) { // 終了日
			$query = $query->where('order_date', '<=',  $param['orderEndDate']);
        }

        if (!empty($param['custNum']) ) { // 得意先コード
			$query = $query->where("{$ORDER_HDR}.cust_num", $param['custNum']);
        }

        if (!empty($param['custName'])) { // 得意先名
			$query = $query->where('search_name', 'like', '%' . $param['custName'] . '%' );
        }

        if (!empty($param['custNameKana'])) { // 得意先名カナ
			$query = $query->where('search_name_kana', 'like', '%' . $param['custNameKana'] . '%' );
        }

        if (!empty($param['custTel']) ) { // 得意先電話番号
			$query = $query->where('search_tel', 'like', '%' . $param['custTel'] . '%' );
        }

        if (isset($param['deliveryType'])) { // 届け先名
			$query = $query->where('direct_delivery_type', $param['deliveryType'] );
        }

        if (!empty($param['deliveryName'])) { // 届け先名
			$query = $query->where('dest_name1', 'like', '%' . $param['deliveryName'] . '%' );
        }

        if (!empty($param['nameOfCharge'])) { // 注文担当者
			$query = $query->where('dwo_order_person_name', 'like', '%' . $param['nameOfCharge'] . '%' );
        }

        if (isset($param['statusId']) ) { // ステータス
			$query = $query->where('state_type', $param['statusId']);
        }

        if (isset($param['inputType']) ) { // 取込完了
			$query = $query->where('input_type', $param['inputType']);
        }

        if (!empty($param['custDel'])) {
	        if ($param['custDel'] == "1") { // ユーザ削除/
				$query = $query->where('cust_del_type', '0');
	        } else if ($param['custDel'] === "2") {
				$query = $query->where('cust_del_type', '1');
			}
        }

        if (!empty($param['operatorDel'])) {
        	if ($param['operatorDel'] == "1") { // オペレータ削除
				$query = $query->where('operator_del_type', '0');
        	} else if ($param['operatorDel'] == "2") {
				$query = $query->where('operator_del_type', '1');
			}
        }

        if (!empty($param['inputStartDate']) ) { // 取込日時　開始日
			$query = $query->where('input_timestamp', '>=', substr($param['inputStartDate'],0,4) . '-' . substr($param['inputStartDate'],4,2) . substr($param['inputStartDate'],6,2) . ' 00:00:00' );
        }

        if (!empty($param['inputEndDate']) ) { // 取込日時　終了日
			$query = $query->where('input_timestamp', '<=', substr($param['inputEndDate'],0,4) . '-' . substr($param['inputEndDate'],4,2) . substr($param['inputEndDate'],6,2) . ' 23:59:59' );
        }

		if ($desc == 'ASC') {
			$pagination = $query->selectRaw("$ORDER_HDR.* ,search_name ,search_name_kana ,search_tel ,close_date1 ,pay_cycle1 ,pay_date1")
				->orderBy('web_order_num' , $desc)
				->get();
		} else {
			$pagination = $query->selectRaw("$ORDER_HDR.* ,search_name ,search_name_kana ,search_tel ,close_date1 ,pay_cycle1 ,pay_date1")
				->orderBy('web_order_num' , $desc)
				->paginate(20);
		}
		
        return $pagination;

    }



 /*************************************************************
 * 条件検索
 *
 * 利用ファイル
 *   admin/order/OrderList2.php index
 ***************************************************************/
     public function find2($param ,$desc = 'ASC') {

		$ORDER_HDR = config('dwo.ORDER_HDR');

		$query = ORDER_HDR::join('M_CC_CUST', 'M_CC_CUST.cust_num', "$ORDER_HDR.cust_num")
			->where('origin_type', '1');
		
        if (isset($param['orderNum']) ) {
			$query = $query->where('web_order_num', $param['orderNum']);
        }

        if (isset($param['custNum']) ) {
			$query = $query->where("$ORDER_HDR.cust_num", $param['custNum']);
        }

        if (isset($param['orderStartDate'])) { // 開始日
			$query = $query->where('order_date', '>=',  $param['orderStartDate']);
        }

        if (isset($param['orderEndDate'] )) { // 終了日
			$query = $query->where('order_date', '<=',  $param['orderEndDate']);
        }

        if (isset($param['custName'])) { // 得意先名
			$query = $query->where('search_name', 'like', '%' . $param['custName'] . '%' );
        }

        if (isset($param['custNameKana'])) { // 得意先名カナ
			$query = $query->where('search_name_kana', 'like', '%' . $param['custNameKana'] . '%' );
        }

        if (isset($param['searchTel'])) { // 得意先電話番号
			$query = $query->where('search_tel', 'like', '%' . $param['searchTel'] . '%' );
        }

        if (isset($param['deliveryType'])) { // 直送区分
			$query = $query->where('direct_delivery_type', $param['deliveryType']);
        }

        if (isset($param['deliveryName'])) { // 届け先名
			$query = $query->where('dest_name1', 'like', '%' . $param['deliveryName'] . '%' );
        }

        if (isset($param['nameOfCharge'])) { // 注文担当者
			$query = $query->where('dwo_order_person_name', 'like', '%' . $param['nameOfCharge'] . '%' );
        }

        if (isset($param['statusId'])) { /* ステータス */
			$query = $query->where('state_type', $param['statusId']);
        }

		$pagination = $query->selectRaw("$ORDER_HDR.* ,search_name ,search_name_kana ,search_tel")
			->orderBy('web_order_num' , $desc)
			->paginate(20);

		return $pagination;
    }


 /*************************************************************
 * 条件検索
 *
 * 利用ファイル
 *   admin/order/OrderList.php detail()
 *   admin/order/OrderList2.php detail()
 ***************************************************************/
     public function findById($orderNum) {

		$ORDER_HDR = config('dwo.ORDER_HDR');
		
		$dataList = ORDER_HDR::join('M_CC_CUST', 'M_CC_CUST.cust_num', "$ORDER_HDR.cust_num")
			->where('WEB_ORDER_NUM',  $orderNum)
			->selectRaw("$ORDER_HDR.*, $ORDER_HDR.name1 AS reg_name1, M_CC_CUST.search_name")
			->first();


        return $dataList;

    }


 /*************************************************************
 * 更新
 *
 * 利用ファイル
 *   admin/order/orderList.php store()
 *   admin/order/orderList2.php store()
 ***************************************************************/
     public function update($userId ,$param) {

		$header = ORDER_HDR::where('web_order_num' ,$param['orderNum'])
			->first();

		if (isset($header)) {
			
			if (isset($param['stateType']))        $header->state_type            = $param['stateType'] ;
			if (isset($param['orderDate']))        $header->order_date            = $param['orderDate'] ;
			if (isset($param['orderDate']))        $header->order_date            = $param['orderDate'] ;
			if (isset($param['shippingDate']))     $header->shipping_date         = $param['shippingDate'];
			if (isset($param['orderPersonName']))  $header->dwo_order_person_name = $param['orderPersonName'];
			if (isset($param['deliveryDate']))     $header->delivery_date         = $param['deliveryDate'];
			if (isset($param['destName1']))        $header->dest_name1            = $param['destName1'];
			if (isset($param['destPost']))         $header->dest_post             = $param['destPost'];
			if (isset($param['destPrefCd']))       $header->dest_pref_cd          = $param['destPrefCd'];
			if (isset($param['destAddress1']))     $header->dest_address1         = $param['destAddress1'];
			if (isset($param['destAddress2']))     $header->dest_address2         = $param['destAddress2'];
			if (isset($param['destAddress3']))     $header->dest_address3         = $param['destAddress3'];
			if (isset($param['destContactName1'])) $header->dest_contact_name1    = $param['destContactName1'];
			if (isset($param['destTel']))          $header->dest_tel              = $param['destTel'];
			if (isset($param['destFax']))          $header->dest_fax              = $param['destFax'];
			if (isset($param['deliverMemo']))      $header->deliver_memo          = $param['deliverMemo'];
			
			$header->double_package_type   = (!empty($param['doublePackageType']))  ? '1' : '0';
			$header->delivery_date_type    = (!empty($param['deliveryDateType']))   ? '1' : '0';
			$header->delivery_time_type    = (!empty($param['deliveryTimeType']))   ? '1' : '0';
			$header->direct_delivery_type  = (!empty($param['directDeliveryType'])) ? '1' : '0';
			$header->cust_del_type         = (!empty($param['custDelType']))        ? '1' : '0';
			$header->operator_del_type     = (!empty($param['operatorDelType']))    ? '1' : '0';


			if (isset($param['orderAmt']))      $header->order_amt = $param['orderAmt'];
			if (isset($param['taxRate']))       $header->tax_rate  = $param['taxRate'];
			if (isset($param['tax']))           $header->tax       = $param['tax'];
			if (isset($param['totalAmt']))      $header->total_amt = $param['totalAmt'];

			$header->save();
		}

        return;
    }


}
