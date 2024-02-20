<?php

namespace App\Http\Controllers\Classes;

use App\Models\ORDER_HDR;

class WebOrderHeaderDAO {

	public $his_web_order_num;
	public $his_direct_delivery_type;
	public $his_dest_name1;
	public $his_dwo_order_person_name;
	public $his_item_cd;
	public $his_state_type;
	public $util;

	function __construct() {
		$this->his_web_order_num = "";
		$this->his_direct_delivery_type = "";
		$this->his_dest_name1 = "";
		$this->his_dwo_order_person_name = "";
		$this->his_item_cd = "";
		$this->his_state_type = "";

		$this->util = new Util();
	}

 /*************************************************************
 * 与信算出で必要な未取り込みの合計金額を取得
 *
 * 利用ファイル
 *   classes/CreditInfoManager.php GetCreditDataByCustCode()
 ***************************************************************/
    public function findTempCredit($custNum) {

		$total_amt = ORDER_HDR::where('cust_num' ,$custNum)
			->whereIn('state_type', [0,1,4,8,9]) // 受付中、出荷手配済み、承認待ち、予約受付中、予約承認待ち
			->where('input_type', '0')
			->where('cust_del_type', '0')
			->where('operator_del_type', '0')
			->sum('total_amt');
		
        return $total_amt;
	}


 /*************************************************************
 * 条件検索
 *
 * 利用ファイル
 *   weborder/top/TopCondition.php index()
 *   weborder/top/TopPassedit.php index()
 ***************************************************************/
    public function findLastUpdate($custNum) {

		$list = ORDER_HDR::where('cust_num' , $custNum)
			->selectRaw("TO_CHAR(MAX(DWO_LAST_UPDATE), 'YYYY-MM-DD HH24:MI:SS') AS DWO_LAST_UPDATE")
			->first();
		
		$lastdate = $list->dwo_last_update;


        return $lastdate;
    }


 /*************************************************************
 * 条件検索
 *
 * 利用ファイル
 *   admin/Order/OrderList2Detail.php store()
 *   classes/AcceptanceManager.php demandMail()
 *   classes/UpgradeAcceptanceManager.php demandMail()
 *   classes/OrderPrintview.php viewer()
 *   classes/OrderUpgradeprint.php viewer()
 *   weborder/top/TopHistory.php mail_do()
 ***************************************************************/
    public function find($orderNum) {

		$weborderHeader = ORDER_HDR::where('web_order_num' , $orderNum)
			->first();

        return $weborderHeader;
    }


