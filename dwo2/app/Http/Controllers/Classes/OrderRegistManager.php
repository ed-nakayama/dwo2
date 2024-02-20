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


class OrderRegistManager {

	private $orderSeq;
//	private $callAction;          // 呼び出しアクション
	private $regDate; // YYYYMMDD
	private $regDateY; // YYYY
	private $regDateM; // MM
	private $regDateD; // DD
	private $syonin_id;
	private $acceptance_seq;

	private $basketsession;    // バスケットセッション(セッションから)
	private $orderinfosession; // オーダー情報(セッションから)
	private $agentView;        // AgentViewクラス配列(セッションから)
	private $oriconPapInfo;        // AgentViewクラス配列(セッションから)
	private $dwo_profile;      // DWO顧客情報 メアド、メールフラグ取得用

	private $reg_weborderheader; // WebOrderHeaderクラス用
	private $reg_weborderdetail; // WebOrderDetailクラス用
	private $reg_orderacceptance;    // OrderAcceptanceクラス用
	private $orderinfo = null;

	/*
	 * コンストラクタ
	 * 引数: 呼び出しクラス
	 */
	function __construct() {
//		$this->callAction = $paramAction;

		$this->regDateY = date("Y");
		$this->regDateM = date("m");
		$this->regDateD = date("d");
		$this->regDate = $this->regDateY.$this->regDateM.$this->regDateD; //date("Ymd");

		// セッション情報チェック
		$this->basketsession = new BasketSession();
		$this->orderinfosession = new OrderInfoSession();
		$this->agentView     = session()->get("agentView"); // Array
		$this->oriconPapInfo = session()->get("keep_OriconPapAgent"); // Array
		$this->dwo_profile = Auth::user();

	}


