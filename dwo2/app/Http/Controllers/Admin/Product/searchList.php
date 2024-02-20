<?php
/*****************************************************/
require_once("action/classes/ProductDAO.class.php");
require_once("action/classes/StatusDAO.class.php");
require_once("action/classes/Util.class.php");
/*****************************************************/
/**
 *	Admin/Product/List.php
 *
 *	@author		{$author}
 *	@package	Dwo
 *	@version	$Id: List.php,v 1.1 2006/11/07 06:31:45 nakayama Exp $
 */

/**
 *	admin_product_listフォームの実装
 *
 *	@author		{$author}
 *	@access		public
 *	@package	Dwo
 */
class Dwo_Form_AdminProductSearchList extends Ethna_ActionForm
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
		
		// 検索項目
		'prodCode' => array(
                    'name' =>'商品コード',
                    'type' => VAR_TYPE_STRING,
                    ),
          'webOrder' => array(
                    'name' =>'Web利用(可)',
                    'type' => VAR_TYPE_INT,
                    ),
          'status' => array(
                    'name' =>'在庫状況',
                    'type' => VAR_TYPE_INT,
                    ),
          'del' => array(
                    'name' =>'削除フラグ',
                    'type' => VAR_TYPE_INT,
                    ),
          'newFlag' => array(
                    'name' =>'新規フラグ',
                    'type' => VAR_TYPE_INT,
                    ),
          'update' => array(
                    'name' =>'更新ボタン',
                    'type' => VAR_TYPE_STRING,
                    ),
          // 操作項目
          'page' => array(
                    'name' =>'ページング',
                    'type' => VAR_TYPE_STRING,
                    ),
          // 表示・入力項目
          'codeList' => array(
                    'name' =>'商品コード',
                    'type' => array(VAR_TYPE_STRING),
                    ),
          'samplePriceList' => array(
                    'name' =>'通常製品参考価格',
                    'type' => array(VAR_TYPE_INT),
                    'type_error'    => '通常製品参考価格には11桁以内の半角数字を入力して下さい。',
                    ),
          'startDateList' => array(
                    'name' =>'納品先名称',
                    'type' => array(VAR_TYPE_STRING),
                    ),
          'endDateList' => array(
                    'name' =>'販売終了日',
                    'type' => array(VAR_TYPE_STRING),
                    ),
          'statusList' => array(
                    'name' =>'在庫状況',
                    'type' => array(VAR_TYPE_STRING),
                    ),
          'shipDateList' => array(
                    'name' =>'出荷可能日',
                    'type' => array(VAR_TYPE_STRING),
                    ),
          'webOrderList' => array(
                    'name' =>'Web 受注可能フラグ',
                    'type' => array(VAR_TYPE_STRING),
                    ),
          'visiblePAPStdList' => array(
                    'name' =>'PAP視属性',
                    'type' => array(VAR_TYPE_STRING),
                    ),
          'visiblePAPGoldList' => array(
                    'name' =>'PAP GOLD可視属性',
                    'type' => array(VAR_TYPE_STRING),
                    ),
          'visibleYBPList' => array(
                    'name' =>'YBP可視属性',
                    'type' => array(VAR_TYPE_STRING),
                    ),
          'visibleYbpPapList' => array(
                    'name' =>'YBP(PAP)可視属性',
                    'type' => array(VAR_TYPE_STRING),
                    ),
          'delList' => array(
                    'name' =>'削除フラグ',
                    'type' => array(VAR_TYPE_STRING),
                    ),
	);
	
}



/**
 *	admin_product_listアクションの実装
 *
 *	@author		{$author}
 *	@access		public
 *	@package	Dwo
 */
