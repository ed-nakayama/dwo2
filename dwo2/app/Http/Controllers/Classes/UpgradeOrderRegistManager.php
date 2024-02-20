<?php

namespace App\Http\Controllers\Classes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Models\ORDER_HDR;
use App\Models\ORDER_DTL;
use App\Models\OrderAcceptance;

use App\Mail\Syonin;
use App\Mail\OrderReport;
use App\Mail\ReserveOrderReport;

class UpgradeOrderRegistManager {

	private $orderSeq;
	private $callAction;          // 呼び出しアクション
	private $mySession;
	private $regDate; // YYYYMMDD
	private $regDateY; // YYYY
	private $regDateM; // MM
	private $regDateD; // DD
	private $syonin_id;
	private $acceptance_seq;

	private $basketsession;    // バスケットセッション(セッションから)
	private $orderinfosession; // オーダー情報(セッションから)
	private $agentInfo;        // AgentViewクラス配列(セッションから)
	private $dwo_profile;      // DWO顧客情報 メアド、メールフラグ取得用

	private $reg_weborderheader; // WebOrderHeaderクラス用
	private $reg_weborderdetail; // WebOrderDetailクラス用
	private $reg_orderacceptance;    // OrderAcceptanceクラス用
	private $orderinfo = null;

	private $cancelDate;

	/*
	 * コンストラクタ
	 * 引数: 呼び出しクラス
	 */
	function __construct($paramAction) {
		$this->callAction = $paramAction;
		$this->mySession = $paramAction->session;
		$this->mySession->start();

		$this->regDateY = date("Y");
		$this->regDateM = date("m");
		$this->regDateD = date("d");
		$this->regDate = $this->regDateY.$this->regDateM.$this->regDateD; //date("Ymd");
		
		// セッション情報チェック
		$this->basketsession = new BasketSession($this->mySession);
		$this->orderinfosession = new UpgradeorderinfoSession($this->mySession);
		$this->agentInfo     = $this->mySession->get("agentAry"); // Array
		$this->dwo_profile = $this->mySession->get("keep_dwo_profile"); // Array


		$calendarmtdao = new CalendarMtDAO();
		$cancelDay = $calendarmtdao->dayFromLastDay(1);

		$this->cancelDate = $this->regDateY . "-" . $this->regDateM  . "-" . sprintf('%02d', $cancelDay);

	}

	/*
	 * 受注番号の取得
	 */
    function getOrderSeq() {
		$orderseqdao = new OrderSeqDAO();
        return $orderseqdao->findOrderSeq();
    }

