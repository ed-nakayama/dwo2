<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{

/*************************************
* パスワード変更
**************************************/
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = \Auth::user();

        $user->password = Hash::make($request->get('new-password'));
        $user->operator_modified_id = $user->operator_id;
        $user->save();

        return redirect()->back()->with('status', 'パスワードを変更しました。');
    }
}
