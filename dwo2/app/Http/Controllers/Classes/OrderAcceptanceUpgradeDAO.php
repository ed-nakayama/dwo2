<?php

namespace App\Http\Controllers\Classes;

use Illuminate\Support\Facades\Mail;

use App\Models\OrderAcceptance;

class OrderAcceptanceUpgradeDAO {

	public $util;
/*
 * コンストラクタ
 */
	function __construct() {
		// 初期化
		$this->util = new Util();
	}

	/****************************************
	 * 条件検索
	*****************************************/
    function findForCancelList() {

		// 未削除で承認回答が一度も行われていないデータを検索
        $sql = "SELECT ";
        $sql .= "        ORDER_ACCEPTANCE_SEQ";
        $sql .= "       ,ORDER_ACCEPTANCE_ID";
        $sql .= "       ,ORDER_ACCEPTANCE_HEADER_NO";
        $sql .= "       ,ORDER_ACCEPTANCE_DETAIL_NO";
        $sql .= "       ,ORDER_ACCEPTANCE_PRODUCT_CODE";
        $sql .= "       ,TO_DATE(ORDER_DATE, 'YYYYMMDD') AS ORDER_ACCEPTANCE_ORDER_DATE";
        $sql .= "       ,ORDER_ACCEPTANCE_CUST_CODE";
        $sql .= "       ,ORDER_ACCEPTANCE_FLAG";
        $sql .= "       ,ORDER_ACCEPTANCE_RESPOND_DATE";
        $sql .= "       ,ORDER_ACCEPTANCE_UPDATE";
        $sql .= "       ,ORDER_ACCEPTANCE_DEMAND_DATE";
        $sql .= "  FROM DWO_ORDER_ACCEPTANCE";
        $sql .= "       ,". config('dwo.ORDER_HDR');
        $sql .= " WHERE ORDER_ACCEPTANCE_FLAG IS NULL ";
        $sql .= "   AND ORDER_ACCEPTANCE_RESPOND_DATE IS NULL ";
        $sql .= "   AND ORDER_ACCEPTANCE_HEADER_NO = WEB_ORDER_NUM ";
        $sql .= "   AND CUST_DEL_TYPE = '0'";
        $sql .= "   AND OPERATOR_DEL_TYPE = '0'";
        $sql .= "   AND STATE_TYPE IN (4, 9)"; // 承認待ち、予約承認待ち
        $sql .= "   AND INPUT_TYPE = '0'"; // 未取り込み
        $sql .= "   AND ORDER_ACCEPTANCE_UPGRADE_FLAG = '1'"; // アップグレードフラグ 2010/10/28 T.N

		$list = \DB::select($sql);

		return $list;
	}


