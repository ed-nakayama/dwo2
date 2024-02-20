<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentLevel extends Model
{

     protected $table = 'DWO_AGENT_LEVEL';

	protected $guarded = [
    ];

//	protected $primaryKey = 'cust_code';
	public $incrementing = false;
    public $timestamps = false;

}
