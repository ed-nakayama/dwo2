<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceClassView extends Model
{

     protected $table = 'invoice_price_class_view';

	protected $guarded = [
    ];

//	protected $primaryKey = 'cust_code';
	public $incrementing = false;
    public $timestamps = false;

}
