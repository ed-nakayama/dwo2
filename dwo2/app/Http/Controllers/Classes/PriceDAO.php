<?php

namespace App\Http\Controllers\Classes;

use App\Models\InvoicePrice;

class PriceDAO {

	public $util;
/*
 * コンストラクタ
 */
	function __construct() {
		// 初期化
		$this->util = new Util();
	}


/**********************************************************************
 * 条件検索
 *
 * 利用ファイル
 *   admin/product/ProductPrice.php index()
 **********************************************************************/
    public function findList($prodCode) {

		$prList = InvoicePrice::where('price_product_code', $prodCode)
			->orderBy('price_class_large')
			->orderBy('price_class_medium')
			->orderBy('price_class_small')
			->orderBy('price_product_sup_license_n')
			->get();

		return $prList;

    }


/**********************************************************************
 * 新規登録
 *
 * 利用ファイル
 *   admin/product/ProductPrice.php insert()
 **********************************************************************/
    public function insert($userId, $list) {

		$priceClass = explode('-', $list['priceClass']);

		$price = InvoicePrice::create([
			'price_seq'                   => InvoicePrice::max('price_seq') + 1,
			'price_product_code'          => (isset($list['prodCode']))      ? $list['prodCode'] : null,
			'price_product_sup_code'      => (isset($list['supCode']))       ? $list['supCode'] : null,
			'price_product_sup_short'     => (isset($list['supShortName']))  ? $list['supShortName'] : null,
			'price_product_sup_license_n' => (isset($list['supLicenseNum'])) ? $list['supLicenseNum'] : null,
			'price_class_large'           => $priceClass[0],
			'price_class_medium'          => $priceClass[1],
			'price_class_small'           => $priceClass[2],
			'price_invoice_price'         => (isset($list['prodPrice']))   ? $list['prodPrice']   : null,
			'price_invoice_price_sup'     => (isset($list['supPrice']))    ? $list['supPrice']    : null,
			'price_agent_level_1'         => (isset($list['agentLevel1'])) ? $list['agentLevel1'] : null,
			'price_agent_level_2'         => (isset($list['agentLevel2'])) ? $list['agentLevel2'] : null,
			'price_agent_level_3'         => (isset($list['agentLevel3'])) ? $list['agentLevel3'] : null,
			'price_agent_level_4'         => (isset($list['agentLevel4'])) ? $list['agentLevel4'] : null,
			'price_agent_level_5'         => (isset($list['agentLevel5'])) ? $list['agentLevel5'] : null,
			'price_agent_level_6'         => (isset($list['agentLevel6'])) ? $list['agentLevel6'] : null,
			'price_agent_level_7'         => (isset($list['agentLevel7'])) ? $list['agentLevel7'] : null,
			'price_agent_level_8'         => (isset($list['agentLevel8'])) ? $list['agentLevel8'] : null,
			'price_del'                   => '0',
			'sample_price'                => (isset($list['samplePrice'])) ? $list['samplePrice'] : null,
		]);
		
        return;

    }


/**********************************************************************
 * 更新
 *
 * 利用ファイル
 *   admin/product/ProductPrice.php update()
 **********************************************************************/
    public function update($userId, $list) {

		$seqList           = $list['seqList'];
		$supCodeList       = (isset($list['supCodeList']))       ? $list['supCodeList']       : mull;
		$supShortNameList  = (isset($list['supShortNameList']))  ? $list['supShortNameList']  : null;
		$supLicenseNumList = (isset($list['supLicenseNumList'])) ? $list['supLicenseNumList'] : null;
		$priceClassList    = (isset($list['priceClassList']))    ? $list['priceClassList']    : null;
		$samplePriceList   = (isset($list['samplePriceList']))   ? $list['samplePriceList']   : null;
		$prodPriceList     = (isset($list['prodPriceList']))     ? $list['prodPriceList']     : null;
		$supPriceList      = (isset($list['supPriceList']))      ? $list['supPriceList']      : null;
		$agentLevel1List   = (isset($list['agentLevel1List']))   ? $list['agentLevel1List']   : null;
		$agentLevel2List   = (isset($list['agentLevel2List']))   ? $list['agentLevel2List']   : null;
		$agentLevel3List   = (isset($list['agentLevel3List']))   ? $list['agentLevel3List']   : null;
		$agentLevel4List   = (isset($list['agentLevel4List']))   ? $list['agentLevel4List']   : null;
		$agentLevel5List   = (isset($list['agentLevel5List']))   ? $list['agentLevel5List']   : null;
		$agentLevel6List   = (isset($list['agentLevel6List']))   ? $list['agentLevel6List']   : null;
		$agentLevel7List   = (isset($list['agentLevel7List']))   ? $list['agentLevel7List']   : null;
		$agentLevel8List   = (isset($list['agentLevel8List']))   ? $list['agentLevel8List']   : null;
		$delList           = (!empty($list['delList']))           ? $list['delList']          : null;


		$recCount = count($seqList);

		for ($i = 0; $i < $recCount; $i++) {

			$price = InvoicePrice::where('PRICE_SEQ' ,$seqList[$i])->first();

			$priceClass = explode('-', $priceClassList[$price->price_seq]);

			if (isset($price)) {
			    $price->price_product_sup_code      = $supCodeList[$price->price_seq];
			    $price->price_product_sup_short     = $supShortNameList[$price->price_seq];
			    $price->price_product_sup_license_n = $supLicenseNumList[$price->price_seq];
			    $price->price_class_large           = $priceClass[0];
			    $price->price_class_medium          = $priceClass[1];
			    $price->price_class_small           = $priceClass[2];
			    $price->price_invoice_price         = $prodPriceList[$price->price_seq];
			    $price->price_invoice_price_sup     = $supPriceList[$price->price_seq];
		 	    $price->price_agent_level_1         = $agentLevel1List[$price->price_seq];
		 	    $price->price_agent_level_2         = $agentLevel2List[$price->price_seq];
		 	    $price->price_agent_level_3         = $agentLevel3List[$price->price_seq];
		 	    $price->price_agent_level_4         = $agentLevel4List[$price->price_seq];
		 	    $price->price_agent_level_5         = $agentLevel5List[$price->price_seq];
		 	    $price->price_agent_level_6         = $agentLevel6List[$price->price_seq];
		 	    $price->price_agent_level_7         = $agentLevel7List[$price->price_seq];
		 	    $price->price_agent_level_8         = $agentLevel8List[$price->price_seq];
			    $price->sample_price                = $samplePriceList[$price->price_seq];
				 $price->price_del                  = $this->util->set_checkbox($delList ,$price->price_seq);

				$price->save();
			}
		}

        return;

    }

}
?>
