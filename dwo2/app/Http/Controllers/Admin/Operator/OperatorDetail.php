<?php

namespace App\Http\Controllers\Admin\Operator;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Classes\OperatorDAO;
use App\Http\Controllers\Classes\Util;

use App\Models\Admin;

class OperatorDetail extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index()
    {
		$adminList = Admin::orderBy("operator_code")
			->get();
        
		return view('admin.operator.detail' ,compact(
			'adminList',
		));
    }


    /************************************
     * 新規登録
     ***********************************/
    public function regist(Request $request)
    {

		$validated = $request->validate([
			'new_id'         => ['required', 'string' ,'alpha_num' ,'unique:dwo_operator_mt,operator_id'],
			'new_priv'       => ['nullable'],
			'new_name'       => ['nullable', 'string'],
			'new_name_roman' => ['nullable', 'string'],
			'new_password'   => ['required', 'string', 'max:64', Password::defaults()],
			'new_tel'        => ['nullable', 'string', 'max:5'],
			'new_mail'       => ['nullable', 'email'],
		]);

		$admin = Auth::user();

        $operator = new Admin();

		$operator->operator_code        = Admin::max('operator_code') + 1;
		$operator->operator_id          = $request->new_id;
		$operator->operator_priv        = !empty($request->new_priv) ? 1 : 0;
		$operator->operator_name        = $request->new_name;
		$operator->operator_name_roman  = $request->new_name_roman;
		$operator->operator_password1   = $request->new_password;
		$operator->password             = Hash::make($request->new_password);
		$operator->operator_tel         = $request->new_tel;
		$operator->email                = $request->new_mail;
		$operator->operator_modified_id = $admin->operator_id;
		$operator->operator_del         = '0';

		$operator->save();

        return back()->with('status', 'success-regist');
    }


    /************************************
     * 更新
     ***********************************/
    public function store(Request  $request)
    {
		$validated = $request->validate([
			'codeList.*'      => ['required', 'string'],
			'idList.*'        => ['required', 'string' ,'alpha_num' ,'distinct'],
			'privList.*'      => ['nullable'],
			'nameList.*'      => ['nullable', 'string'],
			'nameRomanList.*' => ['nullable', 'string'],
			'telList.*'       => ['nullable', 'string', 'max:5'],
			'mailList.*'      => ['nullable', 'email'],
			'delList.*'       => ['nullable'],
		]);

		$admin = Auth::user();

        $operatorDAO = new OperatorDAO();
        $operatorDAO->update($admin->operator_id ,$validated);

        return back()->with('status', 'success-store');
    }

}