 /*************************************************************
 * 新規登録
 *
 * 利用ファイル
 ***************************************************************/
    public function insert($list) {

		$header = new ORDER_HDR();
		
		$header->web_order_num           = $list->web_order_num;
		$header->main_web_order_num      = $list->main_web_order_num;
		$header->contents_type           = $list->contents_type;
		$header->origin_type             = $list->origin_type;
		$header->web_operator_cd         = $list->web_operator_cd;
		$header->order_date              = $list->order_date;
		$header->new_cust_type           = $list->new_cust_type;
		$header->account_num             = $list->account_num;
		$header->cust_num                = $list->cust_num;
		$header->pay_type                = $list->pay_type;
		$header->settle_type             = $list->settle_type;
		$header->billed_type             = $list->billed_type;
		$header->item_spread_cd          = $list->item_spread_cd;
		$header->campaign_cd             = $list->campaign_cd;
		$header->user_account_num        = $list->user_account_num;
		$header->user_cust_num           = $list->user_cust_num;
		$header->secondary_account_num   = $list->secondary_account_num;
		$header->secondary_cust_num      = $list->secondary_cust_num;
		$header->agreement_type          = $list->agreement_type;
		$header->support_sametime_type   = $list->support_sametime_type;
		$header->support_continue_type   = $list->support_continue_type;
		$header->appoint_type            = $list->appoint_type;
		$header->double_package_type     = $list->double_package_type;
		$header->delivery_date_type      = $list->delivery_date_type;
		$header->delivery_date           = $list->delivery_date;
		$header->delivery_time_type      = $list->delivery_time_type;
		$header->direct_delivery_type    = $list->direct_delivery_type;
		$header->pd_cd                   = $list->pd_cd;
		$header->cust_order_num          = $list->cust_order_num;
		$header->deliver_memo            = $list->deliver_memo;
		$header->remarks_type            = $list->remarks_type;
		$header->remarks1                = $list->remarks1;
		$header->remarks2                = $list->remarks2;
		$header->linage                  = $list->linage;
		$header->order_amt               = $list->order_amt;
		$header->tax                     = $list->tax;
		$header->total_amt               = $list->total_amt;
		$header->tax_rate                = $list->tax_rate;
		$header->dest_name_kana1         = $list->dest_name_kana1;
		$header->dest_name_kana2         = $list->dest_name_kana2;
		$header->dest_name1              = $list->dest_name1;
		$header->dest_name2              = $list->dest_name2;
		$header->dest_post               = $list->dest_post;
		$header->dest_pref_cd            = $list->dest_pref_cd;
		$header->dest_address1           = $list->dest_address1;
		$header->dest_address2           = $list->dest_address2;
		$header->dest_address3           = $list->dest_address3;
		$header->dest_tel                = $list->dest_tel;
		$header->dest_fax                = $list->dest_fax;
		$header->dest_contact_name_kana1 = $list->dest_contact_name_kana1;
		$header->dest_contact_name_kana2 = $list->dest_contact_name_kana2;
		$header->dest_contact_name1      = $list->dest_contact_name1;
		$header->dest_contact_name2      = $list->dest_contact_name2;
		$header->dest_contact_department = $list->dest_contact_department;
		$header->dest_contact_title      = $list->dest_contact_title;
		$header->card_company_cd         = $list->card_company_cd;
		$header->card_num                = $list->card_num;
		$header->card_good_thru          = $list->card_good_thru;
		$header->card_name               = $list->card_name;
		$header->name_kana1              = $list->name_kana1;
		$header->name_kana2              = $list->name_kana2;
		$header->name1                   = $list->name1;
		$header->name2                   = $list->name2;
		$header->president_name_kana1    = $list->president_name_kana1;
		$header->president_name_kana2    = $list->president_name_kana2;
		$header->president_name1         = $list->president_name1;
		$header->president_name2         = $list->president_name2;
		$header->post                    = $list->post;
		$header->prefecture_cd           = $list->prefecture_cd;
		$header->address1                = $list->address1;
		$header->address2                = $list->address2;
		$header->address3                = $list->address3;
		$header->tel                     = $list->tel;
		$header->fax                     = $list->fax;
		$header->communicate_tel         = $list->communicate_tel;
//		$header->mail_address            = $list->mail_address;
		$header->url                     = $list->url;
		$header->accountant_type         = $list->accountant_type;
		$header->contact_name_kana1      = $list->contact_name_kana1;
		$header->contact_name_kana2      = $list->contact_name_kana2;
		$header->contact_name1           = $list->contact_name1;
		$header->contact_name2           = $list->contact_name2;
		$header->contact_department      = $list->contact_department;
		$header->contact_title           = $list->contact_title;
		$header->license_mail_address    = $list->license_mail_address;
		$header->dm_non                  = $list->dm_non;
		$header->tel_non                 = $list->tel_non;
		$header->fax_non                 = $list->fax_non;
		$header->mail_non                = $list->mail_non;
		$header->inform_support_non      = $list->inform_support_non;
		$header->inform_seminar_non      = $list->inform_seminar_non;
		$header->inform_product_non      = $list->inform_product_non;
		$header->serial_num              = $list->serial_num;
		$header->drs_vol                 = $list->drs_vol;
		$header->input_type              = $list->input_type;
		$header->input_timestamp         = $list->input_timestamp;
		$header->error_type              = $list->error_type;
		$header->error_msg               = $list->error_msg;
		$header->cust_del_type           = $list->cust_del_type;
		$header->operator_del_type       = $list->operator_del_type;
		$header->shipping_date           = $list->shipping_date;
		$header->dest_cd                 = $list->dest_cd;
		$header->state_type              = $list->state_type;
		$header->dwo_order_person_name   = $list->dwo_order_person_name;
		$header->cust_class_large        = $list->cust_class_large;
		$header->cust_class_medium       = $list->cust_class_medium;
		$header->cust_class_small        = $list->cust_class_small;
		$header->present_type            = $list->present_type;
		$header->present_contents_type   = $list->present_contents_type;
		$header->support_campaign_type   = $list->support_campaign_type;	// 弥生１３対応 2012/10/31
		$header->careful_flag            = $list->careful_flag;				// 厳選・非厳選フラグ 2012/11/13
		
		$header->save();
		
        return;

    }