	/****************************************
	 * 条件検索 督促メール用
	*****************************************/
    function findForDemandList() {


		// 未削除で承認回答が一度も行われていないデータを検索
        $sql = "SELECT ";
        $sql .= "        ORDER_ACCEPTANCE_SEQ";
        $sql .= "       ,ORDER_ACCEPTANCE_ID";
        $sql .= "       ,ORDER_ACCEPTANCE_HEADER_NO";
        $sql .= "       ,ORDER_ACCEPTANCE_DETAIL_NO";
        $sql .= "       ,ORDER_ACCEPTANCE_PRODUCT_CODE";
        $sql .= "       ,TO_DATE(ORDER_DATE, 'YYYYMMDD') AS ORDER_ACCEPTANCE_ORDER_DATE";
        $sql .= "       ,ORDER_ACCEPTANCE_CUST_CODE";
        $sql .= "       ,ORDER_ACCEPTANCE_FLAG";
        $sql .= "       ,ORDER_ACCEPTANCE_RESPOND_DATE";
        $sql .= "       ,ORDER_ACCEPTANCE_UPDATE";
        $sql .= "       ,ORDER_ACCEPTANCE_DEMAND_DATE";
        $sql .= "       ,TO_CHAR(TO_DATE(ORDER_DATE, 'YYYYMMDD') + 14, 'YYYY-MM-DD') AS ORDER_DATE2W_AGO";
        $sql .= "  FROM DWO_ORDER_ACCEPTANCE";
        $sql .= "       ,". config('dwo.ORDER_HDR');
        $sql .= " WHERE ORDER_ACCEPTANCE_FLAG IS NULL ";
        $sql .= "   AND ORDER_ACCEPTANCE_RESPOND_DATE IS NULL ";
        $sql .= "   AND ORDER_ACCEPTANCE_DEMAND_DATE IS NULL ";
        $sql .= "   AND ORDER_ACCEPTANCE_HEADER_NO = WEB_ORDER_NUM ";
        $sql .= "   AND CUST_DEL_TYPE = '0'";
        $sql .= "   AND OPERATOR_DEL_TYPE = '0'";
        $sql .= "   AND STATE_TYPE IN (4, 9)"; // 承認待ち、予約承認待ち
        $sql .= "   AND INPUT_TYPE = '0'"; // 未取り込み
        $sql .= "   AND ORDER_ACCEPTANCE_UPGRADE_FLAG = '1'"; // アップグレードフラグ 2010/10/28 T.N

		$list = \DB::select($sql);

		return $list;
	}


/*
 * 条件検索 (WebOrderNumからの検索)
 */
    function findOrderNum($order_num) {

        $connection = $this->connect();
        if (!$connection) {
			throw new Exception("An error occured.\n");
			return;
        }

        $sql = "SELECT ";
        $sql .= "  ORDER_ACCEPTANCE_SEQ";
        $sql .= "  ,ORDER_ACCEPTANCE_ID";
        $sql .= "  ,ORDER_ACCEPTANCE_HEADER_NO";
        $sql .= "  ,ORDER_ACCEPTANCE_DETAIL_NO";
        $sql .= "  ,ORDER_ACCEPTANCE_PRODUCT_CODE";
        $sql .= "  ,to_char(ORDER_ACCEPTANCE_ORDER_DATE, 'YYYY-MM-DD') as ORDER_ACCEPTANCE_ORDER_DATE";
        $sql .= "  ,ORDER_ACCEPTANCE_CUST_CODE";
        $sql .= "  ,ORDER_ACCEPTANCE_FLAG";
        $sql .= "  ,ORDER_ACCEPTANCE_RESPOND_DATE";
        $sql .= "  ,ORDER_ACCEPTANCE_UPDATE";
        $sql .= "  ,ORDER_ACCEPTANCE_DEMAND_DATE";
        $sql .= "  FROM DWO_ORDER_ACCEPTANCE";
        $sql .= " WHERE ORDER_ACCEPTANCE_HEADER_NO = :order_acceptance_header_no";
        $sql .= "   AND ORDER_ACCEPTANCE_UPGRADE_FLAG = '1'"; // アップグレードフラグ 2010/10/28 T.N
        $sql .= "   AND ROWNUM = 1";

		$stid = oci_parse($connection, $sql);
		if (!$stid) {
			$e = oci_error($connection);
			// 例外として処理
			throw new Exception($e['message']);
			return;
		}

		// bind処理
		// SQLインジェクション対応
		oci_bind_by_name($stid, ":order_acceptance_header_no", $order_num, -1);

		$r = oci_execute($stid, OCI_DEFAULT);
		if (!$r) {
			$e = oci_error($connection);
			// 例外として処理
			throw new Exception($e['message']);
			return;
		}

		$orderacceptance = new OrderAcceptance();
        if ($row = oci_fetch_array($stid, OCI_RETURN_NULLS)) {
         	$orderacceptance->setAll($row);
        }

		oci_close($connection);

        return $orderacceptance;
    }


/*
 * 条件検索
 */
    function find($order_acceptance_seq, $order_acceptance_id) {

        $connection = $this->connect();
        if (!$connection) {
			throw new Exception("An error occured.\n");
			return;
        }

        $sql = "SELECT *";
        $sql .= "  FROM DWO_ORDER_ACCEPTANCE";
        $sql .= " WHERE ORDER_ACCEPTANCE_SEQ = :order_acceptance_seq";
        $sql .= "   AND ORDER_ACCEPTANCE_ID = :order_acceptance_id";
        $sql .= "   AND ORDER_ACCEPTANCE_UPGRADE_FLAG = '1'"; // アップグレードフラグ 2010/10/28 T.N
        $sql .= "   AND ROWNUM = 1";

		$stid = oci_parse($connection, $sql);
		if (!$stid) {
			$e = oci_error($connection);
			// 例外として処理
			throw new Exception($e['message']);
			return;
		}

		// bind処理
		// SQLインジェクション対応
		oci_bind_by_name($stid, ":order_acceptance_seq", $order_acceptance_seq, -1);
		oci_bind_by_name($stid, ":order_acceptance_id" , $order_acceptance_id , -1);

		$r = oci_execute($stid, OCI_DEFAULT);
		if (!$r) {
			$e = oci_error($connection);
			// 例外として処理
			throw new Exception($e['message']);
			return;
		}

		$orderacceptance = new OrderAcceptance();
        if ($row = oci_fetch_array($stid, OCI_RETURN_NULLS)) {
         	$orderacceptance->setAll($row);
        }

		oci_close($connection);

        return $orderacceptance;
    }



