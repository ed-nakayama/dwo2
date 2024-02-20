<?php

namespace App\Http\Controllers\Classes;

define("DWOBASKET", "DwoBasket");
define("DWORECOVERYBASKET", "DwoRecoveryBasket");

class BasketSession {

	public static $NO_MODE = 1;
	public static $NORMAL_MODE = 2;
	public static $NETWORK_MODE = 3;
		
	private $basketlist;
	private $basketlistClone; // クローン用
	
	/*
	 * コンストラクタ
     * 引数：セッション
	 */
	function __construct() {
		$this->basketlist = array();
		$this->basketlistClone = array();
		$this->setFromSession();
	}


 /*************************************************************
 * 配列から再セット
 *
 * 利用ファイル
 *   weborder/item/ItemSelect.php regist()
 ***************************************************************/
	function setFromArray($arylist) {
		$this->clear();

		for ($i=0; $i<count($arylist); $i++) {
			$bsk = new Basket();

			$bsk->product_code       = $arylist[$i]['product_code'       ];
			$bsk->item_name_kanji    = $arylist[$i]['item_name_kanji'    ];
			$bsk->base_name          = $arylist[$i]['base_name'          ];
			$bsk->count              = $arylist[$i]['count'              ];
			$bsk->status             = $arylist[$i]['status'             ];
			$bsk->sales_price        = $arylist[$i]['sales_price'        ];
			$bsk->price_invoice_price= $arylist[$i]['price_invoice_price'];
			$bsk->cust_order_num     = $arylist[$i]['cust_order_num'     ];
			$bsk->item_class_large   = $arylist[$i]['item_class_large'   ];
			$bsk->item_class_medium  = $arylist[$i]['item_class_medium'];
			$bsk->item_ship_date     = $arylist[$i]['item_ship_date'];
			
			$bsk->support_code       = $arylist[$i]['support_code'       ];
			$bsk->support_price      = $arylist[$i]['support_price'      ];
			$bsk->sup_item_name      = $arylist[$i]['sup_item_name'      ];
			$bsk->support_base_price = $arylist[$i]['support_base_price' ];

			$this->add($bsk);
		}
	}


	/*
	 * セッションから取得
	 */
	function setFromSession() {
		$this->basketlist = session()->get(DWOBASKET);
	}
	
	/*
	 * セッションに保存
	 */
	function setToSession() {
//		$this->my_session->set(DWOBASKET, $this->basketlist);
		session()->put(DWOBASKET, $this->basketlist);
		// いかなる場面からも確認できるように件数をセット
		session()->put("keep_bsk_count", count($this->basketlist));
	}


 /*************************************************************
 * バスケット件数取得
 *
 * 利用ファイル
 *   weborder/item/ItemSelect.php regist()
 ***************************************************************/
	function count() {
		
		$cnt = isset($this->basketlist) ? count($this->basketlist) : 0;

		return $cnt;
    }

	/*
	 * バスケット件数取得 保守商品を別商品扱いにした明細全件用
	 */
	function countForRegist() {
		$retCount=0;

		for ($i = 0; $i < count($this->basketlist); $i++) {
			$data = $this->basketlist[$i];
			$retCount++;

			// １件プラス
			if ($data->support_code != "") {
				$retCount++;
			}
		}
		return $retCount;
	}

 /*
  * バスケット実体の取得
  */
	function get() {
		return $this->basketlist;
    }


 /*************************************************************
 * バスケット追加
 *
 * 利用ファイル
 *   weborder/item/ItemSelect.php regist()
 ***************************************************************/
	function add($bsk) {
		
		$msg1 = '在庫状況が「予約受付中」の商品は、単独でご注文ください。';
		$msg2 = '弥生PAP製品とネットワーク製品は同時にご注文いただけません。1商品ずつご注文ください。';
		
		if ($bsk->status == "8") {
			
			if (!$this->isReserveMode() && ($this->count() > 0)) {
				throw new Exception($msg1);
			}
			
		}
		
		if ($this->isReserveMode()) {
			
			$item = $this->basketlist[0];
			
			if (!(($bsk->status == "8") && ($item->item_name_kanji == $bsk->item_name_kanji))) {
				throw new Exception($msg1);
			}
			
		}
		
		if (($this->getBasketMode() == BasketSession::$NORMAL_MODE) && $bsk->isNwProduct()) {
			throw new Exception($msg2); 
		}
		
		if (($this->getBasketMode() == BasketSession::$NETWORK_MODE) && !$bsk->isNwProduct()) {
			throw new Exception($msg2); 
		}
		
		//print($this->getBasketMode());
		
		$sameflg = 0;
		for ($i = 0; $i < count($this->basketlist); $i++) {
			$data = $this->basketlist[$i];

			if (($bsk->product_code == $data->product_code) && ($bsk->support_code == $data->support_code)) {
				// カウントを合計する
				$data->count += $bsk->count;
				$sameflg = 1;
			}
		}
		if ($sameflg == 0) {
			$this->basketlist[] = $bsk;
		}
		$this->setToSession();
    }

