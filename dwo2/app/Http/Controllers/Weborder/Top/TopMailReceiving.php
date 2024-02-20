<?php

namespace App\Http\Controllers\Weborder\Top;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TopMailReceiving extends Controller
{

/*************************************
* メール受信設定確認
**************************************/
	public function confirm(Request $request)
	{
		return view('weborder.top.mailReceivingConfirm',
			[
			'mail_flg'       => $request->input('mail_flg'),
			'extra_mail_flg' => $request->input('extra_mail_flg'),
			]);
    }


/*************************************
* extraメール保存
**************************************/
    function store(Request $request)
    {
        $user = \Auth::user();

		$user->profile_mail_flag       = !empty($request->mail_flg) ? $request->mail_flg : 0;
		$user->profile_extra_mail_flag = !empty($request->extra_mail_flg) ? $request->extra_mail_flg : 0;
		$user->profile_modified_id     = $user->profile_cust_code;

		$user->save();

        return redirect('/top/mailreceiving/complete');

	}


}
