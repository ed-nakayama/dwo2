<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use App\Models\User;
use App\Models\MCcCust;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'profile_cust_code' => ['required' ,'string'],
            'email'             => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
		
		$cust =  MCcCust::where('mail_address', $request->email)
			->where('cust_num', $request->profile_cust_code)
			->where('del_type', '0')
			->selectRaw('cust_num, mail_address')
			->first();

		if (empty($cust)) {
			throw ValidationException::withMessages([
				'email' => 'ご入力いただいたお客様情報は登録されておりません。',
			]);

		} else {
			$user = User::where('profile_cust_code' ,$cust->cust_num)
				->where(function($query) {
					$query->whereNull('profile_del')
					->orWhere('profile_del' ,'0');
				})->first();

			if (empty($user)) {
				throw ValidationException::withMessages([
					'email' => 'ご入力いただいたお客様情報は登録されておりません。',
				]);

			} else {
				$user->email = $cust->mail_address;
				$user->profile_modified_id = 'SYSTEM_RST';
				$user->save();
			}
		}

        $status = Password::broker('users')->sendResetLink(
            $request->only('email', 'profile_cust_code')
       );

        return $status == Password::RESET_LINK_SENT
                    ? redirect('/sent/mail')->with('status' , 'パスワードリセットメールを送信しました。')
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }
}
