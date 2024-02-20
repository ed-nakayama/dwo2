<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductStatusMt extends Model
{

     protected $table = 'DWO_PRODUCT_STATUS_MT';

	protected $guarded = [];

	protected $primaryKey = 'prod_status_id';
	public $incrementing = false;
	const CREATED_AT = 'prod_status_update';
	const UPDATED_AT = 'prod_status_update';



}
