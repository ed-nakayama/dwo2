<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BigCategoryMt extends Model
{

    protected $table = 'DWO_BIG_CATEGORY_MT';

	protected $guarded = [];

	protected $primaryKey = 'big_category_code';
	public $incrementing = false;
	const CREATED_AT = 'big_category_update';
	const UPDATED_AT = 'big_category_update';

}
