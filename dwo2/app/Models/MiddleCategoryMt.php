<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MiddleCategoryMt extends Model
{

    protected $table = 'DWO_MIDDLE_CATEGORY_MT';

	protected $guarded = [];

	protected $primaryKey = 'middle_category_code';
	public $incrementing = false;
	const CREATED_AT = 'middle_category_update';
	const UPDATED_AT = 'middle_category_update';


}