 /*************************************************************
 * セッションから登録用データのセット
 ***************************************************************/
    private function setOrderInfo() {
        $this->orderinfo = $this->orderinfosession->get();

		// 前処理
		$oricon_flg = FALSE;
		if (($this->orderinfo->pap_order == TRUE) && ($this->orderinfo->cust_kbn == "OR")) {
			$oricon_flg = TRUE;
		}

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
		if (($this->orderinfo->double_package_type == "1") || ($this->orderinfo->direct_delivery_type=="1")) {
			$tmp_appoint_type = "1";
		}

//		$this->reg_weborderheader = new WebOrderHeader();
		$this->reg_weborderheader = new ORDER_HDR();

		// 登録用WebOrderHeaderクラス変数にセッションから値をセット
		$this->reg_weborderheader->web_order_num          = $this->orderSeq; // ＷＥＢ受注番号
		$this->reg_weborderheader->main_web_order_num     = $this->orderSeq; // 親ＷＥＢ受注番号
		$this->reg_weborderheader->contents_type          = $this->getContentsType();
		$this->reg_weborderheader->origin_type            = "1"; // ＷＥＢ作成元区分(固定)
		$this->reg_weborderheader->web_operator_cd        = "DWO"; // ＷＥＢオペレータコード(無条件セット)
		$this->reg_weborderheader->order_date             = $this->regDate; // 受注日
		$this->reg_weborderheader->new_cust_type          = "0"; // 新規顧客区分(固定)
		$this->reg_weborderheader->account_num            = $this->agentView->account_num; // お客様番号
		$this->reg_weborderheader->cust_num               = $this->agentView->cust_num; // 顧客番号
		$this->reg_weborderheader->pay_type               = "01"; // 支払区分(固定)
		$this->reg_weborderheader->settle_type            = "01"; // 決済区分(固定)
		$this->reg_weborderheader->billed_type            = "02"; // 請求区分(固定)
		$this->reg_weborderheader->item_spread_cd         = ""; // セット商品コード(不要)

		//$this->reg_weborderheader->campaign_cd            = ""; // キャンペーンコード
		//$this->reg_weborderheader->user_account_num       = ""; // 使用者お客様番号  DWOでは常に新規なのでnull
		//$this->reg_weborderheader->user_cust_num          = ""; // 使用者顧客番号 DWOでは常に新規なのでnull
		$this->reg_weborderheader->secondary_account_num  = ($oricon_flg)?$this->oriconPapInfo['accountNum']:""; // ２次店お客様番号 オリコンの場合PAPのお客様番号
		$this->reg_weborderheader->secondary_cust_num     = ($oricon_flg)?$this->oriconPapInfo['custCode'  ]:""; // ２次店顧客番号   オリコンの場合PAPのお客様番号

		$this->reg_weborderheader->agreement_type         = "0"; // 使用者承諾済区分(ユーザー承諾後に1)
		$this->reg_weborderheader->support_sametime_type  = "0"; // サポート同時登録区分(固定)
		$this->reg_weborderheader->support_continue_type  = "0"; // サポート自動継続区分(固定)
		$this->reg_weborderheader->appoint_type           = $tmp_appoint_type; // 指定有無区分(条件判定)
		$this->reg_weborderheader->double_package_type    = $this->orderinfo->double_package_type; // 二重梱包区分
		$this->reg_weborderheader->delivery_date_type     = "0"; // 着日指定区分
		$this->reg_weborderheader->delivery_date          = ""; // 着日
		$this->reg_weborderheader->delivery_time_type     = "0"; // AM指定区分
		$this->reg_weborderheader->direct_delivery_type   = $this->orderinfo->direct_delivery_type; // 直送区分

		$this->reg_weborderheader->pd_cd                  = "00001"; // 出荷場コード

		$this->reg_weborderheader->cust_order_num         = $this->getCustOrderNum(); // 顧客発注番号
		$this->reg_weborderheader->deliver_memo           = $this->orderinfo->remarks; // 納品書メモ欄

		if (($this->reg_weborderheader->direct_delivery_type == 1) && ($this->reg_weborderheader->deliver_memo == "")) {
			$this->reg_weborderheader->deliver_memo = $this->orderinfo->delivery_name;
		}

		$this->reg_weborderheader->remarks_type           = ($this->orderinfo->remarks=="")?"0":"1"; // 備考有無区分
		$this->reg_weborderheader->remarks1               = ""; // 備考１
		$this->reg_weborderheader->remarks2               = ""; // 備考２
		$this->reg_weborderheader->linage                 = $this->basketsession->countForRegist(); // 明細行数
		$this->reg_weborderheader->order_amt              = $this->basketsession->totalPrice(); // 受注合計金額
		$this->reg_weborderheader->tax                    = $this->basketsession->taxPrice(); // 消費税金額
		$this->reg_weborderheader->total_amt              = $this->basketsession->totalPrice()+$this->basketsession->taxPrice(); // 総合計
		$this->reg_weborderheader->tax_rate               = $this->basketsession->getTaxRate(); // 税率

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

		//$this->reg_weborderheader->card_company_cd        = ""; // カード会社コード
		//$this->reg_weborderheader->card_num               = ""; // カード番号
		//$this->reg_weborderheader->card_good_thru         = ""; // カード有効期限
		//$this->reg_weborderheader->card_name              = ""; // カード名義

		$this->reg_weborderheader->name_kana1             = $this->orderinfo->regist_kana; // 顧客名カナ１
		$this->reg_weborderheader->name_kana2             = ""; // 顧客名カナ２
		$this->reg_weborderheader->name1                  = mb_substr($this->orderinfo->regist_name,0, 16); // 顧客名１
		$this->reg_weborderheader->name2                  = (mb_strlen($this->orderinfo->regist_name) > 16)?mb_substr($this->orderinfo->regist_name,16):"";; // 顧客名２
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
		$this->reg_weborderheader->mail_address           = $this->orderinfo->regist_mail; // お客様メールアドレス
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
		$this->reg_weborderheader->shipping_date          = $ship; // 出荷予定日
		$this->reg_weborderheader->dest_cd                = ""; // 納品先コード
		$this->reg_weborderheader->state_type             = $this->getOrderStatusId();
		$this->reg_weborderheader->dwo_order_person_name  = $this->orderinfo->order_tantou_name; // DWO貴社発注担当者

		$this->reg_weborderheader->cust_class_large       = ($this->orderinfo->cust_regist_flg == 1) ? "01" : ""; // 顧客区分コード
		$this->reg_weborderheader->cust_class_medium      = ""; // 取引先形態コード
		$this->reg_weborderheader->cust_class_small       = ""; // 取引先別区分コード

		$this->reg_weborderheader->present_type           = "2"; // プレゼント有無区分
		$this->reg_weborderheader->present_contents_type  = ""; // プレゼント内容区分


		// サポートキャンペーン適用区分 弥生１３対応 2012/10/31
		$supportFlag = 0;
		$basketlist = $this->basketsession->get();
		for ($i = 0; $i < count($basketlist); $i++) {
			$basket = $basketlist[$i];

			if (($basket->support_code != '') && ($basket->isNwProduct() == false)) {
				$supportFlag = 1;
				break;
			}
		}

	
		// サポートキャンペーン適用区分 弥生１３対応 2012/10/31
		if (($this->orderinfo->cust_kbn == 'OR' || $this->orderinfo->cust_kbn == 'GOLD') && ($this->orderinfo->pap_order == TRUE) && ($supportFlag == 1)) {
			$this->reg_weborderheader->support_campaign_type  = "1";  // サポートキャンペーン適用
		} else {
			$this->reg_weborderheader->support_campaign_type  = "";
		}

		// 厳選・非厳選フラグ 2012/11/13
		if ($this->agentView->cust_group2 == '430'
		 || $this->agentView->cust_group2 == '436'
		 || $this->agentView->cust_group2 == '454'
		 || $this->agentView->cust_group2 == '458'
		 || $this->agentView->cust_group2 == '460'
		 || $this->agentView->cust_group2 == '464') {
			$this->reg_weborderheader->careful_flag  = 1;
		} else {
			$this->reg_weborderheader->careful_flag  = 0;
		}
			
    }


