<?php
/*****************************************************/	
require_once("action/classes/CalendarDAO.class.php"); 
require_once("action/classes/Util.class.php"); 
/*****************************************************/
/**
 *	Admin/Calendar/Map.php
 *
 *	@author		{$author}
 *	@package	Dwo
 *	@version	$Id: Big.php,v 1.1 2006/11/07 06:31:45 nakayama Exp $
 */

/**
 *	admin_Calendar_Map�t�H�[���̎���
 *
 *	@author		{$author}
 *	@access		public
 *	@package	Dwo
 */
class Dwo_Form_AdminCalendarMap extends Ethna_ActionForm
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
          'year' => array(
                    'name' =>'�N',
                    'type' => VAR_TYPE_INT,
                    ),
          'month' => array(
                    'name' =>'��',
                    'type' => VAR_TYPE_INT,
                    ),
          'day' => array(
                    'name' =>'��',
                    'type' => VAR_TYPE_INT,
                    ),
          'set' => array(
                    'name' =>'�x�݃t���O',
                    'type' => VAR_TYPE_INT,
                    ),
	);
}



/**
 *	admin_Calendar_Map�A�N�V�����̎���
 *
 *	@author		{$author}
 *	@access		public
 *	@package	Dwo
 */
class Dwo_Action_AdminCalendarMap extends Ethna_ActionClass
{
	/**
	 *	admin_Calendar_Map�A�N�V�����̑O����
	 *
	 *	@access	public
	 *	@return	string		�J�ږ�(����I���Ȃ�null, �����I���Ȃ�false)
	 */
	function prepare()
	{
    	$this->session->start();
	    $operatorId = $this->session->get("operatorId");
	    $operatorName = $this->session->get("operatorName");


		return null;
	}

	/**
	 *	admin_Calendar_Map�A�N�V�����̎���
	 *
	 *	@access	public
	 *	@return	string	�J�ږ�
	 */
	function perform()
	{
	    $operatorId = $this->session->get("operatorId");
	    $operatorName = $this->session->get("operatorName");

		$year = $this->af->get("year");
		$month = $this->af->get("month");
		$day = $this->af->get("day");
		$set = $this->af->get("set");

		$calDAO = new CalendarDAO();

		if ($day != "") {
			$time = mktime(0 ,0 ,0 ,$month ,$day ,$year);
			$setDate = date("Y-m-d" ,$time);

			$calDAO->update($setDate ,$set);
		}

		if ($year == "") {
			$time = time();

			$days = getdate();
			$year = (int)$days[year];
			$month = (int)$days[mon];
		} else {
			$time = mktime(0 ,0 ,0 ,$month ,1 ,$year);
		}


		//�����̓��t�̐�
		$num = date("t", $time);

		//�J�����_�[��\������
		if($month == 1){
			$preYear = $year - 1;
			$preMonth = 12;
		} else {
			$preYear = $year;
			$preMonth = $month - 1;
		}
		
		if($month == 12){
			$nextYear = $year + 1;
			$nextMonth = 1;
		} else {
			$nextYear = $year;
			$nextMonth = $month + 1;
		}
		
		$startDate = date("Y-m-d" ,mktime(0 ,0 ,0 ,$month ,1 ,$year));
		$endDate = date("Y-m-d" ,mktime(0 ,0 ,0 ,$month ,$num ,$year));
	
		$calList = $calDAO->find($startDate ,$endDate);

		$dayList = "";
		$line = 0;
		//�J�����_�[�̓��t�����
		for($i = 0; $i < $num ;$i++){

			//�j���͐��l
			$day = $i+1;
			$time = mktime(0 ,0 ,0 ,$month ,$day ,$year);
			$w = date("w", $time);
			$dayt = date("Y-m-d" ,$time);
			

			$calOn = "";
			for ($j = 0; $j < $calList->size(); $j++) {
				$cal = $calList->get($j);

				if ($cal->daytime == $dayt) {
					$calOn = 1;
					break;
				}
			}

			//����ڂ̗j�����擾����
			if ($i == 0) {
				//����ڂ̗j����񎦂���܂ł��J��Ԃ�
				for($j= 0 ;$j < $w ;$j++){
					switch ($j) {
					case 0 :
						$dayList[$line]['sun'] = "";
						break;

					case 1 :
						$dayList[$line]['mon'] = "";
						break;

					case 2 :
						$dayList[$line]['tue'] = "";
						break;

					case 3 :
						$dayList[$line]['wed'] = "";
						break;

					case 4 :
						$dayList[$line]['thu'] = "";
						break;

					case 5 :
						$dayList[$line]['fri'] = "";
						break;

					case 6 :
						$dayList[$line]['sat'] = "";
						$line++;
						break;
					}
				}
			}

			switch ($w) {
				case 0 :
					$dayList[$line]['sun'] = $i + 1;
					$dayList[$line]['sunOn'] = $calOn;
					break;

				case 1 :
					$dayList[$line]['mon'] = $i + 1;
					$dayList[$line]['monOn'] = $calOn;
					break;

				case 2 :
					$dayList[$line]['tue'] = $i + 1;
					$dayList[$line]['tueOn'] = $calOn;
					break;

				case 3 :
					$dayList[$line]['wed'] = $i + 1;
					$dayList[$line]['wedOn'] = $calOn;
					break;

				case 4 :
					$dayList[$line]['thu'] = $i + 1;
					$dayList[$line]['thuOn'] = $calOn;
					break;

				case 5 :
					$dayList[$line]['fri'] = $i + 1;
					$dayList[$line]['friOn'] = $calOn;
					break;

				case 6 :
					$dayList[$line]['sat'] = $i + 1;
					$dayList[$line]['satOn'] = $calOn;
					$line++;
					break;
			}
		}

		$this->af->set("year" ,$year);
		$this->af->set("month" ,$month);
		$this->af->set("preYear" ,$preYear);
		$this->af->set("preMonth" ,$preMonth);
		$this->af->set("nextYear" ,$nextYear);
		$this->af->set("nextMonth" ,$nextMonth);
		$this->af->set("dayList" ,$dayList);
		$this->af->set("dayList" ,$dayList);

		return 'admin_calendar_map';

	}


}

?>
