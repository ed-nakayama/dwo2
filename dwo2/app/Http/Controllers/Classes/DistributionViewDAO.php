<?php

namespace App\Http\Controllers\Classes;

use App\Models\DistributionView;

class DistributionViewDAO {

 /*************************************************************
 * 条件検索
 *
 * 利用ファイル
 *   admin/InvoicePriceRate.php getDistributionView()
 *   classes/InvoicePriceRate.php getDistributionView()
 ***************************************************************/
    public function find($cust_class_large, $cust_class_medium,
    			   $item_class_large, $item_class_medium, $item_class_small) {

		$list = DistributionView::where('cust_class_large', $cust_class_large)
			->where('cust_class_medium', $cust_class_medium)
			->where('item_class_large',  $item_class_large)
			->where('item_class_medium', $item_class_medium)
			->where('item_class_small',  $item_class_small)
			->get();

        return $list;
    }


 /*************************************************************
 * 条件検索
 *
 * 利用ファイル
 *   weborder/bascket/Upgradeconfirm.php index()
 ***************************************************************/
    function find2($cust_class_large, $cust_class_medium,
    			   $item_class_large, $item_class_medium, $item_class_small) {

		$dsList = DistributionView::where('cust_class_large', $cust_class_large)
			->where('cust_class_medium', $cust_class_medium)
			->where('item_class_large',  $item_class_large)
			->where('item_class_medium', $item_class_medium)
			->where('item_class_small',  $item_class_small)
			->get();

		return $list;

    }

}