	// セッションから登録用データのセット
    function setorderinfo() {
		$this->orderinfo = $this->orderinfosession->get();
		// 前処理
		$second_flg = $this->mySession->get('secondflag');

		if ($this->basketsession->isReserveMode()) {
			$ship = $this->basketsession->getReserveShippingDate();
			$ship = str_replace("-", "", $ship);
		} else {
			$calendarmtdao = new CalendarMtDAO();
			$ship = $calendarmtdao->getShippingDate();
			$ship = str_replace("/", "", $ship);
		}

		// 二重梱包区分か直送区分が1なら指定区分を立てる
		// 厳密には二重梱包区分～直送区分のどれかが1の場合
		$tmp_appoint_type = "0";

		$this->reg_weborderheader = new WebOrderHeader();
		
		// 登録用WebOrderHeaderクラス変数にセッションから値をセット
		$this->reg_weborderheader->web_order_num          = $this->orderSeq; // ＷＥＢ受注番号
		$this->reg_weborderheader->main_web_order_num     = $this->orderSeq; // 親ＷＥＢ受注番号
		$this->reg_weborderheader->contents_type          = $this->getContentsType();
		$this->reg_weborderheader->origin_type            = "1"; // ＷＥＢ作成元区分(固定)
		$this->reg_weborderheader->web_operator_cd        = "DWO"; // ＷＥＢオペレータコード(無条件セット)
		$this->reg_weborderheader->order_date             = $this->regDate; // 受注日
		$this->reg_weborderheader->new_cust_type          = "0"; // 新規顧客区分(固定)
		$this->reg_weborderheader->account_num            = $this->agentInfo['accountNum']; // お客様番号
		$this->reg_weborderheader->cust_num               = $this->agentInfo['custCode'  ]; // 顧客番号
		$this->reg_weborderheader->pay_type               = "01"; // 支払区分(固定)
		$this->reg_weborderheader->settle_type            = "01"; // 決済区分(固定)
		$this->reg_weborderheader->billed_type            = "02"; // 請求区分(固定)
		$this->reg_weborderheader->item_spread_cd         = ""; // セット商品コード(不要)

		//$this->reg_weborderheader->campaign_cd            = ""; // キャンペーンコード
		
		$this->reg_weborderheader->user_account_num       = $this->mySession->get('cust_id' ); // 使用者お客様番号  DWOでは常に新規なのでnull
		$this->reg_weborderheader->user_cust_num          = $this->mySession->get('cust_num'); // 使用者顧客番号 DWOでは常に新規なのでnull
		$this->reg_weborderheader->secondary_account_num  = ($second_flg)?$this->mySession->get('secondary_account_num'):""; // ２次店お客様番号 オリコンの場合PAPのお客様番号
		$this->reg_weborderheader->secondary_cust_num     = ($second_flg)?$this->mySession->get('secondary_cust_num'):""; // ２次店顧客番号   オリコンの場合PAPの番号

		$this->reg_weborderheader->agreement_type         = "0"; // 使用者承諾済区分(ユーザー承諾後に1)
		$this->reg_weborderheader->support_sametime_type  = "0"; // サポート同時登録区分(固定)
		$this->reg_weborderheader->support_continue_type  = "0"; // サポート自動継続区分(固定)
		$this->reg_weborderheader->appoint_type           = "0"; // 指定有無区分(条件判定)
		$this->reg_weborderheader->double_package_type    = "0"; // 二重梱包区分 - Quang 2010/11/01
		$this->reg_weborderheader->delivery_date_type     = "0"; // 着日指定区分
		$this->reg_weborderheader->delivery_date          = ""; // 着日
		$this->reg_weborderheader->delivery_time_type     = "0"; // AM指定区分
		$this->reg_weborderheader->direct_delivery_type   = "0"; // 直送区分-Quang 2010/11/01

		$this->reg_weborderheader->pd_cd                  = "00001"; // 出荷場コード

		$this->reg_weborderheader->cust_order_num         = $this->getCustOrderNum(); // 顧客発注番号
		$this->reg_weborderheader->deliver_memo           = $this->orderinfo->remarks; // 納品書メモ欄

		if (($this->reg_weborderheader->direct_delivery_type == 1) && ($this->reg_weborderheader->deliver_memo == "")) {
			$this->reg_weborderheader->deliver_memo = $this->orderinfo->delivery_name;
		}

		$this->reg_weborderheader->remarks_type           = "0"; // 備考有無区分
		$this->reg_weborderheader->remarks1               = ""; // 備考１
		$this->reg_weborderheader->remarks2               = ""; // 備考２
		$this->reg_weborderheader->linage                 = "1"; // 明細行数
		$this->reg_weborderheader->order_amt              = $this->mySession->get('upgrade_price'); // 受注合計金額
		$this->reg_weborderheader->tax                    = $this->mySession->get('upgrade_tax'); // 消費税金額
		$this->reg_weborderheader->total_amt              = $this->mySession->get('upgrade_price')+$this->mySession->get('upgrade_tax'); // 総合計
		$this->reg_weborderheader->tax_rate               = $this->basketsession->getTaxRate(); // 税率
/*
		$this->reg_weborderheader->dest_name_kana1        = ""; // 届先名カナ１
		$this->reg_weborderheader->dest_name_kana2        = ""; // 届先名カナ２
		$this->reg_weborderheader->dest_name1             = mb_substr($this->orderinfo->delivery_name,0, 16); // 届先名１
		$this->reg_weborderheader->dest_name2             = (mb_strlen($this->orderinfo->delivery_name) > 16)?mb_substr($this->orderinfo->delivery_name,16):""; // 届先名２
		$this->reg_weborderheader->dest_post              = $this->orderinfo->delivery_zip; // 届先郵便番号
		$this->reg_weborderheader->dest_pref_cd           = $this->orderinfo->delivery_pref_cd; // 届先都道府県コード
		$this->reg_weborderheader->dest_address1          = $this->orderinfo->delivery_add1; // 届先住所１
		$this->reg_weborderheader->dest_address2          = $this->orderinfo->delivery_add2; // 届先住所２
		$this->reg_weborderheader->dest_address3          = $this->orderinfo->delivery_add3; // 届先住所３
		$this->reg_weborderheader->dest_tel               = $this->orderinfo->delivery_tel1."-".$this->orderinfo->delivery_tel2."-".$this->orderinfo->delivery_tel3; // 届先電話番号
		$this->reg_weborderheader->dest_fax               = ($this->orderinfo->delivery_fax1!="") ? ($this->orderinfo->delivery_fax1."-".$this->orderinfo->delivery_fax2."-".$this->orderinfo->delivery_fax3) :""; // 届先FAX番号
		$this->reg_weborderheader->dest_contact_name_kana1= ""; // 届先担当者名カナ１
		$this->reg_weborderheader->dest_contact_name_kana2= ""; // 届先担当者名カナ２
		$this->reg_weborderheader->dest_contact_name1     = $this->orderinfo->delivery_name_of_charge; // 届先担当者名１
		$this->reg_weborderheader->dest_contact_name2     = ""; // 届先担当者名２
		$this->reg_weborderheader->dest_contact_department= ""; // 届先担当者部署
		$this->reg_weborderheader->dest_contact_title     = ""; // 届先担当者役職
*/
		//$this->reg_weborderheader->card_company_cd        = ""; // カード会社コード
		//$this->reg_weborderheader->card_num               = ""; // カード番号
		//$this->reg_weborderheader->card_good_thru         = ""; // カード有効期限
		//$this->reg_weborderheader->card_name              = ""; // カード名義

		$this->reg_weborderheader->name_kana1             = $this->orderinfo->regist_kana; // 顧客名カナ１
		$this->reg_weborderheader->name_kana2             = ""; // 顧客名カナ２
		$this->reg_weborderheader->name1                  = mb_substr($this->orderinfo->regist_name,0, 16); // 顧客名１
		$this->reg_weborderheader->name2                  = ""; /*(mb_strlen($this->orderinfo->regist_name) > 16)?mb_substr($this->orderinfo->regist_name,16):"";*/ // 顧客名２ Quang 2010/11/04
		$this->reg_weborderheader->president_name_kana1   = $this->orderinfo->regist_ceo_kana; // 代表者名カナ１
		$this->reg_weborderheader->president_name_kana2   = ""; // 代表者名カナ２
		$this->reg_weborderheader->president_name1        = $this->orderinfo->regist_ceo; // 代表者名１
		$this->reg_weborderheader->president_name2        = ""; // 代表者名２
		$this->reg_weborderheader->post                   = $this->orderinfo->regist_zip1.$this->orderinfo->regist_zip2; // 郵便番号
		$this->reg_weborderheader->prefecture_cd          = $this->orderinfo->regist_pref_cd; // 都道府県コード
		$this->reg_weborderheader->address1               = $this->orderinfo->regist_add1; // 住所１
		$this->reg_weborderheader->address2               = $this->orderinfo->regist_add2; // 住所２
		$this->reg_weborderheader->address3               = $this->orderinfo->regist_add3; // 住所３
		$this->reg_weborderheader->tel                    = ($this->orderinfo->regist_tel1!="")?($this->orderinfo->regist_tel1."-".$this->orderinfo->regist_tel2."-".$this->orderinfo->regist_tel3):""; // 電話番号
		$this->reg_weborderheader->fax                    = ($this->orderinfo->regist_contact_fax1!="") ? ($this->orderinfo->regist_contact_fax1."-".$this->orderinfo->regist_contact_fax2."-".$this->orderinfo->regist_contact_fax3):""; // FAX番号
		$this->reg_weborderheader->communicate_tel        = ($this->orderinfo->regist_contact_tel1!="") ? ($this->orderinfo->regist_contact_tel1."-".$this->orderinfo->regist_contact_tel2."-".$this->orderinfo->regist_contact_tel3):""; // 連絡先電話番号
		$this->reg_weborderheader->mail_address           = $this->orderinfo->regist_mail; // お客様メールアドレス　※実際はデータベースの「License_mail_address」である 
		$this->reg_weborderheader->url                    = $this->orderinfo->regist_url; // URL

		//$this->reg_weborderheader->accountant_type        = ""; // 会計士税理士区分

		$this->reg_weborderheader->contact_name_kana1     = $this->orderinfo->regist_name_of_charge_kana; // 担当者名カナ１
		$this->reg_weborderheader->contact_name_kana2     = ""; // 担当者名カナ２
		$this->reg_weborderheader->contact_name1          = $this->orderinfo->regist_name_of_charge; // 担当者名１
		$this->reg_weborderheader->contact_name2          = ""; // 担当者名２

		//$this->reg_weborderheader->contact_department     = ""; // 部署
		//$this->reg_weborderheader->contact_title          = ""; // 役職
		//$this->reg_weborderheader->license_mail_address   = ""; // ユーザーライセンスメールアドレス
		//$this->reg_weborderheader->dm_non                 = ""; // ＤＭ不可
		//$this->reg_weborderheader->tel_non                = ""; // ＴＥＬ不可
		//$this->reg_weborderheader->fax_non                = ""; // ＦＡＸ不可
		//$this->reg_weborderheader->mail_non               = ""; // メール不可
		//$this->reg_weborderheader->inform_support_non     = ""; // サポート案内不可
		//$this->reg_weborderheader->inform_seminar_non     = ""; // セミナー案内不可
		//$this->reg_weborderheader->inform_product_non     = ""; // 新製品案内不可
		//$this->reg_weborderheader->serial_num             = ""; // シリアル番号
		//$this->reg_weborderheader->drs_vol                = ""; // ＤＲＳ追加容量

		$this->reg_weborderheader->input_type             = "0"; // 取込区分(固定)

		//$this->reg_weborderheader->input_timestamp        = ""; // 取込日時
		//$this->reg_weborderheader->error_type             = ""; // エラー区分
		//$this->reg_weborderheader->error_msg              = ""; // エラー内容

		$this->reg_weborderheader->cust_del_type          = "0"; // 得意先用削除区分(固定)
		$this->reg_weborderheader->operator_del_type      = "0"; // 担当者用削除区分(固定)
		$this->reg_weborderheader->shipping_date          = ""; // 出荷予定日
		$this->reg_weborderheader->dest_cd                = ""; // 納品先コード
		$this->reg_weborderheader->state_type             = $this->getOrderStatusId();
		$this->reg_weborderheader->dwo_order_person_name  = $this->orderinfo->order_tantou_name; // DWO貴社発注担当者

		$this->reg_weborderheader->cust_class_large       = ($this->orderinfo->cust_regist_flg == 1) ? "01" : ""; // 顧客区分コード
		$this->reg_weborderheader->cust_class_medium      = ""; // 取引先形態コード
		$this->reg_weborderheader->cust_class_small       = ""; // 取引先別区分コード

//		$this->reg_weborderheader->present_type           = "2"; // プレゼント有無区分 Quang 2010/11/01
//		$this->reg_weborderheader->present_contents_type  = ""; // プレゼント内容区分 Quang 2010/11/01
		
		// 厳選・非厳選フラグ 2012/11/13
		if ($this->agentInfo['custGroup2'] == '430'
		 || $this->agentInfo['custGroup2'] == '436'
		 || $this->agentInfo['custGroup2'] == '454'
		 || $this->agentInfo['custGroup2'] == '458'
		 || $this->agentInfo['custGroup2'] == '460'
		 || $this->agentInfo['custGroup2'] == '464') {
			$this->reg_weborderheader->careful_flag  = 1;
		} else {
			$this->reg_weborderheader->careful_flag  = 0;
		}

    }


