<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryMt extends Model
{

     protected $table = 'DWO_DELIVERY_MT';

	protected $guarded = [];

	protected $primaryKey = ['delivery_cust_code, delivery_seq'];
	public $incrementing = false;
	const CREATED_AT = 'delivery_update';
	const UPDATED_AT = 'delivery_update';


}
