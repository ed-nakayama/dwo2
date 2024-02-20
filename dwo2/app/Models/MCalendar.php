<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MCalendar extends Model
{

     protected $table = 'M_calendar';

	protected $guarded = [
        'pd_cd',
    ];

	protected $primaryKey = ['pd_cd', 'calendar_year', 'calendar_month'];
	public $incrementing = false;
    public $timestamps = false;

}
