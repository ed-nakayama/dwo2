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
 *	admin_product_list�t�H�[���̎���
 *
 *	@author		{$author}
 *	@access		public
 *	@package	Dwo
 */
class Dwo_Form_AdminProductSearchList extends Ethna_ActionForm
{
	/**
	 *	@access	private
	 *	@var	array	�t�H�[���l��`
	 */
	var	$form = array(
		/*
		'sample' => array(
			'name'			=> '�T���v��',		// �\����
			'required'      => true,			// �K�{�I�v�V����(true/false)
			'min'           => null,			// �ŏ��l
			'max'           => null,			// �ő�l
			'regexp'        => null,			// ������w��(���K�\��)
			'custom'        => null,			// ���\�b�h�ɂ��`�F�b�N
			'filter'        => null,			// ���͒l�ϊ��t�B���^�I�v�V����
			'form_type'     => FORM_TYPE_TEXT,	// �t�H�[���^
			'type'          => VAR_TYPE_INT,	// ���͒l�^
		),
		*/
		
		// ��������
		'prodCode' => array(
                    'name' =>'���i�R�[�h',
                    'type' => VAR_TYPE_STRING,
                    ),
          'webOrder' => array(
                    'name' =>'Web���p(��)',
                    'type' => VAR_TYPE_INT,
                    ),
          'status' => array(
                    'name' =>'�݌ɏ�',
                    'type' => VAR_TYPE_INT,
                    ),
          'del' => array(
                    'name' =>'�폜�t���O',
                    'type' => VAR_TYPE_INT,
                    ),
          'newFlag' => array(
                    'name' =>'�V�K�t���O',
                    'type' => VAR_TYPE_INT,
                    ),
          'update' => array(
                    'name' =>'�X�V�{�^��',
                    'type' => VAR_TYPE_STRING,
                    ),
          // ���썀��
          'page' => array(
                    'name' =>'�y�[�W���O',
                    'type' => VAR_TYPE_STRING,
                    ),
          // �\���E���͍���
          'codeList' => array(
                    'name' =>'���i�R�[�h',
                    'type' => array(VAR_TYPE_STRING),
                    ),
          'samplePriceList' => array(
                    'name' =>'�ʏ퐻�i�Q�l���i',
                    'type' => array(VAR_TYPE_INT),
                    'type_error'    => '�ʏ퐻�i�Q�l���i�ɂ�11���ȓ��̔��p��������͂��ĉ������B',
                    ),
          'startDateList' => array(
                    'name' =>'�[�i�於��',
                    'type' => array(VAR_TYPE_STRING),
                    ),
          'endDateList' => array(
                    'name' =>'�̔��I����',
                    'type' => array(VAR_TYPE_STRING),
                    ),
          'statusList' => array(
                    'name' =>'�݌ɏ�',
                    'type' => array(VAR_TYPE_STRING),
                    ),
          'shipDateList' => array(
                    'name' =>'�o�׉\��',
                    'type' => array(VAR_TYPE_STRING),
                    ),
          'webOrderList' => array(
                    'name' =>'Web �󒍉\�t���O',
                    'type' => array(VAR_TYPE_STRING),
                    ),
          'visiblePAPStdList' => array(
                    'name' =>'PAP������',
                    'type' => array(VAR_TYPE_STRING),
                    ),
          'visiblePAPGoldList' => array(
                    'name' =>'PAP GOLD������',
                    'type' => array(VAR_TYPE_STRING),
                    ),
          'visibleYBPList' => array(
                    'name' =>'YBP������',
                    'type' => array(VAR_TYPE_STRING),
                    ),
          'visibleYbpPapList' => array(
                    'name' =>'YBP(PAP)������',
                    'type' => array(VAR_TYPE_STRING),
                    ),
          'delList' => array(
                    'name' =>'�폜�t���O',
                    'type' => array(VAR_TYPE_STRING),
                    ),
	);
	
}



/**
 *	admin_product_list�A�N�V�����̎���
 *
 *	@author		{$author}
 *	@access		public
 *	@package	Dwo
 */
class Dwo_Action_AdminProductSearchList extends Ethna_ActionClass
{
	/**
	 *	admin_product_list�A�N�V�����̑O����
	 *
	 *	@access	public
	 *	@return	string		�J�ږ�(����I���Ȃ�null, �����I���Ȃ�false)
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
	 *	admin_product_list�A�N�V�����̎���
	 *
	 *	@access	public
	 *	@return	string	�J�ږ�
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

				$msg = "�X�V���܂���";
				
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
