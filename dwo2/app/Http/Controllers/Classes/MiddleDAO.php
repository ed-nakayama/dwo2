<?php

namespace App\Http\Controllers\Classes;

use App\Models\MiddleCategoryMt;

class MiddleDAO {

	public $util;
/*
 * コンストラクタ
 */
	function __construct() {
		// 初期化
		$this->util = new Util();
	}


 /*************************************************************
 * 検索
 *
 * 利用ファイル
 *   admin/product/ProductMiddle.php index(), search()
 ***************************************************************/
	public function findList($param = null) {

		$middleList = MiddleCategoryMt::orderBy('middle_category_code');

        if (isset($param['search_code'])) {
        	$middleList = $middleList->where('middle_category_code' ,$param['search_code']);
		}

        if (isset($param['search_big_code'])) {
        	$middleList = $middleList->where('middle_big_category_code' ,$param['search_big_code']);
		}

        if (isset($param['search_name'])) {
        	$middleList = $middleList->where('middle_category_name', 'like' ,'%' . $param['search_name'] . '%');
		}

        if (!empty($param['search_prodLink'])) {
        	$middleList = $middleList->where('middle_category_link_flag' ,'1');
        }

        if (!empty($param['search_supLink'])) {
        	$middleList = $middleList->where('middle_category_sup_link_flag' ,'1');
        }

        if (!empty($param['search_del'])) {
	        if ($param['search_del'] == '1') {
	        	$middleList = $middleList->where('middle_category_del' ,'0');
	        } else if ($param['search_del'] == '2') {
	        	$middleList = $middleList->where('middle_category_del' ,'1');
			}
    	}

        $middleList = $middleList->get();

		return $middleList;
    }


 /*************************************************************
 * 更新
 *
 * 利用ファイル
 *   admin/product/ProductMiddle.php store()
 ***************************************************************/
    public function update_list($userId, $param) {

		$codeList     = $param['codeList'];
		$bigCodeList  = (isset($param['bigCodeList']))  ? $param['bigCodeList']  : null;
		$nameList     = (isset($param['nameList']))     ? $param['nameList']     : null;
		$delList      = (isset($param['delList']))      ? $param['delList']      : null;
		$prodLinkList = (isset($param['prodLinkList'])) ? $param['prodLinkList'] : null;
		$supLinkList  = (isset($param['supLinkList']))  ? $param['supLinkList']  : null;

		$recCount = count($codeList);

		for ($i = 0; $i < $recCount; $i++) {
			$mid = MiddleCategoryMt::where('middle_category_code' ,$codeList[$i])
			->first();

			if (isset($mid)) {
				$cat_name      = $nameList[$mid->middle_category_code];
				$cat_big       = $bigCodeList[$mid->middle_category_code];
				$cat_del       = $this->util->checkbox($delList      ,$mid->middle_category_code);
				$cat_prod_link = $this->util->checkbox($prodLinkList ,$mid->middle_category_code);
				$cat_sup_link  = $this->util->checkbox($supLinkList  ,$mid->middle_category_code);

				if ( $mid->middle_category_name            != $cat_name 
					|| $mid->middle_big_category_code      != $cat_big
					|| $mid->middle_category_link_flag     != $cat_prod_link
					|| $mid->middle_category_sup_link_flag != $cat_sup_link
					|| $mid->middle_category_del           != $cat_del) 
				{
					$mid->middle_category_modified_id = $userId;
				}

				$mid->middle_category_name          = $cat_name;
				$mid->middle_big_category_code      = $cat_big;
				$mid->middle_category_link_flag     = $cat_prod_link;
				$mid->middle_category_sup_link_flag = $cat_sup_link;
				$mid->middle_category_del           = $cat_del;

			
				$mid->save();
			}
		}

        return;
    }


}
