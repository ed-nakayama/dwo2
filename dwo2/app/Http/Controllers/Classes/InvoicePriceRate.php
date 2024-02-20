<?php

namespace App\Http\Controllers\Classes;

use App\Models\AgentView;
use App\Http\Controllers\Classes\DistributionViewDAO;

/**
 * 仕切率クラス
 */
class InvoicePriceRate {
	
	private $agentView = null;
	private $product = null;
	private $distList = null;
	
	public function __construct($agentView, $product) {
		$this->agentView = $agentView;
		$this->product = $product;
		$this->distList = $this->getDistributionView();
	} 
	
 /*************************************************************
 * 仕切り率を取得します。
 * @return 仕切り率(100分率) 
 *
 * 利用ファイル
 *   classes/ProductlistView getUserPrice()
 *   classes/ProductlistViewDAO searchProdList()
 ***************************************************************/
	public function getRate() {
		
		$rate = false;
		$rate = $this->getPrimayRate();
		
		if ($rate === false) {
			$rate = $this->getSecondaryRate();
		}
		
		if ($rate === false) {
			$rate = 100;
		}
		
		return $rate;
				
	}


	/****************************************
	* PrimayRate
	 ****************************************/
	private function getPrimayRate() {

		foreach ($this->distList as $dist) {
			if (
				($dist->cust_class_small == $this->agentView->cust_class_small) &&
				($dist->item_class_large == $this->product->item_class_large) &&
			    ($dist->item_class_medium == $this->product->item_class_medium) &&
			    ($dist->item_class_small == $this->product->item_class_small)
			    )
			{
				return $dist->standard_rate;
			}
			
		}
		
		return false;
	}

	
	/****************************************
	* SecondaryRate
	 ****************************************/
	private function getSecondaryRate() {
		
		foreach ($this->distList as $dist) {
			if (
				($dist->cust_class_small == 0) &&
				($dist->item_class_large == $this->product->item_class_large) &&
			    ($dist->item_class_medium == $this->product->item_class_medium) &&
			    ($dist->item_class_small == $this->product->item_class_small)
			    )
			{
				return $dist->standard_rate;
			}
			
		}
		
		return false;
	}
	
	
	/****************************************
	* 基幹仕切りマスタのデータ取得
	 ****************************************/
	private function getDistributionView() {
		
		// 基幹仕切りマスタのデータ取得
		$distributionviewdao = new DistributionViewDAO();

		return $distributionviewdao->find(
										$this->agentView->cust_class_large,
										$this->agentView->cust_class_medium,
										$this->product->item_class_large,
										$this->product->item_class_medium,
										$this->product->item_class_small
										);
	}
	
}
?>
