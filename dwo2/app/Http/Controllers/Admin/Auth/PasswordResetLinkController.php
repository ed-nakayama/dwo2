<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

use App\Models\Admin;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('admin.auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
		$request->validate([
			'operator_id' => ['required' ,'string'],
			'email' => [
				'required',
            	'email',
				Rule::exists('DWO_operator_mt')->where(function ($query) use ($request) {
					$query->where([
						['email', $request->email],
						['operator_del', '0'],
					]);
				})
			],
		]);

		$admin =  Admin::where('email', $request->email)
			->where('operator_id', $request->operator_id)
			->where('operator_del', '0')
			->selectRaw('operator_id, email')
			->first();

		if (empty($admin)) {
			throw ValidationException::withMessages([
				'email' => 'ご入力いただいた管理者情報は登録されておりません。',
			]);
		}
                
        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::broker('admins')->sendResetLink(
            $request->only('email','operator_id')
        );

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }

}
