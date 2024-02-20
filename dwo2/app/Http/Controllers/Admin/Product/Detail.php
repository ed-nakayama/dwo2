<?php
/*****************************************************/
require_once("action/classes/ProductDAO.class.php");
/*****************************************************/
/**
 *	Admin/Product/Detail.php
 *
 *	@author		{$author}
 *	@package	Dwo
 *	@version	$Id: List.php,v 1.1 2006/11/07 06:31:45 nakayama Exp $
 */

/**
 *	admin_product_Detailフォームの実装
 *
 *	@author		{$author}
 *	@access		public
 *	@package	Dwo
 */
class Dwo_Form_AdminProductDetail extends Ethna_ActionForm
{
	/**
	 *	@access	private
	 *	@var	array	フォーム値定義
	 */
	var	$form = array(
		/*
		'sample' => array(
			'name'			=> 'サンプル',		// 表示名
			'required'      => true,			// 必須オプション(true/false)
			'min'           => null,			// 最小値
			'max'           => null,			// 最大値
			'regexp'        => null,			// 文字種指定(正規表現)
			'custom'        => null,			// メソッドによるチェック
			'filter'        => null,			// 入力値変換フィルタオプション
			'form_type'     => FORM_TYPE_TEXT,	// フォーム型
			'type'          => VAR_TYPE_INT,	// 入力値型
		),
		*/
          'update' => array(
                    'name' =>'更新ボタン',
                    'type' => VAR_TYPE_STRING,
                    ),
          'prodCode' => array(
                    'name' =>'商品コード',
                    'type' => VAR_TYPE_STRING,
					'required'      => true,
					'required_error' => '商品コードを入力してください',
                    ),
          'code' => array(
                    'name' =>'商品コード',
                    'type' => VAR_TYPE_STRING,
                    ),
          'janCode' => array(
                    'name' =>'JANコード確認用',
                    'type' => VAR_TYPE_STRING,
                    ),
          'freeCode' => array(
                    'name' =>'フリーコード',
                    'type' => VAR_TYPE_STRING,
                    ),
          'startDateYear' => array(
                    'name' =>'販売開始日 年',
                    'type' => VAR_TYPE_STRING,
                    ),
          'startDateMonth' => array(
                    'name' =>'販売開始日 月',
                    'type' => VAR_TYPE_STRING,
                    ),
          'startDateDay' => array(
                    'name' =>'販売開始日 日',
                    'type' => VAR_TYPE_STRING,
                    ),
          'endDateYear' => array(
                    'name' =>'販売終了日 年',
                    'type' => VAR_TYPE_STRING,
                    ),
          'endDateMonth' => array(
                    'name' =>'販売終了日 月',
                    'type' => VAR_TYPE_STRING,
                    ),
          'endDateDay' => array(
                    'name' =>'販売終了日 日',
                    'type' => VAR_TYPE_STRING,
                    ),
          'stockStatus' => array(
                    'name' =>'在庫状況',
                    'type' => VAR_TYPE_INT,
                    ),
          'shipDateYear' => array(
                    'name' =>'出荷可能日 年',
                    'type' => VAR_TYPE_STRING,
                    ),
          'shipDateMonth' => array(
                    'name' =>'出荷可能日 月',
                    'type' => VAR_TYPE_STRING,
                    ),
          'shipDateDay' => array(
                    'name' =>'出荷可能日 日',
                    'type' => VAR_TYPE_STRING,
                    ),
          'config' => array(
                    'name' =>'商品形状',
                    'type' => VAR_TYPE_INT,
                    ),
          'orderQuantity' => array(
                    'name' =>'受注確認数量',
                    'type' => VAR_TYPE_INT,
                    ),
          'webOrder' => array(
                    'name' =>'Web 受注可能フラグ 0:不可 1:可',
                    'type' => VAR_TYPE_INT,
                    ),
          'visiblePAPStd' => array(
                    'name' =>'PAP視属性（0:不可視、1:可視）',
                    'type' => VAR_TYPE_INT,
                    ),
          'visiblePAPGold' => array(
                    'name' =>'PAP GOLD可視属性（0:不可視、1:可視）',
                    'type' => VAR_TYPE_INT,
                    ),
          'visibleYBP' => array(
                    'name' =>'YBP可視属性（0:不可視、1:可視）',
                    'type' => VAR_TYPE_INT,
                    ),
          'url' => array(
                    'name' =>'詳細URL',
                    'type' => VAR_TYPE_STRING,
                    ),
          'del' => array(
                    'name' =>'削除フラグ',
                    'type' => VAR_TYPE_INT,
                    ),
	);
}