	// セッションから登録用データのセット
    function setFromBasket($basket, $cnt) {

		$this->reg_weborderdetail = new ORDER_DTL();

		// 登録用WebOrderHeaderクラス変数にセッションから値をセット
		$this->reg_weborderdetail->web_order_num  = $this->orderSeq; // WEB受注番号
		$this->reg_weborderdetail->order_line_num = $cnt; // 行番号
		$this->reg_weborderdetail->item_cd        = $basket['product_code']; // 商品コード
		$this->reg_weborderdetail->item_vol       = $basket['count']; // 数量
		$this->reg_weborderdetail->item_price     = $basket['price_invoice_price']; // 販売価格
		$this->reg_weborderdetail->item_amt       = $basket['price_invoice_price']*$basket['count']; // 金額
		$this->reg_weborderdetail->remarks        = "受付No " . $this->orderSeq; // 摘要（だがWEB受注番号をセット）
		$this->reg_weborderdetail->cust_order_num = $basket['cust_order_num']; // 貴社発注番号

		$this->reg_weborderdetail->tax_rate       = $basket['tax_rate']; // 消費税率　2013/10/29
		$this->reg_weborderdetail->tax            = $basket['tax'];      // 消費税金額　2013/10/29
		$this->reg_weborderdetail->tax_rate_mixed = $basket['tax_rate_mixed']; // 消費税率混在区分　2015/12/09
	}

