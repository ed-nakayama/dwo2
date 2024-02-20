<?php

namespace App\Http\Controllers\Classes;

use App\Http\Controllers\Classes\CalendarMtDAO;
use App\Models\ProductMt;
use App\Models\MItem;

class ProductDAO {

	public $util;
/*
 * コンストラクタ
 */
	function __construct() {
		// 初期化
		$this->util = new Util();
	}


 /*************************************************************
 * 新規データ検索
 *
 * 利用ファイル
 *   admin/product/ProductList.php index()
 ***************************************************************/
    public function findNew() {

		$prodList = MItem::leftjoin('DWO_product_mt' , 'dwo_product_mt.product_code' ,'m_item.item_cd')
			->whereIn('m_item.item_class_large',['01','02','03'])
			->where('m_item.del_type','0')
			->whereNull('dwo_product_mt.product_code')
			->get();

		if (isset($prodList[0])) {
			foreach ($prodList as $item) {
				$prod = Product::create([
					'product_code'   => $item->item_cd,
					'product_del'    => '0',
		        ]);
			}
		}

		return;
    }


 /*************************************************************
 * 条件検索
 *
 * 利用ファイル
 *   admin/product/ProductList.php search_list()
 *   admin/product/ProductCategory.php detail()
 ***************************************************************/
    public function find($param) {

		$prodList = MItem::join('DWO_product_mt' , 'dwo_product_mt.product_code' ,'m_item.item_cd')
			->where('m_item.del_type','0');

		if (isset($param['prodCode'])) {
			$prodList = $prodList->where('product_code' ,$param['prodCode']);
		}
		
		if (!empty($param['newFlag'])) {
			$prodList = $prodList->whereNull('product_web_order_flag');
		} else if (!empty($param['webOrder'])) {
			$prodList = $prodList->where('product_web_order_flag' ,'1');
		}

		if (isset($param['status'])) {
			$prodList = $prodList->where('product_status_id' ,$param['status']);
		}

		if (!empty($param['webOrder'])) {
			$prodList = $prodList->where('product_del' ,'0');
		} else if (!empty($param['del'])) {
			$prodList = $prodList->where('product_del' ,'1');
		} else {
			$prodList = $prodList->where('product_del' ,'0');
		}

		$prodList = $prodList->paginate(20);

        return $prodList;
    }


 /*************************************************************
 * 更新
 *
 * 利用ファイル
 *   admin/product/ProductList.php store()
 ***************************************************************/
    public function update_list($userId ,$param) {

		$codeList           = $param['codeList'];
		$samplePriceList    = (isset($param['samplePriceList']))    ? $param['samplePriceList']    : null;
		$startDateList      = (isset($param['startDateList']))      ? $param['startDateList']      : null;
		$endDateList        = (isset($param['endDateList']))        ? $param['endDateList']        : null;
		$statusList         = (isset($param['statusList']))         ? $param['statusList']         : null;
		$shipDateList       = (isset($param['shipDateList']))       ? $param['shipDateList']       : null;
		$webOrderList       = (isset($param['webOrderList']))       ? $param['webOrderList']       : null;
		$visiblePAPStdList  = (isset($param['visiblePAPStdList']))  ? $param['visiblePAPStdList']  : null;
		$visiblePAPGoldList = (isset($param['visiblePAPGoldList'])) ? $param['visiblePAPGoldList'] : null;
		$visibleYBPList     = (isset($param['visibleYBPList']))     ? $param['visibleYBPList']      : null;
		$visibleYbpPapList  = (isset($param['visibleYbpPapList']))  ? $param['visibleYbpPapList']  : null;
		$delList            = (isset($param['delList']))            ? $param['delList']            : null;
		
		$recCount = count($codeList);

		for ($i = 0; $i < $recCount; $i++) {
			$prod = ProductMt::where('product_code', $codeList[$i])->first();
			
			if (isset($prod)) {
				$sample_price     = $this->util->set_text($samplePriceList[$prod->product_code]);
				$sales_start_date = $this->util->set_text($startDateList[$prod->product_code]);
				$sales_stop_date  = $this->util->set_text($endDateList[$prod->product_code]);
				$status_id        = $this->util->set_text($statusList[$prod->product_code]);
				$ship_date        = $this->util->set_text($shipDateList[$prod->product_code]);

				$web_order_flag   = $this->util->checkbox($webOrderList       ,$prod->product_code);
				$visible_pap_std  = $this->util->checkbox($visiblePAPStdList  ,$prod->product_code);
				$visible_pap_gld  = $this->util->checkbox($visiblePAPGoldList ,$prod->product_code);
				$visible_ybp      = $this->util->checkbox($visibleYBPList     ,$prod->product_code);
				$visible_ybp_pap  = $this->util->checkbox($visibleYbpPapList  ,$prod->product_code);
				$product_del      = $this->util->checkbox($delList            ,$prod->product_code);

				if ($prod->sample_price             = $sample_price
					|| $prod->product_sales_start_date = $sales_start_date
					|| $prod->product_sales_stop_date  = $sales_stop_date
					|| $prod->product_status_id        = $status_id
					|| $prod->product_ship_date        = $ship_date
					|| $prod->product_web_order_flag   = $web_order_flag
					|| $prod->product_visible_pap_std  = $visible_pap_std
					|| $prod->product_visible_pap_gld  = $visible_pap_gld
					|| $prod->product_visible_ybp      = $visible_ybp
					|| $prod->product_visible_ybp_pap  = $visible_ybp_pap
					|| $prod->product_del              =  $product_del) 
				{
					$prod->product_modified_id = $userId;
				}

				$prod->sample_price             = $sample_price;
				$prod->product_sales_start_date = $sales_start_date;
				$prod->product_sales_stop_date  = $sales_stop_date;
				$prod->product_status_id        = $status_id;
				$prod->product_ship_date        = $ship_date;
				
				$prod->product_web_order_flag   = $web_order_flag;
				$prod->product_visible_pap_std  = $visible_pap_std;
				$prod->product_visible_pap_gld  = $visible_pap_gld;
				$prod->product_visible_ybp      = $visible_ybp;
				$prod->product_visible_ybp_pap  = $visible_ybp_pap;
				$prod->product_del              =  $product_del;

				$prod->save();
			}
		}

        return;

    }

 /*************************************************************
 * 在庫状況が「予約中受付中」の商品を「在庫あり」に変更します。
 *
 * 【バッチ用】
 * 出荷可能日がバッチ実行時翌日のものを対象とします。
 *
 * 利用ファイル
 *   admin/Batch/BatchConf.php closing()
 ***************************************************************/
	public function updateInStock() {

		$calendarMtDAO = new CalendarMtDAO();
		$ship = $calendarMtDAO->getShippingDate();

		ProductMt::where('product_status_id', 8)
			->where('product_del', 0)
			->where('product_ship_date', '<=', $ship)
			->update([
				'product_status_id' => '1',
				'product_ship_date' => null,
			]);

        return;
    }

}
