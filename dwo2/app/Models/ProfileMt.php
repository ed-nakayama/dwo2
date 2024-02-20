<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileMt extends Model
{

     protected $table = 'DWO_PROFILE_MT';

	protected $guarded = [];

	protected $primaryKey = 'profile_cust_code';
	public $incrementing = false;
	const CREATED_AT = 'profile_update';
	const UPDATED_AT = 'profile_update';


}
