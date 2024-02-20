<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

use App\Models\Admin;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index()
    {
		$adminList = Admin::all();

		return view('admin.profile_list' ,compact(
			'adminList',
		));

    }


    /**
     * Update the user's profile information.
     */
    public function regist(Request  $request)
    {
		$validated = $request->validate([
			'new_id' => ['required', 'string'],
			'new_name' => ['required', 'string'],
			'new_name_roman' => ['nullable', 'string'],
			'new_password1' => ['required', Password::defaults()],
			'new_password2' => ['required', Password::defaults()],
			'new_tel' => ['nullable', 'string'],
			'new_mail' => ['nullable', 'email'],
		]);

		$loginUser = Auth::user();

		$next_code = Admin::max('operator_code') + 1;

		$password = 

		$admin = Admin::create([
			'operator_code' => $next_code,
			'operator_id' => $request->new_id,
			'operator_priv' => (!empty($request->new_priv)) ? '1' : '0',
			'operator_name' => $request->new_name,
			'operator_name_roman' => $request->new_name_roman,
			'password' => Hash::make($validated['new_password1']),
			'password2' => Hash::make($validated['new_password2']),
			'operator_tel' => $request->new_tel,
			'operator_mail' => $request->new_mail,
			'operator_modified_id' => $loginUser->operator_id,
			'operator_update' => date('Y-m-d H:i:s'),
			'operator_del' => '0',
		]);

        return back()->with('status', 'success-regist');
    }


    /**
     * Update the user's profile information.
     */
    public function store(Request  $request)
    {
		$validated = $request->validate([
			'code' => ['required', 'string'],
			'id' => ['required', 'string'],
			'name' => ['required', 'string'],
			'name_roman' => ['nullable', 'string'],
			'password1' => ['nullable', Password::defaults()],
			'password2' => ['nullable', Password::defaults()],
			'tel' => ['nullable', 'string'],
			'mail' => ['nullable', 'email'],
		]);

		$loginUser = Auth::user();

		$admin = Admin::find($validated['code']);
		
		$admin->operator_id = $validated['id'];
		$admin->operator_priv = (!empty($request->priv)) ? '1' : '0';
		$admin->operator_name = $validated['name'];
		$admin->operator_name_roman = $validated['name_roman'];
		
		if (!empty($validated['password1'])) {
			$admin->password = Hash::make($validated['password1']);
		}
		if (!empty($validated['password2'])) {
			$admin->password2 = Hash::make($validated['password2']);
		}
		$admin->operator_tel = $validated['tel'];
		$admin->operator_mail = $validated['mail'];
		$admin->operator_modified_id = $loginUser->operator_id;
		$admin->operator_update = date('Y-m-d H:i:s');
		$admin->operator_del = (!empty($request->del)) ? '1' : '0';

		$admin->save();

        return back()->with('status', 'success-store');
    }



    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('admin.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('admin.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/admin/login');
    }
}
