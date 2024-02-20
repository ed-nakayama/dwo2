<?php

namespace App\Http\Controllers\Classes;

use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Classes\Util;
use App\Models\ProductCategoryMt;


class CategoryDAO {

	public $util;
/*
 * コンストラクタ
 */
	function __construct() {
		// 初期化
		$this->util = new Util();
	}

 /*************************************************************
 * 条件検索 削除フラグをソート条件に入れる
 *
 * 利用ファイル
 *   admin/product/ProductCategory.php detail()
 ***************************************************************/
    public function findDelSort($prodCode) {

		$dataList = ProductCategoryMt::where('product_category_code' ,$prodCode)
			->orderBy('product_category_del')
			->orderBy('product_category_big_code')
			->orderBy('product_category_middle_code')
			->get();

        return $dataList;

    }


 /*************************************************************
 * 更新
 *
 * 利用ファイル
 *   admin/product/ProductCategory.php  store()
 ***************************************************************/
    public function update_list($userId, $param) {

		$codeList    = $param['codeList'];
		$bigCodeList = (isset($param['bigCodeList'])) ? $param['bigCodeList'] : null;
		$midCodeList = (isset($param['midCodeList'])) ? $param['midCodeList'] : null;
		$delList     = (isset($param['delList']))     ? $param['delList']     : null;

		$recCount = count($codeList);

		for ($i = 0; $i < $recCount; $i++) {
			$cat = ProductCategoryMt::where('product_category_no' ,$codeList[$i])->first();

			if (isset($cat)) {
				$big_code = $bigCodeList[$cat->product_category_no];
				$middle_code = $midCodeList[$cat->product_category_no];
				$category_del = $this->util->checkbox($delList  ,$cat->product_category_no);

				if ( $cat->product_category_big_code != $big_code 
					|| $cat->product_category_middle_code != $middle_code
					|| $cat->product_category_del != $category_del)
				{
					$cat->product_category_modified_id = $userId;
				}

				$cat->product_category_big_code = $big_code;
				$cat->product_category_middle_code = $middle_code;
				$cat->product_category_del = $category_del;

				$cat->save();
			}
		}

        return;

    }


}
?>