 /*
 * 新規登録
 */
    function insert($list) {

        $connection = $this->connect();
        if (!$connection) {
			throw new Exception("An error occured.\n");
			return;
        }

        $sql = "INSERT INTO DWO_ORDER_ACCEPTANCE";
        $sql .= "  (ORDER_ACCEPTANCE_SEQ";
        $sql .= "  ,ORDER_ACCEPTANCE_ID";
        $sql .= "  ,ORDER_ACCEPTANCE_HEADER_NO";
        $sql .= "  ,ORDER_ACCEPTANCE_DETAIL_NO";
        $sql .= "  ,ORDER_ACCEPTANCE_PRODUCT_CODE";
        $sql .= "  ,ORDER_ACCEPTANCE_ORDER_DATE";
        $sql .= "  ,ORDER_ACCEPTANCE_CUST_CODE";
        $sql .= "  ,ORDER_ACCEPTANCE_FLAG";
        $sql .= "  ,ORDER_ACCEPTANCE_RESPOND_DATE";
        $sql .= "  ,ORDER_ACCEPTANCE_UPDATE";
        $sql .= "  ,ORDER_ACCEPTANCE_DEMAND_DATE";
        $sql .= "  ,ORDER_ACCEPTANCE_UPGRADE_FLAG";
        $sql .= "  )";
        $sql .= " VALUES";
        $sql .= "  (:order_acceptance_seq         ";
        $sql .= "  ,:order_acceptance_id          ";
        $sql .= "  ,:order_acceptance_header_no   ";
        $sql .= "  ,:order_acceptance_detail_no   ";
        $sql .= "  ,:order_acceptance_product_code";
        $sql .= "  ,:order_acceptance_order_date  ";
        $sql .= "  ,:order_acceptance_cust_code   ";
        $sql .= "  ,:order_acceptance_flag        ";
        $sql .= "  ,:order_acceptance_respond_date";
        $sql .= "  ,sysdate";
        $sql .= "  ,:order_acceptance_demand_date";
        $sql .= "  ,'1'";
        $sql .= "  )"; 
        
		$stid = oci_parse($connection, $sql);
		if (!$stid) {
			$e = oci_error($connection);
			// 例外として処理
			throw new Exception($e['message']);
			return;
		}

		// bind処理
		// SQLインジェクション対応
		oci_bind_by_name($stid, ":order_acceptance_seq"         , $list->order_acceptance_seq         , -1);
		oci_bind_by_name($stid, ":order_acceptance_id"          , $list->order_acceptance_id          , -1);
		oci_bind_by_name($stid, ":order_acceptance_header_no"   , $list->order_acceptance_header_no   , -1);
		oci_bind_by_name($stid, ":order_acceptance_detail_no"   , $list->order_acceptance_detail_no   , -1);
		oci_bind_by_name($stid, ":order_acceptance_product_code", $list->order_acceptance_product_code, -1);
		oci_bind_by_name($stid, ":order_acceptance_order_date"  , $list->order_acceptance_order_date  , -1);
		oci_bind_by_name($stid, ":order_acceptance_cust_code"   , $list->order_acceptance_cust_code   , -1);
		oci_bind_by_name($stid, ":order_acceptance_flag"        , $list->order_acceptance_flag        , -1);
		oci_bind_by_name($stid, ":order_acceptance_respond_date", $list->order_acceptance_respond_date, -1);
		oci_bind_by_name($stid, ":order_acceptance_demand_date" , $list->order_acceptance_demand_date , -1);
		
		$result = oci_execute($stid, OCI_DEFAULT);
		if (!$result) {
			$e = oci_error($stid);
			// 例外として処理
			throw new Exception($e['message']);
			return;
		}

		oci_commit($connection);

		oci_close($connection);

        return;

    }