 /*************************************************************
 * 更新 state_typeが4:承認待ち、9:予約承認待ちのものを更新するよう条件付き
 *
 * 利用ファイル
 *   weborer/Recognize/RecognizeTop.php  do()
 ***************************************************************/
    function updateStatusPreChk($web_order_num, $order_status_id) {


		$tmp_agreement = "0";
		// 承認
		if ($order_status_id == "0" || $order_status_id == "8") {
			$tmp_agreement = "1"; // 使用者承諾済み区分
		}

		$order = ORDER_HDR::where('web_order_num', $web_order_num)
			->whereIn('state_type' ,[4, 9])
			->first();
		
		if (!empty($order)) {
			$order->state_type = $order_status_id;
			$order->agreement_type = $tmp_agreement;

			$order->save();
		}

        return;

    }

 /*************************************************************
 * 更新 バッチ用
 *
 * 利用ファイル
 *   classes/AcceptanceManager.php Cancel()
 *   classes/UpgradeAcceptanceManager.php Cancel()
 ***************************************************************/
    public function updateStatusForBatch($web_order_num) {

		$order = ORDER_HDR::where('web_order_num', $web_order_num)
			->where('cust_del_type' ,'0')
			->where('operator_del_type' ,'0')
			->where('input_type' ,'0')
			->whereIn('state_type' ,[4, 9])
			->first();

		if (!empty($order)) {
			$order->state_type = 7;
			$order->cust_del_type = 1;
			$order->dwo_ship_status_update = \DB::raw('sysdate');
		
			$order->save();
		}

        return;

    }

 /*************************************************************
 * 15:00の出荷手配中にステータス更新 バッチ用
 *
 * 利用ファイル
 *   admin/Batch/BatchConf.php closing()
 ***************************************************************/
    public function updateShippingStatusForBatch() {

		$ORDER_HDR = config('dwo.ORDER_HDR');
		
	    $sql  = "UPDATE $ORDER_HDR ";
        $sql .= "   SET STATE_TYPE = 1"; // 
        $sql .= "       ,DWO_SHIP_STATUS_UPDATE = SYSDATE"; // バッチ更新日
        $sql .= " WHERE CUST_DEL_TYPE = '0'";
        $sql .= "   AND OPERATOR_DEL_TYPE = '0'";
        $sql .= "   AND INPUT_TYPE = '0'"; // 取り込み区分が未:0
        $sql .= "   AND STATE_TYPE = 0"; // 0:受付け中のみ

		\DB::update($sql);

        return;
    }

 
 /*************************************************************
 * 15:00の出荷手配中にステータス更新 バッチ用
 * 受注ステータスが「予約受付中」のものが対象で、
 * 注文商品の在庫状況が「在庫あり」になっている場合のみ更新されます。
 *
 * 利用ファイル
 *   admin/Batch/BatchConf.php closing()
 ***************************************************************/
    public function updateStatusReserve2ShippingForBatch() {

		$ORDER_HDR = config('dwo.ORDER_HDR');
		$ORDER_DTL = config('dwo.ORDER_DTL');

		$sql  = "UPDATE $ORDER_HDR " .
					" SET state_type = 1," .
						" dwo_ship_status_update = SYSDATE" .
					" WHERE web_order_num IN" .
						" (SELECT h.web_order_num" .
							" FROM $ORDER_DTL d," .
								" $ORDER_HDR h," .
								" dwo_product_mt p" .
							" WHERE d.web_order_num = h.web_order_num AND" .
								" d.item_cd = p.product_code AND" .
								" d.order_line_num = 1 AND" .
								" h.operator_del_type = '0' AND" .
								" h.input_type = '0' AND" .
								" h.state_type = 8 AND" .
								" p.product_status_id = 1 AND" .
								" p.product_ship_date IS NULL" .
						")";

		\DB::update($sql);

        return;
    }