	function setAcceptanceData() {
		// シーケンスキーの取得用
		$orderacceptanceseqdao = new OrderAcceptanceSeqDAO();
		$this->reg_orderacceptance = new OrderAcceptance();
		// 顧客番号+日付+受注番号
		$this->syonin_id = md5($this->orderinfo->delivery_cust_code.$this->regDate.$this->orderSeq);
		// テーブルアクセス用のキー
		$this->acceptance_seq = $orderacceptanceseqdao->findAcceptanceSeq();

		$this->reg_orderacceptance->order_acceptance_seq         = $this->acceptance_seq;
		$this->reg_orderacceptance->order_acceptance_id          = $this->syonin_id;
		$this->reg_orderacceptance->order_acceptance_header_no   = $this->orderSeq;
		$this->reg_orderacceptance->order_acceptance_detail_no   = "";
		$this->reg_orderacceptance->order_acceptance_product_code= "";
		$this->reg_orderacceptance->order_acceptance_order_date  = $this->regDate;
		$this->reg_orderacceptance->order_acceptance_cust_code   = $this->reg_weborderheader->cust_num;
		$this->reg_orderacceptance->order_acceptance_flag        = "";
		$this->reg_orderacceptance->order_acceptance_respond_date= "";
		//$this->reg_orderacceptance->order_acceptance_update      = ""; // sysdateがセットされる
		$this->reg_orderacceptance->order_acceptance_demand_date = "";
	}

