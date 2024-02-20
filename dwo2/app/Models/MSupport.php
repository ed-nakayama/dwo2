<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MSupport extends Model
{

     protected $table = 'M_SUPPORT';

	protected $guarded = [
        'account_num',
    ];

   
	protected $primaryKey = ['account_num','seq_num'];
	public $incrementing = false;
    public $timestamps = false;


}