class Dwo_Action_AdminProductSearchList extends Ethna_ActionClass
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
		
		$statusDAO = new StatusDAO();
		$stList = $statusDAO->findList();
		
		for ($i = 0; $i < $stList->size(); $i++) {
			$data = $stList->get($i);
			$statList[$i]['code'] = $data->code;
			$statList[$i]['name'] = $data->name;
		}
			
		$this->af->set('statList', $statList);
			
	    $operatorId = $this->session->get("operatorId");
	    $operatorName = $this->session->get("operatorName");

		$util = new Util();

		$msg = "";

		$prodCode = $this->af->get("prodCode");
		$webOrder = $this->af->get("webOrder");
		$status = $this->af->get("status");
		$del = $this->af->get("del");
		$newFlag = $this->af->get("newFlag");

		$productDAO = new ProductDAO();

		if ($this->af->get("update")) {
		
			if ($this->af->validate() == 0) {

				$codeList = $this->af->get("codeList");
				$samplePriceList = $this->af->get("samplePriceList");
			  	$startDateList =  $this->af->get("startDateList");
			  	$endDateList =  $this->af->get("endDateList");
				$statusList = $this->af->get("statusList");
				$shipDateList = $this->af->get("shipDateList");
			  	$webOrderList = $this->af->get("webOrderList");
		  		$visiblePAPStdList =  $this->af->get("visiblePAPStdList");
		  		$visiblePAPGoldList =  $this->af->get("visiblePAPGoldList");
		  		$visibleYBPList =  $this->af->get("visibleYBPList");
		  		$visibleYbpPapList =  $this->af->get("visibleYbpPapList");
		  		$delList =  $this->af->get("delList");

				$recCount = count($codeList);

				$dt = new Product();
				for ($i=0; $i < $recCount; $i++) {
					$dt->code = $codeList[$i];
					$dt->samplePrice = $samplePriceList[$i];
			  		$dt->startDate = $startDateList[$i];
			  		$dt->endDate = $endDateList[$i];
					$dt->stockStatus = $statusList[$i];
					$dt->shipDate = $shipDateList[$i];
					$dt->webOrder = $util->checkBox($webOrderList ,$codeList[$i]);
			  		$dt->visiblePAPStd = $util->checkBox($visiblePAPStdList ,$codeList[$i]);
					$dt->visiblePAPGold =$util->checkBox($visiblePAPGoldList ,$codeList[$i]);
					$dt->visibleYBP = $util->checkBox($visibleYBPList ,$codeList[$i]);
					$dt->visibleYbpPap = $util->checkBox($visibleYbpPapList ,$codeList[$i]);
		  			$dt->modifiedId = $operatorId;
		  			$dt->del = $util->checkBox($delList ,$codeList[$i]);

					$productDAO->update($dt);
				}

				$msg = "更新しました";
				
			}
			
		}
		
		if ($this->af->get('page')) {
			
			$pager = $this->session->get('pager');
			
			if ($this->af->get('page') == 'p') {
				$pager->previous();
			} else {
				$pager->next();
			}
			
			$this->session->set('pager', $pager);
			
		} else {
			
			$productDAO = new ProductDAO();
			$prod = new Product();
	
			$prod->code = $prodCode;
			$prod->stockStatus = $status;
	
			if ($newFlag == 1) {
				$webOrder = "";
				$del = "";
			}
			$prod->webOrder = $webOrder;
			$prod->del = $del;
	
	
			$prList = $productDAO->findById($prod ,$newFlag);
			$dataList = array();
	
			for ($i = 0; $i < $prList->size(); $i++) {
				
				$data = $prList->get($i);
	
				$dataList[$i]['code'] = $data->code;
				$dataList[$i]['name'] = $data->name;
				$dataList[$i]['samplePrice'] = $data->samplePrice;
				$dataList[$i]['startDate'] = $data->startDate;
				$dataList[$i]['endDate'] = $data->endDate;
				$dataList[$i]['status'] = $data->stockStatus;
				$dataList[$i]['shipDate'] = $data->shipDate;
				$dataList[$i]['webOrder'] = $data->webOrder;
				$dataList[$i]['visiblePAPStd'] = $data->visiblePAPStd;
				$dataList[$i]['visiblePAPGold'] = $data->visiblePAPGold;
				$dataList[$i]['visibleYBP'] = $data->visibleYBP;
				$dataList[$i]['visibleYbpPap'] = $data->visibleYbpPap;
				$dataList[$i]['del'] = $data->del;
				
			}
			
			$linage = 20;
			$pager = new Pager($dataList, $linage);
			$this->session->set('pager', $pager);
			
		}
		
		$this->af->set("prodCode" ,$prodCode);
		$this->af->set("webOrder" ,$webOrder);
		$this->af->set("status" ,$status);
		$this->af->set("del" ,$del);
		$this->af->set("newFlag" ,$newFlag);

		$this->af->set("total", $pager->dataSize());
		$this->af->set("dataList" ,$pager->readLines());
		$this->af->set("linage", $pager->getLinage());
		$this->af->set("totalPages", $pager->numberOfTotal());
		$this->af->set("pageNumber", $pager->pageNumber());
		$this->af->set("lastPage", $pager->isLastPage());
		
		$this->af->set("msg" ,$msg);

		return 'admin_product_list';
	}
}
?>
