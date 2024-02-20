<?php

namespace App\Http\Controllers\Classes;

class Util
{
    function parseChar($term)
    {
        if($term != "") {
	       return "'" . $term ."'";
        } else {
	       return "NULL";
        }
    }



/*************************************
* 配列チェックボックス
**************************************/
    function checkBox($list ,$val) {

		if (!empty($list)) {
			$recCount = count($list);

			foreach ($list as $ch) {
	      		if ($ch == $val) {
	      			return "1";
	      		} 
			}
		}

        return "0";
    }


/*
 * laravelタイプ
*/
/*
 * rawタイプ
*/
/*************************************
* テキストのセット
**************************************/
	public function set_text($val)
	{
		$ret = (!empty($val))  ? $val : null;

		return $ret;
	}


/*************************************
* 配列テキストのセット
**************************************/
	public function set_text_null($val)
	{
		$ret = (!empty($val))  ? "'{$val}'" : null;

		return $ret;
	}

/*************************************
* 配列テキストのセット
**************************************/
	public function set_text_null_str($val)
	{
		$ret = (!empty($val))  ? "'{$val}'" : 'null';

		return $ret;
	}


/*************************************
* 配列チェクボックスのセット
**************************************/
	public function set_checkbox($ary , $val)
	{
		$flag = '0';
		
		if (!empty($ary)) {
			foreach ($ary as $chk) {
				if ($chk == $val) {
					$flag =  '1';
					break;
				} 
			}
		}

		return $flag;
	}


/*************************************
* ページング設定
**************************************/
	public function pagination($sql ,$perPage)
	{
		// 現在のページ番号
		$currentPage = \Illuminate\Pagination\Paginator::resolveCurrentPage();
		
		if (empty($currentPage)) {
			$start_num = 1;
		} else {
			$start_num = ($currentPage - 1) * $perPage + 1;
		}
		$end_num = $start_num + $perPage - 1;

		// 表示するアイテムを取得
/*
		$results = \DB::select("{$sql} WHERE RNO BETWEEN :start_num AND :end_num", [
		    'start_num' => $start_num,
		    'end_num' => $end_num
		]);
*/
		$results = \DB::select("{$sql} WHERE RNO BETWEEN {$start_num} AND {$end_num}");



		// アイテムの総数を取得
		$total = \DB::selectOne("SELECT count(*) AS cnt FROM ({$sql})");

		// LengthAwarePaginatorのインタスタンスを取得
		$pagination = new \Illuminate\Pagination\LengthAwarePaginator(
		    $results,
		    $total->cnt,
		    $perPage,
		    $currentPage,
			[
 				'path' => sprintf(
					'%s%s',
					request()->url(),
					request()->except('page')
  						? '?' . http_build_query(request()->except('page'))
						: ''
				)
			]
		);

		return $pagination;
	}


}
