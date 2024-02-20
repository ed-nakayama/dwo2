<?php
/**
 *  Weborder/Basket/Upgradeconfirm.php
 *
 *  @author     {$author}
 *  @package    Dwo
 *  @version    $Id: skel.action.php,v 1.10 2006/11/06 14:31:24 cocoitiban Exp $
 */

/**
 *  weborder_basket_upgrade�t�H�[���̎���
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Form_WeborderBasketUpgradeconfirm extends Dwo_ActionForm
{
    /** @var    bool    �o���f�[�^�Ƀv���O�C�����g���t���O */
    var $use_validator_plugin = true;

    /**
     *  @access private
     *  @var    array   �t�H�[���l��`
     */
    var $form = array(
       'cust_id' => array(
            // �t�H�[���̒�`
            'type'          => VAR_TYPE_INT,    // ���͒l�^
            'name'          => '�g�p�҂̂��q�l�ԍ�',      // �\����
            'required'      => true,            // �K�{�I�v�V����(true/false)
			'required_error'=> '�g�p�҂̂��q�l�ԍ��𐔎��Ő��������͂��Ă�������',
			'type_error'    => '�g�p�҂̂��q�l�ԍ��Ő��������͂��Ă�������',
        ),
        
        'basic_item_cd' => array(
        	'type'          => VAR_TYPE_STRING,    // ���͒l�^
            'name'          => '�w�����i�x�[�V�b�NCD',      // �\����
            'required'      => true,            // �K�{�I�v�V����(true/false)
			'required_error'=> '',
			'type_error'    => '',
        ),
     );
}

/**
 *  webbasket_basket_upgradeconfirm�A�N�V�����̎���
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Action_WeborderBasketUpgradeconfirm extends Dwo_ActionClass
{
    /**
     *  �Z�b�V�����`�F�b�N
     */
	function authenticate()
	{
		if ( !$this->session->isStart() ) {
			return 'weborder_login';
		}
	}

    /**
     *  weborder_basket_upgrade�A�N�V�����̑O����
     *
     *  @access public
     *  @return string      �J�ږ�(����I���Ȃ�null, �����I���Ȃ�false)
     */
    function prepare()
    {
        return null;
    }

    /**
     *  webbasket_basket_upgradeconfirm�A�N�V�����̎���
     *
     *  @access public
     *  @return string  �J�ږ�
     */
    function perform()
    {
		// ���j���[�ݒ�
		$menumanager = new UpgradeMenuManager($this);
		$menumanager->setMenu("basket");
				
		$credit_flag = TRUE;
		$this->session->start();
		
		$basic_item_cd = $this->session->get("basic_item_cd");
		$second_sp_item_cd = $this->session->get("second_sp_item_cd");
		$second_total_sp_item_cd = $this->session->get("second_total_sp_item_cd");
		$month_num = $this->session->get("month_num");
		
		//echo "item_cd=$second_sp_item_cd,$second_total_sp_item_cd<br>";

		//Get CUST_CLASS_INFO
		$agentAry = $this->session->get("agentAry");
		$cust_class_large = $agentAry['largeCode'];
		$cust_class_medium = $agentAry['midCode'];
		$cust_class_small = $agentAry['smallCode'];
		
		//Get ITEM_CLASS_INFO
		$upgrade_item_large = $this->session->get('upgrade_item_large');
		$upgrade_item_medium = $this->session->get('upgrade_item_medium');
		$upgrade_item_small = $this->session->get('upgrade_item_small');
		
		//Get CREDIT_INFO
		$keep_creditinfo = $this->session->get("keep_creditinfo");
		$yuyo = intval($keep_creditinfo["yuyo"]);
		
		//�A�b�v�O���[�h�̉��i�𒲂ׂ�
		$supportprice = new SupportDAO();
		$supportprice = $supportprice->findprice($second_sp_item_cd, $second_total_sp_item_cd);
		
		$support_type = $this->session->get("support_type");

		if ($support_type == "1" && $month_num >= "3" &&  $month_num <= "5") {
			$upgrade_sale_price = 0;
		} elseif ($month_num>=12){
			$upgrade_sale_price = $supportprice['price'];
		} else {
			$upgrade_sale_price = $supportprice['monthly_price'] * $month_num;
		}
		
		$distributiondao = new DistributionViewDAO();
		
		$distribution = $distributiondao->find2($cust_class_large,$cust_class_medium,$upgrade_item_large,$upgrade_item_medium,$upgrade_item_small);
		$list_size = $distribution->size();

		$rate = 100;
		for ($i=0;$i<$list_size;$i++){
			$dist = $distribution->get($i);
			if ($dist->cust_class_small == $cust_class_small){
				if($dist->support_ug_rate != "") {
					if(($rate = $dist->support_ug_rate) > 0) break;	
				}
			}
		} 
		if ($rate == 100){
			for ($i=0;$i<$list_size;$i++){
				$dist = $distribution->get($i);
				if ($dist->cust_class_small == 0){
					if($dist->support_ug_rate != "") {
						$rate = $dist->support_ug_rate;
						if(($rate = $dist->support_ug_rate) > 0) break;
					}
				}
			} 
		}
		
// 2017/05/16 mikami		$upgrade_discount_price = floor($rate*$upgrade_sale_price/100);		
		$upgrade_discount_price = bcmul(strval($upgrade_sale_price), bcdiv(strval($rate), '100', 3), 0);
		
		$upgrade_price = $upgrade_discount_price;
// 2017/05/16 mikami		$upgrade_tax = floor($upgrade_price * DWO_TAX_RATE);
		$upgrade_tax = bcmul(strval($upgrade_price), strval(DWO_TAX_RATE), 0);
		$upgrade_total_price = $upgrade_price + $upgrade_tax; 

		if($rate == 0) $ratezeroflag = TRUE;		
		if ($yuyo < $upgrade_discount_price) $credit_flag = FALSE;

		$this->af->set("creditflag",$credit_flag);
		$this->af->set("ratezeroflag",$ratezeroflag);
		$this->session->set("upgrade_sale_price",$upgrade_sale_price);
		$this->session->set("upgrade_discount_price",$upgrade_discount_price);
		$this->session->set("upgrade_price",$upgrade_price);
		$this->session->set("upgrade_tax",$upgrade_tax);
		$this->session->set("upgrade_total_price",$upgrade_total_price);
		$this->session->set("upgrade_price",$upgrade_price);
		
		//$soft_name = $this->session->get("soft_name");
	
		// ���L�e���v���͂��q�l�o�^������ꍇ��Custinfo/InputDo����CALL����邱�Ƃɒ��ӁB
        return 'weborder_basket_upgradeconfirm';
    }
}
?>
