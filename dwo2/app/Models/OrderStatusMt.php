<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatusMt extends Model
{

     protected $table = 'DWO_ORDER_STATUS_MT';

	protected $guarded = [];

	protected $primaryKey = 'order_status_id';
	public $incrementing = false;
	const CREATED_AT = 'order_status_update';
	const UPDATED_AT = 'order_status_update';


}