	// 登録エラー時のロールバック処理
	function RegistRollback($prmOrderSeqNum) {
		// T_WEB_ORDER_HDR
		$weborderheaderdao = new WebOrderHeaderDAO();
		$weborderheaderdao->deleteOrderAdmin($prmOrderSeqNum);


		// T_WEB_ORDER_DTL
		// 削除フラグがないためロールバックの必要なし

		// 承認がある場合はDWO_ORDER_ACCEPTANCEに登録
		if ($this->orderinfo->syonin_mail_flg == "1") {
			$orderacceptancedao = new OrderAcceptanceUpgradeDAO();
			$orderacceptancedao->deleteOrderAdmin($prmOrderSeqNum);
		}
		return;
	}

	function RegistOrder() {
		if ($this->basketsession->countForRegist() == 0) {
			//error_log(__FILE__ . ':' . __FUNCTION__ . ':' . "this->basketsession->countForRegist()");
			return Ethna::raiseNotice('ご注文データの登録時にエラーが発生しました。', E_DWO_SYSERROR );
		}
		// 受注番号の取得
		$orderseqdao = new OrderSeqDAO();
		$this->orderSeq = $orderseqdao->findOrderSeq();
		
		// セッションにorder_seqをセット
		$this->mySession->set("ORDER_SEQ_NO", $this->orderSeq);
		
		if ($this->orderSeq == "") {
			error_log(__FILE__ . ':' . __FUNCTION__ . ':' . "this->mySession->set(ORDER_SEQ_NO, this->orderSeq)");
			return Ethna::raiseNotice('ご注文データの登録時にエラーが発生しました。', E_DWO_SYSERROR );
		}

		// T_WEB_ORDER_DTL登録
		$totalTax = 0;  // 2013/10/29
		$weborderdetaildao = new WebOrderDetailDAO();
		$basketlist = $this->basketsession->toUpgradeArray();
		
		for ($i = 0; $i < count($basketlist); $i++) {
			$bsk = $basketlist[$i];

			$totalTax += $bsk['tax'];  // 2013/10/29

			// バスケットから内部プロパティにセット
			$this->setFromBasket($bsk, $i+1);
			// 登録
			try {
				$weborderdetaildao->insert($this->reg_weborderdetail);
			} catch(Exception $e) {
				error_log(__FILE__ . ':' . __FUNCTION__ . ':' . "weborderdetaildao->insert(this->reg_weborderdetail)");
				return Ethna::raiseNotice("注文データ処理時にエラーが発生しました。", E_DWO_SYSERROR );
			}
		}

		// T_WEB_ORDER_HDR登録
		// OrderHeader登録用データ(内部プロパティ)へのセット
		$this->setorderinfo();

		$this->reg_weborderheader->tax       = $totalTax; // 消費税金額 2013/10/29
		$this->reg_weborderheader->total_amt = $this->reg_weborderheader->order_amt + $totalTax; // 総合計 2013/10/29

		$weborderheaderdao = new WebOrderHeaderDAO();
		// 登録
		try {
			$weborderheaderdao->insert($this->reg_weborderheader);
		} catch(Exception $e) {
			error_log(__FILE__ . ':' . __FUNCTION__ . ':' . "weborderheaderdao->insert(this->reg_weborderheader)");
			return Ethna::raiseNotice("注文データ処理時にエラーが発生しました。", E_DWO_SYSERROR );
		}
		
		if ($this->orderinfo->cust_kbn == "OR") {
			$this->orderinfo->syonin_mail_flg = "";
		}

		// 承認がある場合はDWO_ORDER_ACCEPTANCEに登録
		if ($this->orderinfo->syonin_mail_flg == "1") {
			// 登録用データ(内部プロパティ)へのセット
			
			$this->setAcceptanceData();
			// 登録
			$orderacceptancedao = new OrderAcceptanceUpgradeDAO();
			try {
				$orderacceptancedao->insert($this->reg_orderacceptance);
			} catch(Exception $e) {
				error_log(__FILE__ . ':' . __FUNCTION__ . ':' . "orderacceptancedao->insert(this->reg_orderacceptance)");
				return Ethna::raiseNotice("注文データ処理時にエラーが発生しました。", E_DWO_SYSERROR );
			}

			// 承認確認メール送信
			if ($this->syoninMail($basketlist) === FALSE) {
				error_log(__FILE__ . ':' . __FUNCTION__ . ':' . "承認確認メール送信エラー");
				return Ethna::raiseNotice('お客様への承認メール送信時にエラーが発生しました。登録メールアドレスに間違いがないかご確認下さい。', E_DWO_SYSERROR );
			}
		}

		// メール送信 メールを送ってよい会員の場合のみ送信
		
		$mailTo = array();

		if ($this->dwo_profile['mailFlag']) {
			$mailTo[] = $this->agentInfo['mail'];
		}

		if ($this->dwo_profile['extraMailFlag']) {
			$mailTo[] = $this->dwo_profile['extraMail'];
		}

		if ($mailTo) {
			if ($this->orderReportMail($mailTo ,$basketlist ,$totalTax) === FALSE) {
				error_log(__FILE__ . ':' . __FUNCTION__ . ':' . "メール送信 メールを送ってよい会員の場合のみ送信エラー");
				return Ethna::raiseNotice('メール送信時にエラーが発生しました。登録名義メールアドレスに間違いがないかご確認下さい。', E_DWO_SYSERROR );
			}
		}
		return 0;
	}