 /*************************************************************
 * 得意先からの削除
 *
 * 利用ファイル
 *   weborder/top/TopHistory2deleteDo.php  index()
 ***************************************************************/
    public function deleteOrder($web_order_num) {

		$order = ORDER_HDR::find($web_order_num);

		if (!empty($order)) {
			$order->cust_del_type = 1;
			$order->save();
		}

        return;
    }


 /*************************************************************
 * 管理からの削除
 *
 * 利用ファイル
 *   classes/OrderRegistManager.php setAcceptanceData()
 ***************************************************************/
    public function deleteOrderAdmin($web_order_num) {

		$order = ORDER_HDR::find($web_order_num);

		if (!empty($order)) {
			$order->operator_del_type = 1;
			$order->save();
		}

        return;
    }


 /*************************************************************
 * メールアドレス更新
 *
 * 利用ファイル
 *   weborder/top/TopHistory.php mail_do()
 ***************************************************************/
    public function updateMailAddress($web_order_num, $old_mail_addr, $new_mail_addr) {

		$order = ORDER_HDR::where('web_order_num', $web_order_num)
			->where('license_mail_address' ,$old_mail_addr)
			->first();

		if (!empty($order)) {
			$order->license_mail_address = $new_mail_addr;
			$order->save();
		}

        return;

    }


 /*************************************************************
 * 条件検索 顧客番号から履歴を検索用 必要なカラムのみ取得
 *
 * 利用ファイル
 *   weborder/top/TopHistory.php search()
 ***************************************************************/
    public function findHistory2($custNum ,$oldestDate = "" ,$param) {

		$ORDER_HDR = config('dwo.ORDER_HDR');
		$ORDER_DTL = config('dwo.ORDER_DTL');

        $sql  = "select * ";
        $sql .= "from ";
        $sql .= "( ";
        $sql .= "SELECT ROW_NUMBER() OVER (ORDER BY WEB_ORDER_NUM DESC) RNO ,X.* ";
        $sql .= "from (  ";
        $sql .= "SELECT DISTINCT H.WEB_ORDER_NUM";
        $sql .= "       ,TO_CHAR(H.DWO_LAST_UPDATE, 'YYYY-MM-DD HH24:MI:SS') AS DWO_LAST_UPDATE";
        $sql .= "       ,H.DELIVERY_DATE_TYPE";
        $sql .= "       ,H.DEST_NAME1";
        $sql .= "       ,H.DEST_NAME2";
        $sql .= "       ,H.DWO_ORDER_PERSON_NAME";
        $sql .= "       ,H.STATE_TYPE";
        $sql .= "       ,C.RETI_STATE_TYPE";
        $sql .= "       ,C. CC_HEADER_DEL_TYPE";
        $sql .= "  FROM ";

        $sql .= "       (select O.WEB_ORDER_NUM ,O.DEL_TYPE as CC_HEADER_DEL_TYPE ,R.RETI_STATE_TYPE ";
        $sql .= "        from (select ORDER_NUM ,RETI_STATE_TYPE FROM T_RETI_HDR WHERE RETI_STATE_TYPE = '2' AND DEL_TYPE='0') R ,T_CC_ORDER_HDR O ";
        $sql .= "        where O.WEB_OPERATOR_CD = 'DWO' ";
        $sql .= "          and O.ORDER_NUM = R.ORDER_NUM(+) ";
        $sql .= "       ) C ";

        $sql .= "      , $ORDER_DTL D , $ORDER_HDR  H ";
        $sql .= " WHERE H.WEB_ORDER_NUM = D.WEB_ORDER_NUM";
        $sql .= "   AND H.CUST_NUM = " . $custNum;
        $sql .= "   AND H.CONTENTS_TYPE IN ('40', '80', '81', '82', '54', '55')";
        $sql .= "   AND H.CUST_DEL_TYPE = '0'";
        $sql .= "   AND H.OPERATOR_DEL_TYPE = '0'";
//        $sql .= "   AND H.INPUT_TYPE = '0'";
        $sql .= "   AND (H.ERROR_TYPE IS NULL OR H.ERROR_TYPE = '0')";
         // 受付中、出荷手配済み、承認待ち、予約受付中、予約承認待ち <-- この条件をはずせば全ステータスを表示できる。
        $sql .= "   AND H.STATE_TYPE IN (0, 1, 4, 8, 9)";

		if (isset($param['frm_web_order_num'])) {
	        $sql .= "   AND H.WEB_ORDER_NUM = " . $param['frm_web_order_num'];
		}
		
		if (isset($param['frm_from_date']) && ($param['frm_from_date'] > $oldestDate)) {
	        $sql .= "   AND H.DWO_LAST_UPDATE >= to_date('" . $param['frm_from_date'] . " 00:00:00','YYYY-MM-DD HH24:MI:SS') ";
		} else {
	        $sql .= "   AND H.DWO_LAST_UPDATE >= to_date('" . $oldestDate . "','YYYY-MM-DD') ";
		}

		if (isset($param['frm_to_date'])) {
	        $sql .= "   AND H.DWO_LAST_UPDATE <= to_date('" . $param['frm_to_date'] . " 23:59:59','YYYY-MM-DD HH24:MI:SS') ";
		}
		
		if (isset($param['frm_direct_delivery_type'])) {
	        $sql .= "   AND H.DIRECT_DELIVERY_TYPE = " . $param['frm_direct_delivery_type'];
		}

		if (isset($param['frm_dest_name1'])) {
	        $sql .= "   AND H.DEST_NAME1 like '%{$param['frm_dest_name1']}%' ";
	        $sql .= "   AND H.DIRECT_DELIVERY_TYPE = '1'";
		}

		if (isset($param['frm_dwo_order_person_name'])) {
	        $sql .= "   AND H.DWO_ORDER_PERSON_NAME like '%{$param['frm_dwo_order_person_name']}%' ";
		}

		if (isset($param['frm_state_type'])) {
	        $sql .= "   AND H.STATE_TYPE = " . $param['frm_state_type'];
		}
		
		if (isset($param['frm_item_cd'])) {
	        $sql .= "   AND D.ITEM_CD = '" . $param['frm_item_cd'] . "'";
		}
		
        $sql .= "   AND H.WEB_ORDER_NUM = C.WEB_ORDER_NUM(+)";


        $sql .= " ORDER BY WEB_ORDER_NUM DESC ";

        $sql .= ") X ";
        $sql .= ") ";

//dd($sql);
		$pagination = $this->util->pagination($sql ,20);

        return $pagination;

    }


