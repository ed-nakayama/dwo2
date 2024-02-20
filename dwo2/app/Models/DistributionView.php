<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DistributionView extends Model
{

     protected $table = 'DISTRIBUTION_VIEW';

	protected $guarded = [
    ];

//	protected $primaryKey = 'cust_code';
	public $incrementing = false;
    public $timestamps = false;

}