 /*******************************************************************************
 * バスケットから削除
 *
 * 利用ファイル
 *   weborder/bascket/bascketConfirm.php  index()
 *******************************************************************************/
	function del($prod_code, $support_code) {
		$list = array();
		for ($i = 0; $i < count($this->basketlist); $i++) {
			$data = $this->basketlist[$i];
			if (($prod_code == $data->product_code) && ($support_code == $data->support_code)) {
				//
			} else {
				$list[] = $data;
			}
		}
		// 置き換え
		$this->basketlist = $list;
		$this->setToSession();
    }

	/*
	 * バスケットを初期化
	 */
	function clear() {
		$this->basketlist = array();
		$this->setToSession();
	}

	/*
	 * 指定product_codeのBasketクラスを返す
	 */
	function getBasket($p_cd, $sup_cd) {
		for ($i = 0; $i < count($this->basketlist); $i++) {
			$data = $this->basketlist[$i];
			if (($p_cd == $data->product_code) && ($sup_cd == $data->support_code)) {
				return $data;
			}
		}
		return null;
	}

	/*
	 * 指定product_codeのBasketクラスを返す(値渡し版)
	 */
	function copyBasket($p_cd, $sup_cd) {
		for ($i = 0; $i < count($this->basketlist); $i++) {
			$data = $this->basketlist[$i];
			if (($p_cd == $data->product_code) && ($p_cd == $data->support_code)) {
    			$cp_basket = new Basket();

				$cp_basket->product_code       =$data->product_code       ;
				$cp_basket->item_name_kanji    =$data->item_name_kanji    ;
				$cp_basket->base_name          =$data->base_name          ;
				$cp_basket->count              =$data->count              ;
				$cp_basket->status             =$data->status             ;
				$cp_basket->sales_price        =$data->sales_price        ;
				$cp_basket->price_invoice_price=$data->price_invoice_price;
				$cp_basket->cust_order_num     =$data->cust_order_num     ;
				$cp_basket->item_class_large   =$data->item_class_large   ;
				$cp_basket->item_class_medium  = $data->item_class_medium;
				$cp_basket->item_ship_date  = $data->item_ship_date;
				
				$cp_basket->support_code       =$data->support_code       ;
				$cp_basket->support_price      =$data->support_price      ;
				$cp_basket->sup_item_name      =$data->sup_item_name      ;
				$cp_basket->support_base_price =$data->support_base_price ;

				return $cp_basket;
			}
		}
		return null;
	}

	/*
	 * バスケット情報を更新。同じ商品コードがある場合は上書き。異なる場合は何もしない
	 */
	function EditBasket($bsk) {
		for ($i = 0; $i < count($this->basketlist); $i++) {
			$data = $this->basketlist[$i];
			if (($bsk->product_code == $data->product_code) && ($bsk->support_code == $data->support_code)) {
				// 商品コード以外を更新
				$data->item_name_kanji     = $bsk->item_name_kanji    ;
				$data->base_name           = $bsk->base_name          ;
				$data->count               = $bsk->count              ;
				$data->status              = $bsk->status             ;
				$data->sales_price         = $bsk->sales_price        ;
				$data->price_invoice_price = $bsk->price_invoice_price;
				$data->cust_order_num      = $bsk->cust_order_num     ;
				$data->item_class_large    = $bsk->item_class_large   ;
				$data->item_class_medium    = $bsk->item_class_medium;
				$data->item_ship_date    = $bsk->item_ship_date;
				
				$data->support_code        = $bsk->support_code       ;
				$data->support_price       = $bsk->support_price      ;
				$data->sup_item_name       = $bsk->sup_item_name      ;
				$data->support_base_price  = $bsk->support_base_price ;

				break;
			}
		}
		$this->setToSession();
    }


