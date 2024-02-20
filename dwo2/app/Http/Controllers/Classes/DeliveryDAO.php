<?php

namespace App\Http\Controllers\Classes;

use App\Models\DeliveryMt;

class DeliveryDAO {

	public $util;
/*
 * コンストラクタ
 */
	function __construct() {
		// 初期化
		$this->util = new Util();
	}


 /*************************************************************
 * DWO2 WEB用検索
 *
 * 利用ファイル
 *   weborder/Top/TopDelivery.php index() search()
 *   weborder/Delivery/DeliveryOther.php index()
 *   weborder/Delivery/DeliverySelect.php index()
 ***************************************************************/
    public function findweb($param)
    {
		$delList = DeliveryMt::where('delivery_cust_code', $param['delivery_cust_code'])
			->where('delivery_del', '0');

		if (!empty($param['delivery_seq'])) {
			$delList = $delList->where('delivery_seq', $param['delivery_seq']);
		}

		if (!empty($param['delivery_name'])) {
			$delList = $delList->where('delivery_name', 'like', '%' . $param['delivery_name'] . '%');
		}

		if (!empty($param['delivery_tel'])) {
			$delList = $delList->where('DELIVERY_TEL', 'like', '%' . $param['delivery_tel'] . '%');
		}

		$delList = $delList->orderBy('delivery_seq')
			->get();

        return $delList;
    }



 /*************************************************************
 * 条件検索
 *
 * 利用ファイル
 *   admin/order/OrderDelivery.php search()
 ***************************************************************/
    public function find($param)
    {
		$dataList = DeliveryMt::where('delivery_cust_code' ,$param['search_cust_code']);

		if (isset($param['search_delivery_name'])) {
			$dataList = $dataList->where('delivery_name', 'like' , "%{$param['search_delivery_name']}%" );
		}

		if (isset($param['search_tel'])) {
			$dataList = $dataList->whereRaw("REPLACE(delivery_tel, '-', '') like '{$param['search_tel']}%'");
		}

		if (isset($param['search_addr'])) {
			$dataList = $dataList->where('delivery_add1', 'like' , "%{$param['search_addr']}%" );
		}

		$dataList = $dataList->orderBy('delivery_seq')
			->paginate(10);

        return $dataList;
    }


 /*************************************************************
 * 更新
 *
 * 利用ファイル
 *   admin/order/OrderDelivery.php store()
 ***************************************************************/
    public function update_list($userId, $param) {

		$codeList       = (isset($param['codeList']))       ? $param['codeList']       : null;
		$seqList        = (isset($param['seqList']))        ? $param['seqList']        : null;
		$destList       = (isset($param['destList']))       ? $param['destList']       : null;
		$personNameList = (isset($param['personNameList'])) ? $param['personNameList'] : null;
		$telList        = (isset($param['telList']))        ? $param['telList']        : null;
		$faxList        = (isset($param['faxList']))        ? $param['faxList']        : null;
		$zipList        = (isset($param['zipList']))        ? $param['zipList']        : null;
		$prefList       = (isset($param['prefList']))       ? $param['prefList']       : null;
		$address1List   = (isset($param['address1List']))   ? $param['address1List']   : null;
		$address2List   = (isset($param['address2List']))   ? $param['address2List']   : null;
		$address3List   = (isset($param['address3List']))   ? $param['address3List']   : null;
		$delList        = (isset($param['delList']))        ? $param['delList']        : null;


		$recCount = count($codeList);

		for ($i = 0; $i < $recCount; $i++) {
			$deli = DeliveryMt::where('delivery_cust_code' ,$codeList[$i])
				->where('delivery_seq' ,$seqList[$i])
				->first();

			if (isset($deli)) {
				$arg = $deli->delivery_cust_code . '_' . $deli->delivery_seq;
				
				$delivery_name           = (isset($destList[$arg]))       ? $destList[$arg]       : null;
				$delivery_name_of_charge = (isset($personNameList[$arg])) ? $personNameList[$arg] : null;
				$delivery_tel            = (isset($telList[$arg]))        ? $telList[$arg]        : null;
				$delivery_fax            = (isset($faxList[$arg]))        ? $faxList[$arg]        : null;
				$delivery_zip            = (isset($zipList[$arg]))        ? $zipList[$arg]        : null;
				$delivery_pref           = (isset($prefList[$arg]))       ? $prefList[$arg]       : null;
				$delivery_add1           = (isset($address1List[$arg]))   ? $address1List[$arg]   : null;
				$delivery_add2           = (isset($address2List[$arg]))   ? $address2List[$arg]   : null;
				$delivery_add3           = (isset($address3List[$arg]))   ? $address3List[$arg]   : null;
				$delivery_del            = $this->util->checkbox($delList  ,$arg);

				if (( $deli->delivery_name != $delivery_name)
					|| ($deli->delivery_name_of_charge != $delivery_name_of_charge)
					|| ($deli->delivery_tel  != $delivery_tel)
					|| ($deli->delivery_fax  != $delivery_fax)
					|| ($deli->delivery_zip  != $delivery_zip)
					|| ($deli->delivery_pref != $delivery_pref)
					|| ($deli->delivery_add1 != $delivery_add1)
					|| ($deli->delivery_add2 != $delivery_add2)
					|| ($deli->delivery_add3 != $delivery_add3)
					|| ($deli->delivery_del  != $delivery_del) ) {

					DeliveryMt::where('delivery_cust_code' ,$codeList[$i])
						->where('delivery_seq' ,$seqList[$i])
						->update([
							'delivery_name'           => $delivery_name,
							'delivery_name_of_charge' => $delivery_name_of_charge,
							'delivery_tel'            => $delivery_tel,
							'delivery_fax'            => $delivery_fax,
							'delivery_zip'            => $delivery_zip,
							'delivery_pref'           => $delivery_pref,
							'delivery_add1'           => $delivery_add1,
							'delivery_add2'           => $delivery_add2,
							'delivery_add3'           => $delivery_add3,
							'delivery_del'            => $delivery_del,
						]);
				}
			}
		}

        return;

    }

 /*************************************************************
 * 削除専用
 *
 * 利用ファイル
 *   weborder/top/TopDelivery.php delete()
 ***************************************************************/
    function delete($list) {

		DeliveryMt::where('delivery_cust_code' ,$list->delivery_cust_code)
			->where('delivery_seq' ,$list->delivery_seq)
			->update([
				'delivery_del' => '1',
			]);

        return;
    }

}
