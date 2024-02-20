<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BatchConf extends Model
{

     protected $table = 'DWO_BATCH_CONF';

	protected $guarded = [
    ];

//	protected $primaryKey = 'cust_code';
	public $incrementing = false;
    public $timestamps = false;

}
