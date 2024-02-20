<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MItem extends Model
{

     protected $table = 'M_ITEM';

	protected $guarded = [
        'item_cd',
    ];

	protected $primaryKey = 'item_cd';
	public $incrementing = false;
    public $timestamps = false;

}