 /*************************************************************
 * セッションから登録用データのセット
 ***************************************************************/
    private function setFromBasket($basket, $cnt) {

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


 /*************************************************************
 * 認証データセット
 ***************************************************************/
	private function setAcceptanceData() {

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
		$this->reg_orderacceptance->order_acceptance_cust_code   = $this->orderinfo->delivery_cust_code;
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
			$orderacceptancedao = new OrderAcceptanceDAO();
			$orderacceptancedao->deleteOrderAdmin($prmOrderSeqNum);
		}
		return;
	}


 /*************************************************************
 * オーダ登録
 *
 * 利用ファイル
 *   weborder/order/OrderCompletion.php store()
 ***************************************************************/
	function RegistOrder() {
		if ($this->basketsession->countForRegist() == 0) {
			return 'ご注文データの登録時にエラーが発生しました。';
		}

		// 受注番号の取得
		$sequence = \DB::getSequence();
		$this->orderSeq = $sequence->nextValue('order_num_seq');

		// セッションにorder_seqをセット
		session()->put("ORDER_SEQ_NO", $this->orderSeq);

		if ($this->orderSeq == "") {
			return 'ご注文データの登録時にエラーが発生しました。';
		}

		// T_WEB_ORDER_DTL登録
		$totalTax = 0;  // 2013/10/29
		$webOrderDetailDAO = new WebOrderDetailDAO();
		$basketlist = $this->basketsession->toArrayForRegist();

		for ($i = 0; $i < count($basketlist); $i++) {
			$bsk = $basketlist[$i];

			$totalTax += $bsk['tax'];  // 2013/10/29
			
			// バスケットから内部プロパティにセット
			$this->setFromBasket($bsk, $i+1);

			// 登録
			$this->reg_weborderdetail->save();
		}

		// T_WEB_ORDER_HDR登録
		// OrderHeader登録用データ(内部プロパティ)へのセット
		$this->setOrderInfo();
		$this->reg_weborderheader->tax       = $totalTax; // 消費税金額 2013/10/29
		$this->reg_weborderheader->total_amt = $this->reg_weborderheader->order_amt + $totalTax; // 総合計 2013/10/29
		$webOrderHeaderDAO = new WebOrderHeaderDAO();

		// 登録
		$this->reg_weborderheader->save();

		// 承認がある場合はDWO_ORDER_ACCEPTANCEに登録
		if ($this->orderinfo->syonin_mail_flg == "1") {
			// 登録用データ(内部プロパティ)へのセット
			$this->setAcceptanceData();
			// 登録
			$orderAcceptanceDAO = new OrderAcceptanceDAO();
			try {
				$orderAcceptanceDAO->insert($this->reg_orderacceptance);
			} catch(Exception $e) {
				return 'ご注文データの登録時にエラーが発生しました。';
			}

			// 承認確認メール送信
			$this->syoninMail($basketlist);
		}

		// メール送信 メールを送ってよい会員の場合のみ送信
		$mailTo = array();

		if ($this->dwo_profile->profile_mail_flag == 1) {
			$mailTo[] = $this->agentView->mail_address;
		}

		if ($this->dwo_profile->profile_extra_mail_flag == 1) {
			$mailTo[] = $this->dwo_profile->profile_extra_mail;
		}

		if ($mailTo) {
			$this->orderReportMail($mailTo ,$basketlist ,$totalTax);
		}

		return;
	}