	function syoninMail($basketlist) {
		// メール専用データの作成
		$bodyAry['mailFrom']  = DWO_SYS_MAIL_FROM; // 送信元(config.incより)
		$bodyAry['mailBcc']  = DWO_SYS_MAIL_BCC; // 送信元(config.incより)
		$bodyAry['orderSeq']  = $this->orderSeq; // 受付No
		$bodyAry['regDate']   = $this->regDateY."-".$this->regDateM."-".$this->regDateD; // 受付日
		$bodyAry['syonin_id'] = $this->syonin_id; // 承認用md5key文字列
		$bodyAry['acceptance_seq'] = $this->acceptance_seq; // 承認用テーブルkey文字列
		$bodyAry['server_name']  = SERVER_NAME; // 送信元(config.incより)
		$bodyAry['url_doc_root']  = URL_DOC_ROOT; // 送信元(config.incより)

		// オブジェクトデータはそのまま配列化してセット(テンプレート側で意識して使用)
//		$bodyAry['basketList'] = $this->basketsession->toUpgradeArray(); // バスケットリスト配列
		$bodyAry['basketList'] = $basketlist; // バスケットリスト配列 2013/11/14
		
		$bodyAry['orderInfo']  = $this->orderinfosession->toArray(); // オーダー情報配列
		$bodyAry['agentInfo']  = $this->agentInfo;

		$bodyAry['ago2week']  = $this->cancelDate; // 最終営業日３営業日前
		$bodyAry['upgrade_flag'] = "1"; // アップグレードフラグ

		// データ配列のEUC化(Ethnaメール用)
		$mailutil = new MailUtil();
		$bodyAry = $mailutil->ArrayValConvertEuc($bodyAry);

		mb_language ("Japanese");
		mb_internal_encoding("EUC_JP");
		$ethna_mail =& new Ethna_MailSender($this->callAction->backend);
		return $ethna_mail->send($this->orderinfo->regist_mail,'syonin.tpl', $bodyAry); // 戻りはmail()の戻り
	}

