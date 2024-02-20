<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\Classes\CalendarMtDAO;

class TestShipping extends Controller
{

/*************************************
* Form
**************************************/
    public function index()
    {
		$test_datetime = date('Y/m/d H:i:s');

		return view('admin.test.shippingForm', compact(
			'test_datetime'
		));

    }


/*************************************
* ·ë²Ì
**************************************/
    public function result(Request $request)
    {
		$validated = $request->validate([
			'test_datetime' => ['required', 'date_format:Y/m/d H:i:s' ],
		]);

    	$calendarMtDAO = new CalendarMtDAO();
    	$shipping_date = $calendarMtDAO->getShippingDate2(strtotime($request->input('test_datetime')));
    	
		return view('admin.test.shippingResult', compact(
			'shipping_date'
		));
    }

}