 /*************************************************************
 * バスケット配列化
 *
 * 利用ファイル
 *   weborder/item/ItemSelect.php regist()
 ***************************************************************/
	function toArray() {
		$datList = array(); // init
		
		if (isset($this->basketlist)) {
		
			for ($i = 0; $i < count($this->basketlist); $i++) {
				$data = $this->basketlist[$i];
				$datList[$i]['product_code'       ] = $data->product_code       ;
				$datList[$i]['item_name_kanji'    ] = $data->item_name_kanji    ;
				$datList[$i]['base_name'          ] = $data->base_name          ;
				$datList[$i]['count'              ] = $data->count              ;
				$datList[$i]['status'             ] = $data->status             ;
				$datList[$i]['sales_price'        ] = $data->sales_price        ;
				$datList[$i]['price_invoice_price'] = $data->price_invoice_price;
				$datList[$i]['cust_order_num'     ] = $data->cust_order_num     ;
				$datList[$i]['item_class_large'   ] = $data->item_class_large   ;
				$datList[$i]['item_class_medium'   ] = $data->item_class_medium;
				$datList[$i]['item_ship_date'   ] = $data->item_ship_date;
			
				$datList[$i]['support_code'       ] = $data->support_code       ;
				$datList[$i]['support_price'      ] = $data->support_price      ;
				$datList[$i]['sup_item_name'      ] = $data->sup_item_name      ;
				$datList[$i]['support_base_price' ] = $data->support_base_price ;
			}
		}
	
		return $datList;
	}


	/**
	 *	オーダー商品の顧客受注番号（貴社発注番号）を取得します。
	 *　常に受注明細の1件目の番号のみが返ります。
	 *　存在しない場合は0バイト文字列。
	 *
	 * @return string 発注番号
	 */
	function getCustOrderNum() {

		// 2013/11/14
		if (count($this->basketlist) > 0) {
			$data = $this->basketlist[0];
			 
			return $data->cust_order_num;
		}

		return "";
	}

	/************************************************************
	 * バスケット配列化 保守商品を別商品扱いにした明細全件用
	 ************************************************************/
	function toArrayForRegist() {
		$supcount=0;
		for ($i = 0; $i < count($this->basketlist); $i++) {
			$data = $this->basketlist[$i];
			$datList[$i+$supcount]['product_code'       ] = $data->product_code       ;
			$datList[$i+$supcount]['item_name_kanji'    ] = ($data->support_code != "") ? $data->base_name : $data->item_name_kanji;
			$datList[$i+$supcount]['base_name'          ] = $data->base_name          ;
			$datList[$i+$supcount]['count'              ] = $data->count              ;
			$datList[$i+$supcount]['status'             ] = $data->status             ;
			$datList[$i+$supcount]['sales_price'        ] = ($data->support_code != "") ? $data->sales_price-$data->support_base_price : $data->sales_price;
			$datList[$i+$supcount]['price_invoice_price'] = ($data->support_code != "") ? $data->price_invoice_price-$data->support_price : $data->price_invoice_price;
			$datList[$i+$supcount]['cust_order_num'     ] = $data->cust_order_num     ;
			$datList[$i+$supcount]['item_class_large'   ] = $data->item_class_large   ;
			$datList[$i+$supcount]['item_class_medium'  ] = $data->item_class_medium  ;
			$datList[$i+$supcount]['item_ship_date'     ] = $data->item_ship_date     ;

			$datList[$i+$supcount]['support_code'       ] = $data->support_code       ;
			$datList[$i+$supcount]['support_price'      ] = $data->support_price      ;
			$datList[$i+$supcount]['sup_item_name'      ] = $data->sup_item_name      ;
			$datList[$i+$supcount]['support_base_price' ] = $data->support_base_price ;

			$datList[$i+$supcount]['tax_rate'           ] = config('dwo.DWO_TAX_RATE'); //  2013/12/02
			$datList[$i+$supcount]['tax'                ] = 0; // 2013/10/29
			$datList[$i+$supcount]['tax_rate_mixed'     ] = "0"; // 2015/12/09

			if ($data->support_code != "") {
				$supcount++;
				$datList[$i+$supcount]['product_code'       ] = $data->support_code       ;
				$datList[$i+$supcount]['item_name_kanji'    ] = $data->sup_item_name      ;
				$datList[$i+$supcount]['base_name'          ] = "";
				$datList[$i+$supcount]['count'              ] = $data->count              ;
				$datList[$i+$supcount]['status'             ] = $data->status             ;
				$datList[$i+$supcount]['sales_price'        ] = $data->support_base_price ;
				$datList[$i+$supcount]['price_invoice_price'] = $data->support_price      ;
				$datList[$i+$supcount]['cust_order_num'     ] = $data->cust_order_num     ;
				$datList[$i+$supcount]['item_class_large'   ] = "";
				$datList[$i+$supcount]['item_class_medium'  ] = "";
				$datList[$i+$supcount]['item_ship_date'     ] = "";
								
				$datList[$i+$supcount]['support_code'       ] = "";
				$datList[$i+$supcount]['support_price'      ] = "";
				$datList[$i+$supcount]['sup_item_name'      ] = "";
				$datList[$i+$supcount]['support_base_price' ] = "";

				$datList[$i+$supcount]['tax_rate'           ] = config('dwo.DWO_TAX_RATE_SUP'); //  2013/12/02
				$datList[$i+$supcount]['tax'                ] = ""; // 2013/10/29
				$datList[$i+$supcount]['tax_rate_mixed'     ] = "0"; // 2015/12/09
			}
		}
	
		$datList = $this->getLineTax($datList); // 2013/10/29

		return $datList;
	}

