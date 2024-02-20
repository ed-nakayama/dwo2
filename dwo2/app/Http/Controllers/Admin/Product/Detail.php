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
 *	admin_product_Detail�t�H�[���̎���
 *
 *	@author		{$author}
 *	@access		public
 *	@package	Dwo
 */
class Dwo_Form_AdminProductDetail extends Ethna_ActionForm
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
          'update' => array(
                    'name' =>'�X�V�{�^��',
                    'type' => VAR_TYPE_STRING,
                    ),
          'prodCode' => array(
                    'name' =>'���i�R�[�h',
                    'type' => VAR_TYPE_STRING,
					'required'      => true,
					'required_error' => '���i�R�[�h����͂��Ă�������',
                    ),
          'code' => array(
                    'name' =>'���i�R�[�h',
                    'type' => VAR_TYPE_STRING,
                    ),
          'janCode' => array(
                    'name' =>'JAN�R�[�h�m�F�p',
                    'type' => VAR_TYPE_STRING,
                    ),
          'freeCode' => array(
                    'name' =>'�t���[�R�[�h',
                    'type' => VAR_TYPE_STRING,
                    ),
          'startDateYear' => array(
                    'name' =>'�̔��J�n�� �N',
                    'type' => VAR_TYPE_STRING,
                    ),
          'startDateMonth' => array(
                    'name' =>'�̔��J�n�� ��',
                    'type' => VAR_TYPE_STRING,
                    ),
          'startDateDay' => array(
                    'name' =>'�̔��J�n�� ��',
                    'type' => VAR_TYPE_STRING,
                    ),
          'endDateYear' => array(
                    'name' =>'�̔��I���� �N',
                    'type' => VAR_TYPE_STRING,
                    ),
          'endDateMonth' => array(
                    'name' =>'�̔��I���� ��',
                    'type' => VAR_TYPE_STRING,
                    ),
          'endDateDay' => array(
                    'name' =>'�̔��I���� ��',
                    'type' => VAR_TYPE_STRING,
                    ),
          'stockStatus' => array(
                    'name' =>'�݌ɏ�',
                    'type' => VAR_TYPE_INT,
                    ),
          'shipDateYear' => array(
                    'name' =>'�o�׉\�� �N',
                    'type' => VAR_TYPE_STRING,
                    ),
          'shipDateMonth' => array(
                    'name' =>'�o�׉\�� ��',
                    'type' => VAR_TYPE_STRING,
                    ),
          'shipDateDay' => array(
                    'name' =>'�o�׉\�� ��',
                    'type' => VAR_TYPE_STRING,
                    ),
          'config' => array(
                    'name' =>'���i�`��',
                    'type' => VAR_TYPE_INT,
                    ),
          'orderQuantity' => array(
                    'name' =>'�󒍊m�F����',
                    'type' => VAR_TYPE_INT,
                    ),
          'webOrder' => array(
                    'name' =>'Web �󒍉\�t���O 0:�s�� 1:��',
                    'type' => VAR_TYPE_INT,
                    ),
          'visiblePAPStd' => array(
                    'name' =>'PAP�������i0:�s���A1:���j',
                    'type' => VAR_TYPE_INT,
                    ),
          'visiblePAPGold' => array(
                    'name' =>'PAP GOLD�������i0:�s���A1:���j',
                    'type' => VAR_TYPE_INT,
                    ),
          'visibleYBP' => array(
                    'name' =>'YBP�������i0:�s���A1:���j',
                    'type' => VAR_TYPE_INT,
                    ),
          'url' => array(
                    'name' =>'�ڍ�URL',
                    'type' => VAR_TYPE_STRING,
                    ),
          'del' => array(
                    'name' =>'�폜�t���O',
                    'type' => VAR_TYPE_INT,
                    ),
	);
}


/**
 *	admin_product_Detail�A�N�V�����̎���
 *
 *	@author		{$author}
 *	@access		public
 *	@package	Dwo
 */
class Dwo_Action_AdminProductDetail extends Ethna_ActionClass
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

	   	if ($this->af->validate() > 0) {
			return 'admin_product_list';
   		}

		$prodCode = $this->af->get("prodCode");
		$productDAO = new ProductDAO();
		$product = $productDAO->findById($prodCode);

		if ($product->itemCd == "") {
			$res = Ethna::raiseNotice('���i�R�[�h�����݂��܂���', E_NEWS_AUTHINVALID );
			$this->ae->addObject(null, $res);

			return 'admin_product_list';
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

			$msg = "�X�V���܂���";
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
