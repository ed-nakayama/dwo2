<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ORDER_DTL extends Model
{
     protected $table = 'ORDER_DTL';

	protected $guarded = [
        'account_num',
    ];

	public $incrementing = false;
    public $timestamps = false;

    public function __construct()
    {
        $this->table = config('dwo.ORDER_DTL');
    }

}
