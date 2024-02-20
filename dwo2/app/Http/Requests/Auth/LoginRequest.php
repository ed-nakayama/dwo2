<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

use App\Models\User;
use App\Models\Admin;
use App\Models\MSupport;

use App\Mail\AlertTranStatus;
use App\Mail\AlertCreditLimit;

use App\Http\Controllers\Classes\CreditInfoManager;
use App\Http\Controllers\Classes\AgentViewDAO;


class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
	    $this->is('admin/*') ? $guard = 'admin' : $guard = 'web';

		if (strcmp($guard ,'admin') == 0) {
        	return [
				'operator_id' => ['required', 'string'],
				'password' => ['required', 'string'],
			];

		} else {
        	return [
				'profile_cust_code' => ['required', 'integer'],
				'password' => ['required', 'string'],
			];
		}

    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

	    $this->is('admin/*') ? $guard = 'admin' : $guard = 'web';

//        if (! Auth::guard($guard)->attempt($this->only('email', 'password'), $this->boolean('remember'))) {

		if (strcmp($guard ,'admin') == 0) {
			$this->adminCheck($guard);
    	} else {
			$this->userCheck($guard);
    	}

        RateLimiter::clear($this->throttleKey());
    }


/******************************************************************
* �����ԥ�����ǧ��
*******************************************************************/
    private function adminCheck($guard)
    {
		$operator_id = $this->operator_id;
		$password = $this->password;

		$admin = Admin::where('operator_id' ,$operator_id)
			->where('operator_del', '0')
			->orWhereNull('operator_del')
			->get();

		$cnt = count($admin);
		if (empty($admin[0]) || $cnt > 1) {
			RateLimiter::hit($this->throttleKey());

			throw ValidationException::withMessages([
				'operator_id' => trans('auth.admin_login_failed'),
			]);

		} else {

			if (Hash::check($password, $admin[0]->password)) {

				if (! Auth::guard($guard)->attempt($this->only('operator_id', 'password'), $this->boolean('remember'))) {
					RateLimiter::hit($this->throttleKey());

					throw ValidationException::withMessages([
						'operator_id' => trans('auth.admin_login_failed'),
					]);
				}

			} else {
				RateLimiter::hit($this->throttleKey());

				throw ValidationException::withMessages([
					'operator_id' => trans('auth.admin_login_failed'),
				]);
			}
		}

	}


/******************************************************************
* �桼��������ǧ��
*******************************************************************/
    private function userCheck($guard)
    {
		$profile_cust_code = $this->profile_cust_code;
		$password = $this->password;

		$user = User::where('profile_cust_code' ,$profile_cust_code)
			->where('profile_del' ,'0')
			->orWhereNull('profile_del')
			->first();

		 // �ܵҥ����ɤ����Ĥ���ʤ�
		if (empty($user)) {
			RateLimiter::hit($this->throttleKey());

			throw ValidationException::withMessages([
				'profile_cust_code' => trans('auth.login_failed'),
			]);
		}
		
		// WEB���Ѥ����Ĥ���Ƥ��ޤ���
		if ($user->profile_web_flag != '1') {
			RateLimiter::hit($this->throttleKey());

			throw ValidationException::withMessages([
				'profile_cust_code' => trans('auth.no_web_use'),
			]);
		}

		// �桼��ID�ޤ��ϥѥ���ɤ�����������ޤ���
		if (! Auth::guard($guard)->attempt($this->only('profile_cust_code', 'password'), $this->boolean('remember'))) {
			RateLimiter::hit($this->throttleKey());

			throw ValidationException::withMessages([
				'profile_cust_code' => trans('auth.login_failed'),
			]);
		}


		$agentviewDAO = new AgentViewDAO();
		$agentView = $agentviewDAO->findById($profile_cust_code);

		// �����ͤξ�����������Ͽ����Ƥ��ޤ���
		if (empty($agentView) ) { 
			RateLimiter::hit($this->throttleKey());

			throw ValidationException::withMessages([
				'profile_cust_code' => trans('auth.no_cust_num'),
			]);
		}

		session()->put('agentView', $agentView);


		// �����ͤξ�����������Ͽ����Ƥ��ޤ���(�᡼�������о�����)
		if (empty($agentView->mail_address) && ($user->profile_mail_flag == '1') ) {
			RateLimiter::hit($this->throttleKey());

			throw ValidationException::withMessages([
				'profile_cust_code' => trans('auth.no_mail'),
			]);
		}

		// ������ơ�������ʬ���ͤ����åȤ���Ƥ�����ϥ��顼
		if (!empty($agentView->tran_status_type) ) {

			// �����Ԥإ᡼������
			Mail::send(new AlertTranStatus($agentView));

			RateLimiter::hit($this->throttleKey());

			throw ValidationException::withMessages([
				'tran_status_error' => trans('auth.no_mail'),
			]);
		}

		// �����ͤξ�����������Ͽ����Ƥ��ޤ���
		if ( empty($agentView->cust_class_code) ) {
			RateLimiter::hit($this->throttleKey());

			throw ValidationException::withMessages([
				'no_order_user' => trans('auth.no_order_user'),
			]);
		}


		// ���ݡ��ȳ���������λ���Υ����å�
		$support = MSupport::where('account_num' ,$agentView->account_num)
			->where('seq_num' ,$agentView->support_seq_num)
			->first();

		// �ǡ������������å� �����ͤξ�����������Ͽ����Ƥ��ޤ���(���ݡ�����Ͽ) 
		if ( empty($support->account_num) || empty($support->end_date) ) {
			RateLimiter::hit($this->throttleKey());

			throw ValidationException::withMessages([
				'no_match_user' => trans('auth.no_match_user'),
			]);
		}

		// ����Ƚ�� ���ݡ��ȴ��ֳ��Ǥ���
		if (strtotime('now') > strtotime($support->end_date)) {
			RateLimiter::hit($this->throttleKey());

			throw ValidationException::withMessages([
				'out_of_support' => trans('auth.out_of_support'),
			]);
		}


		// Ϳ�������å�
		$creditinfomanager = new CreditInfoManager();
		$creditinfo = $creditinfomanager->GetCreditData($agentView->cust_num);

		if (config('dwo.CREDIT_LIMIT_ERROR_FLG') == 1) {
			if ($credit->yuyo < 0) {  // ���ٳۤ�Ķ�ᤷ�Ƥ��ޤ���

				// �����Ԥإ᡼������ ɬ��
				Mail::send(new AlertCreditLimit($agentView , '�������'));

				RateLimiter::hit($this->throttleKey());

				throw ValidationException::withMessages([
					'over_limit' => trans('auth.over_limit'),
				]);
			}
		}

		session()->put("keep_creditinfo", $creditinfo);

	}


    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')).'|'.$this->ip());
    }
}
