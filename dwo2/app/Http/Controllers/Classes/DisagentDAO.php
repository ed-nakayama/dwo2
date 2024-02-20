<?php

namespace App\Http\Controllers\Classes;

use App\Models\DisableAgent;

class DisagentDAO {

 /*************************************************************
 * 条件検索
 * 利用ファイル
 *   weborder/top/TopHome.php index()
 ***************************************************************/
    function isDisable($depth, $agentCode) {

		$list = DisableAgent::where('disable_agent_level_code' ,$agentCode)
			->where('disable_agent_depth' ,$depth)
			->get();

        return $list;
    }

}