 /*************************************************************
 * 条件検索
 *
 * 利用ファイル
 *   weboder/top/TopHistory.php detail()
 ***************************************************************/
    public function find2($orderNum) {

		$ORDER_HDR = config('dwo.ORDER_HDR');

        $sql = "SELECT H.*   ,C.RETI_STATE_TYPE ,C.DISTRI_RETI_TOTAL_AMT ";
        $sql .= "   ,TO_CHAR(DWO_LAST_UPDATE, 'YYYY-MM-DD HH24:MI:SS') AS DWO_LAST_UPDATE2 ";
        $sql .= "   ,CASE WHEN SHIPPING_DATE IS NULL THEN '' ELSE TO_CHAR(TO_DATE(SHIPPING_DATE,'YYYYMMDD'),'YYYY-MM-DD') END AS SHIPPING_DATE2 ";

        $sql .= "  FROM ";
        $sql .= "       (select O.WEB_ORDER_NUM ,O.DEL_TYPE as CC_HEADER_DEL_TYPE ,R.RETI_STATE_TYPE ,R.DISTRI_RETI_TOTAL_AMT  ";
        $sql .= "        from (select ORDER_NUM ,RETI_STATE_TYPE ,DISTRI_RETI_TOTAL_AMT FROM T_RETI_HDR WHERE RETI_STATE_TYPE = '2' AND DEL_TYPE='0') R ,T_CC_ORDER_HDR O ";
        $sql .= "        where O.WEB_OPERATOR_CD = 'DWO' ";
        $sql .= "          and O.ORDER_NUM = R.ORDER_NUM(+) ";
        $sql .= "       ) C ";

        $sql .= "      , $ORDER_HDR H ";
        $sql .= " WHERE H.WEB_ORDER_NUM = " . $orderNum;
        $sql .= "   AND H.WEB_ORDER_NUM = C.WEB_ORDER_NUM(+)";


		$list = '';
		$dataList = \DB::select($sql);
		if (isset($dataList[0])) {
			$list = $dataList[0];
		}

        return $list;
    }


}
