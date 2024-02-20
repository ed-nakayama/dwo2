<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoMt extends Model
{

     protected $table = 'DWO_INFO_MT';

	protected $guarded = [
    ];

//	protected $primaryKey = 'item_cd';
	public $incrementing = false;
    public $timestamps = false;

}
