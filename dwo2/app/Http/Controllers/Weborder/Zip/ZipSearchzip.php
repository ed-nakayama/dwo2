<?php

namespace App\Http\Controllers\Weborder\Zip;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ZipMt;

class ZipSearchzip extends Controller
{
    function index(Request $request)
    {
		$zip_code = $request-frm_zip1 . $request->frm_zip2;

		$zipList = ZipMt::where('zip_code', 'like', $zip_code . '%')
			->orderBy('zip_code')
			->get();

		$ziplistcount = count($ziplist);

		return view('weborder.zip.searchzip', 
			[
			'ziplist'      => $ziplist,
			'ziplistcount' => $ziplistcount,
			'frm_zip1'     => $request->input("frm_zip1"),
			'frm_zip2'     => $request->input("frm_zip2"),
			]
		);
    }


}
