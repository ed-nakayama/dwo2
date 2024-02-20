<?php

namespace App\Http\Controllers\Weborder\Custinfo;

use App\Http\Controllers\Controller;

class CustinfoHandling extends Controller
{
    function index()
    {
		return view('weborder.custinfo.handling');
    }
}
