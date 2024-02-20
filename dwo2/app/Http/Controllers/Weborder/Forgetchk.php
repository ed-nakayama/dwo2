<?php

namespace App\Http\Controllers\Weborder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Classes\ProfileDAO;

use App\Mail\ForgetId;


class Forgetchk extends Controller
{
	public function index(Request $request)
	{
		$validatedData = $request->validate([
			'frm_cust_tel'   => ['required' ,'string'],
	    	'frm_cust_mail'  => ['required','string','email'],
		]);


		$result = $this->chk_profile($request);

//		return back()->with('id_status', 'ID通知メールを送信しました。');

		return redirect('/sent/mail')->with('status' , 'ID通知メールを送信しました。');
    }


	function chk_profile(Request $request) {

		$tel  = $request->frm_cust_tel;
		$mail = $request->frm_cust_mail;

		$profileDAO = new ProfileDAO();
		$cust = $profileDAO->findForForget("", $tel, $mail);

		if (empty($cust)) {
			throw ValidationException::withMessages([
				'frm_cust_mail' => 'ご入力いただいたお客様情報は登録されておりません。',
			]);
		}

		 Mail::send(new ForgetId($cust->profile_cust_code ,$cust->cname ,$mail) );

	}


}
