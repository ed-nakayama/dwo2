<?php
namespace App\Http\Controllers\Weborder\Top;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Classes\WebOrderHeaderDAO;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Support\Facades\Hash;

class TopPassedit extends Controller
{
/*************************************
* パスワードリセット
**************************************/
	public function index()
	{
		$custCode = \Auth::user()->profile_cust_code;

		$webOrderHeaderDAO = new WebOrderHeaderDAO();
		$lastupdate = $webOrderHeaderDAO->findLastUpdate($custCode);

		// 最終受付日のチェック
		$alertMsg = '';
		if ($lastupdate == "") {
			$alertMsg = "on";
		} else {
			// 現在日付と比較
			list($y, $m, $d, $h, $i, $s) = sscanf($lastupdate, "%04d-%02d-%02d %02d:%02d:%02d");
			$ago = date("Ymd", mktime(0, 0, 0, $m, $d+90, $y)); // 90日後
			if (date("Ymd") > $ago) {
				$alertMsg = "on";
			}
		}

		return view('weborder.top.passedit',compact(
			'alertMsg',
		));
    }


/*************************************
* パスワード更新
**************************************/
    public function updatePassword(UpdatePasswordRequest $request){

        $user = \Auth::user();

        $user->password = Hash::make($request->get('new-password'));
        $user->profile_modified_id = $user->profile_cust_code;
        $user->save();

        return redirect('/top/passedit/complete');
    }


}