	/***********************************
	 * 更新
	 ***********************************/
    function update($acceptance) {

		OrderAcceptance::where('order_acceptance_seq' , $acceptance->order_acceptance_seq)
			->where('order_acceptance_id', $acceptance->order_acceptance_id)
			->update([
        		'order_acceptance_flag'         => $acceptance->order_acceptance_flag,
        		'order_acceptance_respond_date' => $acceptance->order_acceptance_respond_date,
        		'order_acceptance_update'       =>  \DB::raw('sysdate'),
        		'order_acceptance_demand_date'  => $acceptance->order_acceptance_demand_date,
			]);

        return;

    }
	/*
	 * 更新 承認処理用
	 */
    function updateStatus($seq, $id, $flg) {

        $connection = $this->connect();
        if (!$connection) {
            echo "An error occured.\n";
            exit;
        }

	    $sql  = "UPDATE DWO_ORDER_ACCEPTANCE";
        $sql .= "   SET  ORDER_ACCEPTANCE_FLAG = " . $flg;
        $sql .= "       ,ORDER_ACCEPTANCE_RESPOND_DATE = sysdate";
        $sql .= "       ,ORDER_ACCEPTANCE_UPDATE = sysdate";
        $sql .= " WHERE ORDER_ACCEPTANCE_SEQ = " . $seq;
        $sql .= "   AND ORDER_ACCEPTANCE_ID = '" . $id ."'";

		$stid = oci_parse($connection, $sql);
		if (!$stid) {
			$e = oci_error($connection);
			print htmlentities($e['message']);
			exit;
		}

		$result = oci_execute($stid, OCI_DEFAULT);
		if (!$result) {
			$e = oci_error($stid);
			echo htmlentities($e['message']);
			exit;
		}

		oci_commit($connection);

		oci_close($connection);

        return;

    }

	// 削除区分がないため、期限切れとして処理する。
    function deleteOrderAdmin($web_order_num) {

        $connection = $this->connect();
        if (!$connection) {
            echo "An error occured.\n";
            exit;
        }

	    $sql  = "UPDATE DWO_ORDER_ACCEPTANCE";
        $sql .= "   SET  ORDER_ACCEPTANCE_FLAG = 3";
        $sql .= "       ,ORDER_ACCEPTANCE_RESPOND_DATE = sysdate";
        $sql .= "       ,ORDER_ACCEPTANCE_UPDATE = sysdate";
        $sql .= " WHERE ORDER_ACCEPTANCE_HEADER_NO = " . $this->parseChar($web_order_num);

		$stid = oci_parse($connection, $sql);
		if (!$stid) {
			$e = oci_error($connection);
			print htmlentities($e['message']);
			exit;
		}

		$result = oci_execute($stid, OCI_DEFAULT);
		if (!$result) {
			$e = oci_error($stid);
			echo htmlentities($e['message']);
			exit;
		}

		oci_commit($connection);

		oci_close($connection);

        return;
    }

	/****************************************************************
	 * 督促メール送信後の更新(メールは1度しか送らないようにするため)
	 ****************************************************************/
    function updateDemandDate($web_order_num) {
/*
		$tmp_sysdate = date("Ymd");

	    $sql  = "UPDATE DWO_ORDER_ACCEPTANCE";
        $sql .= "   SET ORDER_ACCEPTANCE_DEMAND_DATE = ".$tmp_sysdate;
        $sql .= " WHERE ORDER_ACCEPTANCE_HEADER_NO = " . $this->parseChar($web_order_num);
*/
		OrderAcceptance::where('ORDER_ACCEPTANCE_HEADER_NO' , $web_order_num)
			->update([
        		'order_acceptance_demand_date'  => date("Ymd"),
			]);

        return;
    }

}
