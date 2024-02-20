<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DisableAgent extends Model
{
     protected $table = 'DWO_DISABLE_AGENT';

	protected $guarded = [];

	public $incrementing = false;
    public $timestamps = false;

}
