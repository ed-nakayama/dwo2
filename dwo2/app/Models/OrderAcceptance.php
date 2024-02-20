<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAcceptance extends Model
{

     protected $table = 'DWO_ORDER_ACCEPTANCE';

	protected $guarded = [
    ];

	protected $primaryKey = 'order_acceptance_seq';
	public $incrementing = false;
	const CREATED_AT = 'order_acceptance_update';
	const UPDATED_AT = 'order_acceptance_update';

}
