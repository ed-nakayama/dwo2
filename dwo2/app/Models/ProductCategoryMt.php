<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategoryMt extends Model
{

     protected $table = 'DWO_PRODUCT_CATEGORY_MT';

	protected $guarded = [];

	protected $primaryKey = 'product_category_no';
	public $incrementing = false;
	const CREATED_AT = 'product_category_update';
	const UPDATED_AT = 'product_category_update';



}
