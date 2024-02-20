<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductMt extends Model
{

     protected $table = 'DWO_PRODUCT_MT';

	protected $guarded = [];

	protected $primaryKey = 'product_code';
	public $incrementing = false;
	const CREATED_AT = 'product_update';
	const UPDATED_AT = 'product_update';


}