	//Quangが追加。バスケットにある商品を返す
	function toUpgradeArray() {

		$datList = $this->getLineTax($this->basketlist); // 2013/10/29

		return $datList;
	}
	/*
	 * 現在のステータスチェック
	 */
	function getStatus() {
		$retstatus = "";
		for ($i = 0; $i < count($this->basketlist); $i++) {
			$data = $this->basketlist[$i];
			$retstatus =  $data->status; // 一つでも取得したらOK
			break;
		}
		return $retstatus;
	}


	/*****************************************
	 * 合計金額(税抜き)
	 *****************************************/
	function totalPrice() {

		$total = 0;
		if (isset($this->basketlist)) {
			for ($i = 0; $i < count($this->basketlist); $i++) {
				$data = $this->basketlist[$i];
				$total += $data->price_invoice_price * $data->count;
			}
		}

		return $total;
	}

	/*
	 * 消費税金額
	 */
	function taxPrice() {
//echo sprintf("%s, %f, %s<br/>",$this->totalPrice(), $this->getTaxRate(), bcmul(strval($this->totalPrice()), strval($this->getTaxRate()), 0));
//echo sprintf("%s, %f, %s<br/>",$this->totalPrice(), $this->getTaxRate(), floor($this->totalPrice() * $this->getTaxRate()));


// 2017/05/16 mikami		return floor($this->totalPrice() * $this->getTaxRate());
		return bcmul(strval($this->totalPrice()), strval($this->getTaxRate()), 0);
	}


	/*****************************************
	 * 消費税率
	 *****************************************/
	function getTaxRate() {
		return config('dwo.DWO_TAX_RATE');
	}
	
	
	/*
	 * 消費税率(行合計)　2013/10/28
	 */
	function getLineTax($datList) {

		$contents = $this->receiveXml($datList);
		$len = count($contents);

		for ($i = 0; $i < $len; $i++) {
			$row = (int) $contents[$i]['row'] - 1;
			$datList[$row]['tax_rate'] = $contents[$i]['tax_rate'];

			$price = (int) $datList[$row]['price_invoice_price'];
			$count = (int) $datList[$row]['count'];
			$tax_rate = (float) $datList[$row]['tax_rate'];

// 2017/05/16 mikami			$datList[$row]['tax'] = floor($price * $count * $tax_rate);
			$datList[$row]['tax'] = bcmul(bcmul(strval($price), strval($count), 0), strval($tax_rate), 0);
		}

		return $datList;
	}


	/*
	 * XML API受信　2013/10/28
	 */
	function receiveXml($datList) {

		$param = $this->makeParam($datList);
		
		$data =  http_build_query($param);

		ini_set('default_socket_timeout', 5);
 
		$context = stream_context_create(
			array(
				'http' => array(
					'method' => 'POST',
					'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
							 . "User-Agent: sherpacc_user\r\n",
	 				'content' => $data,
					)
				)
		);

		$data = array();
		if ($contents = @file_get_contents(config('dwo.TAX_URL'), false, $context)) {

			$xml = simplexml_load_string($contents);

			if ($xml->status != '101') {
				print($xml->status . " : " .  mb_convert_encoding($xml->message ,"SJIS" ,"UTF-8") . "<br>");
				print_r($param);
			}

			$i = 0;
			foreach ($xml->data->data_table as $data_table) {
				$data[$i]['row']           = (int) $data_table->row;
				$data[$i]['tax_rate']      = $data_table->tax_rate;
				$i++;
			}

		} else { // データを取得できないとき
			for ($i = 0; $i < count($datList); $i++) {
				$data[$i]['row']           = $i + 1;
				$data[$i]['tax_rate']      = $datList[$i]['tax_rate']; // 2013/12/02
			}
		}

		return $data;
	}