/**
 *	admin_product_Detailアクションの実装
 *
 *	@author		{$author}
 *	@access		public
 *	@package	Dwo
 */
class Dwo_Action_AdminProductDetail extends Ethna_ActionClass
{
	/**
	 *	admin_product_listアクションの前処理
	 *
	 *	@access	public
	 *	@return	string		遷移名(正常終了ならnull, 処理終了ならfalse)
	 */
	function prepare()
	{
    	$this->session->start();
	    $operatorId = $this->session->get("operatorId");
	    $operatorName = $this->session->get("operatorName");

		if ($operatorId == "") {
			return 'admin_login';
		}

	   	if ($this->af->validate() > 0) {
			return 'admin_product_list';
   		}

		$prodCode = $this->af->get("prodCode");
		$productDAO = new ProductDAO();
		$product = $productDAO->findById($prodCode);

		if ($product->itemCd == "") {
			$res = Ethna::raiseNotice('商品コードが存在しません', E_NEWS_AUTHINVALID );
			$this->ae->addObject(null, $res);

			return 'admin_product_list';
		}

		return null;
	}

	/**
	 *	admin_product_listアクションの実装
	 *
	 *	@access	public
	 *	@return	string	遷移名
	 */
	function perform()
	{
	    $operatorId = $this->session->get("operatorId");
	    $operatorName = $this->session->get("operatorName");

		$prodCode = $this->af->get("prodCode");

		$msg = "";

		$productDAO = new ProductDAO();

		if ($this->af->get("update") != "") {
			$prod = new Product();

			$prod->imteCd = $this->af->get("prodCode");
			$prod->code = $this->af->get("prodCode");
			$prod->janCode = $this->af->get("janCode");
			$prod->freeCode = $this->af->get("freeCode");
			if ($this->af->get("startDateYear") != "") {
				$prod->startDate = $this->af->get("startDateYear") . "-" . $this->af->get("startDateMonth") . "-" . $this->af->get("startDateDay");
			}
			if ($this->af->get("endDateYear") != "") {
				$prod->endDate = $this->af->get("endDateYear") . "-" . $this->af->get("endDateMonth") . "-" . $this->af->get("endDateDay");
			}
			$prod->stockStatus = $this->af->get("stockStatus");

			if ($this->af->get("shipDateYear") != "") {
				$prod->shipDate = $this->af->get("shipDateYear") . "-" . $this->af->get("shipDateMonth") . "-" . $this->af->get("shipDateDay");
			}
			$prod->config = $this->af->get("config");
			$prod->orderQuantity = $this->af->get("orderQuantity");
			$prod->webOrder = $this->af->get("webOrder");
			$prod->url = $this->af->get("url");
			$prod->del = $this->af->get("del");
			$prod->visiblePAPStd = $this->af->get("visiblePAPStd");
			$prod->visiblePAPGold = $this->af->get("visiblePAPGold");
			$prod->visibleYBP = $this->af->get("visibleYBP");
			$prod->modifiedId = $operatorId;

			$productDAO->update($prod);

			$msg = "更新しました";
		}

		$product = $productDAO->findById($prodCode);

		$this->af->set("prodCode",$prodCode);
		$this->af->set("code",$product->code);
		$this->af->set("janCode",$product->janCode);
		$this->af->set("freeCode",$product->freeCode);
		$this->af->set("startDate",$product->startDate);
		$this->af->set("endDate",$product->endDate);
		$this->af->set("stockStatus",$product->stockStatus);
		$this->af->set("shipDate",$product->shipDate);
		$this->af->set("config",$product->config);
		$this->af->set("orderQuantity",$product->orderQuantity);
		$this->af->set("webOrder",$product->webOrder);
		$this->af->set("url",$product->url);
		$this->af->set("modifiedId",$product->modifiedId);
		$this->af->set("lastUpdate",$product->lastUpdate);
		$this->af->set("del",$product->del);
		$this->af->set("linkFlag",$product->linkFlag);
		$this->af->set("visiblePAPStd",$product->visiblePAPStd);
		$this->af->set("visiblePAPGold",$product->visiblePAPGold);
		$this->af->set("visibleYBP",$product->visibleYBP);

		$this->af->set("prodName",$product->name);
		$this->af->set("supply" ,$product->supply);

		$this->af->set("msg" ,$msg);

		return 'admin_product_detail';
	}
}
?>
