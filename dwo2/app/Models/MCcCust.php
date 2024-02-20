<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MCcCust extends Model
{

     protected $table = 'M_CC_CUST';

	protected $guarded = [
        'cust_num',
    ];

	protected $primaryKey = 'cust_num';
	public $incrementing = false;
    public $timestamps = false;

}
