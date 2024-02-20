<?php

namespace App\Http\Controllers\Classes;

use App\Models\MCalendar;


class CalendarMtDAO {

	private $cur_ts;

	// コンストラクタ
	function __construct() {

		$this->cur_ts = time();
	}


 /*************************************************************
 * 出荷日検索
 *
 * 利用ファイル
 *   clsses/ProductDAO.php updateInStock()
 ***************************************************************/
    public function getShippingDate() {
		
		return $this->getShippingDate2($this->cur_ts);
	}


 /*************************************************************
 * 出荷日検索2
 *
 * 利用ファイル
 *   admin/test/TestShippingResult.php index()
 ***************************************************************/
	public function getShippingDate2($time) {
		$ret_str = "";

		// 今月
		$cur_date = getdate($time);

		$dates_str = $this->getCalendarDate( $cur_date );

		if (!empty($dates_str)) {
			// 来月
			$next_ts = mktime(0, 0, 0, $cur_date['mon'] + 1, 1, $cur_date['year']);
			$next_date = getdate($next_ts);

			$ret_date = $cur_date;

			$day_base = $cur_date['mday'];

			if($dates_str[$cur_date['mday']-1] == 1 && $cur_date['hours'] >= 15){
				// 当日は稼働日だが15時を過ぎたので、[当日+1]以降の稼動日を探す
				$day_base = $cur_date['mday'] + 1;
			}

			// 処理日を探す
			$day_operation = $this->getBusinessDay($dates_str, $day_base);
			if($day_operation === FALSE){
			// 今月には見つからないので来月分から探す
				$ret_date = $next_date;
				$dates_str = $this->getCalendarDate( $next_date );
				$day_operation = $this->getBusinessDay($dates_str, 1);
			}
			if($day_operation === FALSE){
				// 処理日が見つからないのでエラー終了
				return $ret_str;
			}

			// 出荷日を処理日の翌日以降から探す
			$day_shipping = $this->getBusinessDay($dates_str, $day_operation + 1);

			if($day_shipping === FALSE && $ret_date['mon'] == $cur_date['mon']){
				// 今月には見つからなかったので来月分から探す
				$ret_date = $next_date;
				$dates_str = $this->getCalendarDate( $next_date );
				$day_shipping = $this->getBusinessDay($dates_str, 1);
			}
			if($day_shipping !== FALSE){
				$ret_str = $ret_date['year'] . '/' . sprintf('%02d', $ret_date['mon']) . '/' . sprintf('%02d', $day_shipping);
			}
		} else {
			$ret_str = null;
		}

		return $ret_str;
	}


	/*******************************************
	 * M_CALENDAR.CALENDAR_DATE を取得
	 *******************************************/
	private function getCalendarDate($arr_date){
		$ret = FALSE;

		$list = MCalendar::where('pd_cd', 'SYS')
			->where('calendar_year' ,$arr_date['year'])
			->where('calendar_month', $arr_date['mon'])
			->first();

		if (!empty($list)) {
			$calDay = $list->calendar_day;
			$cal = mb_str_split($calDay);
		} else {
			$cal = null;
		}
		
		return $cal;
	}


	/*******************************************
	 * $day以降の直近稼働日を取得
	 *******************************************/
	private function getBusinessDay($dates_str, $day){
		$ret = FALSE;

		if($dates_str === FALSE){
			return $ret;
		}

//		$last_idx = strlen($dates_str) - 1;
		$last_idx = count($dates_str) - 1;
		$day--;
		while($last_idx >= $day){
			if( $dates_str[$day] == 1 ){
				$ret = $day + 1;
				break;
			}

			$day++;
		}

		return $ret;
	}
	
	/* 月末最終営業日の３営業日前 取得 - Quang 2010/11/04 */
	function N_LastBusinessDay($time,$n){
		$ret = 0;
		$cur_date = getdate($time);
		// 今月
		$dates_str = $this->getCalendarDate( $cur_date );
		$i = 31;
		while ($n>=0){
			$i--;
			if ($dates_str[$i]==1){
				$n--;
			}
		} 
		$ret = $i+1;
		return $ret;
	}
	/* Quang 2010/11/05 受付日 */
	function getReceiptDate($time) {
		$ret_str = "";

		// 今月
		$cur_date = getdate($time);
		$dates_str = $this->getCalendarDate( $cur_date );
		// 来月
		$next_ts = mktime(0, 0, 0, $cur_date['mon'] + 1, 1, $cur_date['year']);
		$next_date = getdate($next_ts);

		$ret_date = $cur_date;

		$day_base = $cur_date['mday'];
		if($dates_str[$cur_date['mday']-1] == 1 && $cur_date['hours'] >= 15){
			// 当日は稼働日だが15時を過ぎたので、[当日+1]以降の稼動日を探す
			$day_base = $cur_date['mday'] + 1;
		}	
		// 処理日を探す
		$day_operation = $this->getBusinessDay($dates_str, $day_base);
		if($day_operation == FALSE){
			// 今月には見つからないので来月分から探す
			$ret_date = $next_date;
			$dates_str = $this->getCalendarDate( $next_date );
			$day_operation = $this->getBusinessDay($dates_str, 1);
		}
		if($day_operation == FALSE){
			// 処理日が見つからないのでエラー終了
			return $ret_str;
		} else {
			$ret_str = $ret_date['year'] . '/' . sprintf('%02d', $ret_date['mon']) . '/' . sprintf('%02d', $day_operation);
		}

		return $ret_str;
	}


 /*************************************************************
 * 月末最終営業日のN営業日前 取得 - T.N 2010/11/21
 *
 * 利用ファイル
 *   weborder/top/TopHistory.php mail_do()
 ***************************************************************/
	function dayFromLastDay($n) {

		$arr_date['year'] = date("Y");
		$arr_date['mon'] = date("n");
		$cal = $this->getCalendarDate($arr_date);

		$preDay = $n + 1;
		$day = 0;
		$avlDay = 0;
		$last_idx = count($cal) - 1;
		for ($i = $last_idx; $i >= 0; $i--) {
			if($cal[$i] == 1) {
				$avlDay = $i + 1;
				$day++;
				if ($day == $preDay) break; // 月末最終営業日からN営業日前
			}
		}
//dd($last_idx . ' : ' . $n . ' : ' . $day . ' : ' . $preDay . ' : ' . $avlDay);
		$avlDay = sprintf('%02d', $avlDay);

		return $avlDay;
	}

	
}
