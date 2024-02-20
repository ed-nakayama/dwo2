<?php
namespace App\Http\Controllers\Weborder\Top;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TopExtramail extends Controller
{

/*************************************
* extraメール確認
**************************************/
    function confirm(Request $request)
    {
		$validated = $request->validate([
			'mail'     => ['required', 'string' ,'email' ,'confirmed'],
			'mail_flg' => ['required'],
		]);

		return view('weborder.top.extramailconfirm',[
			'mail'     => $request->input('mail'),
			'mail_flg' => $request->input('mail_flg'),
		]);
	}


/*************************************
* extraメール保存
**************************************/
    function store(Request $request)
    {
        $user = \Auth::user();

		$user->profile_extra_mail = $request->mail;
		$user->profile_extra_mail_flag = !empty($request->mail_flg) ? $request->mail_flg : 0;
		$user->profile_modified_id = $user->profile_cust_code;

		$user->save();

        return redirect('/top/extramail/complete');
	}


}