	function orderReportMail($mailTo ,$basketlist ,$totalTax) {
		// 条件判定データ
		/*	本文タイプ: REG_REPORT     : 承認メール送信報告用
						DEFAULT_REPORT : YBPなど承認なし用 */
		if ($this->orderinfo->syonin_mail_flg == 1) {
			$reportAry['mailCase'] = "REG_REPORT";
		} else {
			$reportAry['mailCase'] = "DEFAULT_REPORT";
		}

		// 値編集処理
//		$date_today = mktime (0, 0, 0, $this->regDateM, $this->regDateD,  $this->regDateY);
//		$tmpdate = $date_today + 86400*14; // 2week ago

		// メール専用データの作成
		$reportAry['mailFrom']  = DWO_SYS_MAIL_FROM; // 送信元(config.incより)
		$bodyAry['mailBcc']  = DWO_SYS_MAIL_BCC; // 送信元(config.incより)
		$reportAry['orderSeq']  = $this->orderSeq; // 受付No
		$reportAry['ago2week']  = $this->cancelDate; // 最終営業日３営業日前
		$reportAry['regDate']   = $this->regDateY."-".$this->regDateM."-".$this->regDateD; // 受付日
		$reportAry['shippingDate']   = $this->basketsession->getReserveShippingDate(); // 出荷可能日（予約購入時のみ）
		$reportAry['order_amt'] = $this->mySession->get('upgrade_price'); // 小計(受注合計金額)
//		$reportAry['tax']       = $this->mySession->get('upgrade_tax'); // 消費税金額
		$reportAry['tax']       = $totalTax; // 消費税金額 2013/10/29
//		$reportAry['total_amt'] = $this->mySession->get('upgrade_price')+$this->mySession->get('upgrade_tax'); // 総合計
		$reportAry['total_amt'] = $reportAry['order_amt'] + $totalTax; // 総合計 2013/10/29


		$reportAry['server_name']  = SERVER_NAME; // 送信元(config.incより)
		$reportAry['url_doc_root']  = URL_DOC_ROOT; // 送信元(config.incより)

		// オブジェクトデータはそのまま配列化してセット(テンプレート側で意識して使用)
//		$reportAry['basketList'] = $this->basketsession->toUpgradeArray(); // バスケットリスト配列
		$reportAry['basketList'] = $basketlist; // バスケットリスト配列 2013/11/14
		
		$reportAry['orderInfo']  = $this->orderinfosession->toArray(); // オーダー情報配列
		$reportAry['agentInfo']  = $this->agentInfo;

		$reportAry['weborderheader']['careful_flag']  = $this->reg_weborderheader->careful_flag; // 2013/11/08
		$reportAry['weborderheader']['contents_type']  = $this->reg_weborderheader->contents_type; // 2013/11/08

		// データ配列のEUC化(Ethnaメール用)
		$mailutil = new MailUtil();
		$reportAry = $mailutil->ArrayValConvertEuc($reportAry);
		mb_language ("Japanese");
		mb_internal_encoding("EUC_JP");
		$ethna_mail =& new Ethna_MailSender($this->callAction->backend);

		if ($this->basketsession->isReserveMode()) {

			if (($this->orderinfo->syonin_mail_flg == 1) && ($this->orderinfo->cust_kbn != "OR")) {
				return $ethna_mail->send($mailTo,'reserve_orderreport2.tpl', $reportAry);
			} else {
				return $ethna_mail->send($mailTo,'reserve_orderreport1.tpl', $reportAry);
			}

		} else {
			return $ethna_mail->send($mailTo,'upgradeorderreport.tpl', $reportAry);
//			return $ethna_mail->send("nakayama@e-d.co.jp",'upgradeorderreport.tpl', $reportAry);
		}

	}
	/**
	 *	オーダー商品の顧客受注番号（貴社発注番号）を取得します。
	 *　常に受注明細の1件目の番号のみが返ります。
	 *　存在しない場合は0バイト文字列。
	 *
	 * @return string 発注番号
	 */
	private function getCustOrderNum() {

//		$basketlist = $this->basketsession->toUpgradeArray();
//
//		if (count($basketlist) > 0) {
//			$bsk = $basketlist[0];
//			return $bsk['cust_order_num'];
//		}
//
//		return "";

		// 2013/11/14
		return $this->basketsession->getCustOrderNum();
	}
	
	/**
	 * 顧客形態毎の受注内容区分コードを取得します。
	 *
	 * @return string 受注区分コード
	 */
	private function getContentsType() {
		$month_num = $this->mySession->get("month_num");

//		if ($this->mySession->get('support_type') == "1" &&  ) { //PAP通し
		if ($this->mySession->get('support_type') == "1" && $month_num >= "3" &&  $month_num <= "5") {
			return '55';
		} else { //販売店通し
			return '54';

		}
	}

	/**
	 * 注文状況に応じて受注ステータスIDを取得します。
	 *
	 * 【受注ステータス】
	 * 0：受付中
	 * 4：承認待ち
	 * 8：予約受付中
	 * 9：予約承認待ち
	 *
	 * @return string 受注ステータスID
	 */
	
	private function getOrderStatusId() {

		if ((($this->orderinfo->cust_kbn == "OR") && ($this->orderinfo->cust_regist_flg == "1")) ||
			$this->orderinfo->syonin_mail_flg == "1") {
			return ($this->basketsession->isReserveMode()) ? "9" : "4";

		}
		return ($this->basketsession->isReserveMode()) ? "8" : "0";

	}

}
?>