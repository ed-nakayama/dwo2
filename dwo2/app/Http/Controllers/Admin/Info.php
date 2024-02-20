<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Models\InfoMt;

class Info extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index()
    {
		$info = InfoMt::select()->first();

		return view('admin.info' ,compact(
			'info'
		));
    }


    /*********************************
     * 保存
     *********************************/
    public function store(Request $request)
    {

		$msg = '';
		if (!empty($request->update)) {

			\DB::table('DWO_info_mt')->update([
				'msg'    => $request->input('infoMsg'),
			]);
			$msg = 'お知らせマスタ（YBP用）を更新しました。';

		} else if (!empty($request->update2)) {
			\DB::table('DWO_info_mt')->update([
				'msg2'    => $request->input('infoMsg2'),
			]);

			$msg = 'お知らせマスタ（PAP用）を更新しました。';
		}

	
		return redirect('admin/info')->with('flash_message', $msg);
    }

}
