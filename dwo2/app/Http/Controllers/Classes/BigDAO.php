<?php

namespace App\Http\Controllers\Classes;

use App\Models\BigCategoryMt;

class BigDAO {

	public $util;
/*
 * コンストラクタ
 */
	function __construct() {
		// 初期化
		$this->util = new Util();
	}


 /*******************************************************************************
 * 指定された削除状態の条件に該当する商品大分類のリストを取得します。<br/>
 * <br/>
 * 削除状態パラメータ<br/>
 * <li>1:削除なし</li> 
 * <li>2:削除あり</li>
 * <li>3:全て</li>
 * @param int delType 削除状態
 * @return ArrayList 商品大分類のリスト
 *
 * 利用ファイル
 *   admin/product/ProductBig.php  index() search() 
 *******************************************************************************/
    public function findByDeleteType($delType = 1) {

		$bigList = BigCategoryMt::orderBy('big_category_code');

        if ($delType == '1') {
        	$bigList = $bigList->where('big_category_del' ,'0');
        } else if ($delType == '2') {
        	$bigList = $bigList->where('big_category_del' ,'1');
        }
        
        $bigList = $bigList->get();

        return $bigList;
    }


 /*************************************************************
 * 更新
 *
 * 利用ファイル
 *   admin/product/ProductBig.php  store()
 ***************************************************************/
     public function update_list($userId, $param) {

		$codeList    = $param['codeList'];
		$nameList    = (isset($param['nameList']))    ? $param['nameList']    : null;
		$delList     = (isset($param['delList']))     ? $param['delList']     : null;
		$oldProdList = (isset($param['oldProdList'])) ? $param['oldProdList'] : null;

		$recCount = count($codeList);

		for ($i = 0; $i < $recCount; $i++) {
			$big = BigCategoryMt::find($codeList[$i]);

			if (isset($big)) {

				$cat_name = $nameList[ $big->big_category_code ];

				$cat_old  = $this->util->checkbox($oldProdList  ,$codeList[$i]);
				$cat_del  = $this->util->checkbox($delList  ,$codeList[$i]);
				
				if ( $big->big_category_name          != $cat_name
					|| $big->big_category_del         != $cat_del
					|| $big->big_category_old_product != $cat_old )
				{
					$big->big_category_modified_id = $userId;
				}

				$big->big_category_name        = $cat_name;
				$big->big_category_del         = $cat_del;
				$big->big_category_old_product = $cat_old;


				$big->save();
			}
		}

        return;

    }

}