 /*************************************************************
 * 承認メール送信
 ***************************************************************/
	private function syoninMail($basketlist) {
		// メール専用データの作成

		$weborderheader = new ORDER_HDR();
		$orderacceptance = new OrderAcceptance();
		$weborderdetail = new ORDER_DTL();
		
		$weborderheader->web_order_num         = $this->orderSeq;
		$weborderheader->name1                 = $this->orderinfosession->regist_name;
		$weborderheader->contact_name1         = $this->orderinfosession->regist_name_of_charge;
		$weborderheader->dwo_order_person_name = $this->orderinfosession->order_tantou_name;

		$orderacceptance->order_acceptance_order_date = $this->regDateY."-".$this->regDateM."-".$this->regDateD; // 受付日
		$orderacceptance->order_acceptance_seq        = $this->acceptance_seq; // 承認用テーブルkey文字列
		$orderacceptance->order_acceptance_id         = $this->syonin_id; // 承認用md5key文字列

		$weborderdetailList = array();
		
		foreach ($basketlist as $basket) {
			$weborderdetail = new ORDER_DTL();

			$weborderdetail->remarks = $basketlist['cust_order_num'];
			$weborderdetail->item_cd = $basketlist['product_code'];
			$weborderdetail->item_name_kanji = $basketlist['item_name_kanji'];
			$weborderdetail->item_vol = $basketlist['count'];

			$weborderdetailList[] = $weborderdetail;
		}


		// 得意先情報取得
		$agentView = session()->get('agentView');

		// 値編集処理
		$date_today = mktime (0, 0, 0, $this->regDateM, $this->regDateD,  $this->regDateY);
		$tmpdate = $date_today + 86400*14; // 2week ago

		$ago2week = date('Y-m-d', $tmpdate); // 2週間後の日付
		$upgrade_flag = '0'; // アップグレードフラグ

		$mailTo = $this->orderinfo->regist_mail;

		// メール送信処理 ==========================================================================
		Mail::send(new Syonin($agentView, $weborderheader, $weborderdetailList, $orderacceptance, $ago2week, $upgrade_flag, $mailTo ));

		return;
	}


 /*************************************************************
 * 承認メール送信ときのエラーメール送信
 ***************************************************************/
	private function orderReportMail($mailTo ,$basketlist ,$totalTax) {

		$weborderheader = new ORDER_HDR();

		// 値編集処理
		$date_today = mktime (0, 0, 0, $this->regDateM, $this->regDateD,  $this->regDateY);
		$tmpdate = $date_today + 86400*14; // 2week ago
		$ago2week  = date('Y-m-d', $tmpdate); // 2週間後の日付

		// メール専用データの作成
		$weborderheader->web_order_num         = $this->orderSeq;
		$weborderheader->order_date            = $this->regDateY."-".$this->regDateM."-".$this->regDateD; // 受付日
		$weborderheader->ship_date             = $this->basketsession->getReserveShippingDate(); // 出荷可能日（予約購入時のみ）
		$weborderheader->order_amt             = $this->basketsession->totalPrice(); // 小計(受注合計金額)
		$weborderheader->tax                   = $totalTax; // 消費税金額 2013/10/29
		$weborderheader->total_amt             = $weborderheader->order_amt + $totalTax; // 総合計 2013/10/29

        $orderinfo = $this->orderinfosession->get();

		if ($this->basketsession->isReserveMode()) {
			Mail::send(new ReserveOrderReport($this->orderSeq, $orderinfo, $this->agentView, $basketlist, $weborderheader, $ago2week, $mailTo ));

		} else {
			Mail::send(new OrderReport($this->orderSeq, $orderinfo, $this->agentView, $basketlist, $weborderheader, $ago2week, $mailTo ));
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

//		$basketlist = $this->basketsession->toArrayForRegist();
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

		if ($this->orderinfo->pap_order == TRUE) { //PAP通し

			if ($this->orderinfo->cust_regist_flg == '1') {
				return ($this->basketsession->getBasketMode() == BasketSession::$NORMAL_MODE) ? '80' : '82';
			} else {
				return '81';
			}

		} else { //販売店通し

			return '40';

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