	/*
	 * XML 作成 2013/10/28
	 */
	function makeParam($datList) {

		$orderinfosession = new OrderInfoSession();
		$orderinfo = $orderinfosession->get();

		$agentInfo = session()->get("agentView"); // Array 2013/11/14
		$orderSeq  = session()->get("ORDER_SEQ_NO"); // 2013/11/14

		$param['entry_way'] = 4;  // 1：シェルパ・ダイレクト　2：シェルパ・インダイレクト　3：弥生ＷＥＢ 4：ＤＷＯ　5：ダウンロード販売
		$shipDate = $this->getReserveShippingDate();
		if ($shipDate == '') {
			$param['order_date'] = date("Ymd"); // ＤＷＯの場合は受付日
		} else {
			$param['order_date'] = date("Ymd", strtotime("{$shipDate} -1 day"  ));
		}
		$param['order_time'] = date("His"); // 受注時間
		$param['Sender'] = 'DWO-' . $orderSeq;

		if ($orderinfo->upgrade_order == TRUE) {
			$param['account_num'] = session()->get("cust_id"); // 2013/12/04
		}
		
		$cnt = count($datList);

		for ($i = 0; $i < $cnt; $i++) {
			$arg = sprintf("%02d" ,$i + 1);

			// 製品
			// 行番号
			$param['row_'          . $arg] = $arg;
			// 受注区分 01：製品 02：サプライ 10：セミナー 20：サポート単体 21：サポートアップグレード 30：入会  31：会員継続

			if ($orderinfo->upgrade_order == TRUE) {
				$param['order_type_'   . $arg] = '21';
			} else if ($datList[$i]['item_class_large'] == '03') { // サプライ
				$param['order_type_'   . $arg] = '02';
			} else {                                               // 製品
				$param['order_type_'   . $arg] = '01';
			}
			
			// 商品コード
			$param['item_cd_'      . $arg] = $datList[$i]['product_code'];
			// サポート対象製品の行番号
			$param['item_for_sp_'  . $arg] = '';
			// サポート対象製品の価格
			$param['price_for_cd_' . $arg] = $datList[$i]['price_invoice_price'];

			// サポート
			if ($datList[$i]['support_code'] != "") {
				$i++;
				$arg = sprintf("%02d" ,$i + 1);

				// 行番号
				$param['row_'          . $arg] = $arg;
			// 受注区分 01：製品 02：サプライ 10：セミナー 20：サポート単体 21：サポートアップグレード 30：入会  31：会員継続
				$param['order_type_'   . $arg] = '01';
				// 商品コード
				$param['item_cd_'      . $arg] = $datList[$i]['product_code'];
				// サポート対象製品の行番号
				$param['item_for_sp_'  . $arg] = sprintf("%02d" ,$i);
				// サポート対象製品の価格
				$param['price_for_cd_' . $arg] = $datList[$i]['price_invoice_price'];
			}
		}

		return $param;
	}



	/**
	 * 現在の購入製品状況を取得します
	 * 
	 * [バスケット状態ID]
	 * なし						：BasketSession::$NO_MODE
	 * PAP専用（通常）商品購入	：BasketSession::$NORMAL_MODE
	 * Nw製品購入				：BasketSession::$NETWORK_MODE
	 * 
	 * @return int バスケット状態ID
	 */
	public function getBasketMode() {
		
		foreach ($this->basketlist as $data) {
			if ($data->item_class_large == "01") {
				if ($data->isNwProduct()) {
					return BasketSession::$NETWORK_MODE;
				} else {
					return BasketSession::$NORMAL_MODE;
				}
			}
		}
		
		return  BasketSession::$NO_MODE;
		
	}
	
	/**
	 * 予約購入モードかどうかを返します。
	 * 
	 * @return boolean 予約購入モードの場合true、それ以外の場合false
	 */
	public function isReserveMode() {

		if ($this->getStatus() == "8") {
			return true;
		} else {
			return false;
		}
		
	}
	
	/**
	 * 予約モードの場合の出荷可能日を取得します。
	 * 
	 * @return String 予約モードの場合は出荷可能日、それ以外の場合は空文字列
	 */
	 public function getReserveShippingDate() {

		if ($this->isReserveMode()) {
			$item = $this->basketlist[0];
			return $item->item_ship_date;
			
		}
		
		return "";
		
	}
	
}
