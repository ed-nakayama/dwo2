<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ORDER_HDR extends Model
{
     protected $table = 'ORDER_HDR';

	protected $guarded = [];


	protected $primaryKey = 'web_order_num';
	public $incrementing = false;
//    public $timestamps = false;
	const CREATED_AT = 'dwo_last_update';
	const UPDATED_AT = 'dwo_last_update';

    public function __construct()
    {
        $this->table = config('dwo.ORDER_HDR');
    }
}
